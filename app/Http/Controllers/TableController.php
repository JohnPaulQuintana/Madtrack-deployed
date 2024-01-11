<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Rejected;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TableController extends Controller
{
    private $stocks;
    public function availableStocks()
    {
        // Retrieve subquery from session
        $subqueryFromSession = Session::get('subquery');
        //  dd($subqueryFromSession);
        switch ($subqueryFromSession) {

            case 'latest':
                $this->stocks = Inventory::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->latest('created_at')
                    ->orderBy('product_type')
                    ->get();
                break;

            case 'oldest':
                $this->stocks = Inventory::oldest('created_at')
                ->orderBy('product_type')
                ->get();
                break;

            case 'out':
                $this->stocks = Inventory::where('stocks', 0)
                ->orderBy('product_type')
                ->get();
                break;

            case null:
            case 'all':
                // $this->stocks = Inventory::where('stocks', '!=', 0)
                // ->orderBy('product_type')->get();
                $this->stocks = Inventory::select('inventories.id','inventories.product_type', 'inventories.product_brand'
                ,'inventories.product_name','inventories.stocks','inventories.product_pcs_price'
                ,'inventories.product_pack_price','inventories.product_pcs_per_pack'
                ,'inventories.unit_type','inventories.size','inventories.created_at'
                ,DB::raw('(SELECT COALESCE(SUM(invoices.quantity), 0) FROM invoices WHERE invoices.inventories_id = inventories.id) as invoice_count'),
                DB::raw('(SELECT COALESCE(SUM(rejecteds.stocks), 0) FROM rejecteds WHERE rejecteds.inventories_id = inventories.id) as rejected_count'))
                
                ->leftJoin('invoices', 'inventories.id', '=', 'invoices.inventories_id')
                ->leftJoin('rejecteds', 'inventories.id', '=', 'rejecteds.inventories_id')
                
                ->orderBy('inventories.product_type')
                ->groupBy(
                    'inventories.id','inventories.product_type', 'inventories.product_brand'
                    ,'inventories.product_name','inventories.stocks','inventories.product_pcs_price'
                    ,'inventories.product_pack_price','inventories.product_pcs_per_pack'
                    ,'inventories.unit_type','inventories.size','inventories.created_at'
                )
                ->get();

                // dd($this->stocks );
                break;

            case 'search':
                $keywords = Session::get('searched');
                // dd($keywords);
                $this->stocks = Inventory::where('product_name', 'like', '%' . $keywords . '%')
                ->where('stocks','>', 0)
                ->orderBy('product_type')
                ->paginate(10);
                break;

            case 'print.all':
                $keywords = Session::get('print');//product name
                $this->stocks = Inventory::where('stocks', '!=', 0)->paginate(10);
                break;

            case 'print.only':
                $keywords = Session::get('print');//product name
                // dd($keywords);
                break;
            default:
            
                // Handle other cases if needed
                // $this->stocks = Inventory::where('stocks', '!=', 0)
                // ->orderBy('product_type')->get();

                $this->stocks = Inventory::select('inventories.id','inventories.product_type', 'inventories.product_brand'
                ,'inventories.product_name','inventories.stocks','inventories.product_pcs_price'
                ,'inventories.product_pack_price','inventories.product_pcs_per_pack'
                ,'inventories.unit_type','inventories.size','inventories.created_at'
                ,DB::raw('(SELECT COALESCE(SUM(invoices.quantity), 0) FROM invoices WHERE invoices.inventories_id = inventories.id) as invoice_count'),
                DB::raw('(SELECT COALESCE(SUM(rejecteds.stocks), 0) FROM rejecteds WHERE rejecteds.inventories_id = inventories.id) as rejected_count'))
                
                ->leftJoin('invoices', 'inventories.id', '=', 'invoices.inventories_id')
                ->leftJoin('rejecteds', 'inventories.id', '=', 'rejecteds.inventories_id')
                ->where('inventories.stocks', '!=', 0)
                ->orderBy('inventories.product_type')
                ->groupBy(
                    'inventories.id','inventories.product_type', 'inventories.product_brand'
                    ,'inventories.product_name','inventories.stocks','inventories.product_pcs_price'
                    ,'inventories.product_pack_price','inventories.product_pcs_per_pack'
                    ,'inventories.unit_type','inventories.size','inventories.created_at'
                )
                ->get();

                // dd($this->stocks );
                break;
        }
        
        // dd($this->stocks);
        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        
            // Destroy the session variable
            Session::forget('subquery');

        return view('admin.inventory.inventory', ['stocks' => $this->stocks, 'notifs' => $out]);
    }

    public function purchasedProduct()
    {
        $invoices = Invoice::with('inventory') // Load the related products
            ->orderBy('created_at', 'desc')
            ->get();

        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate the date one day ago
        $oneDayAgo = Carbon::now()->subDay();
        // Create a Carbon instance for the current date and time
        $currentDateTime = Carbon::now();

        // Get only the date portion in "Y-m-d" format
        $dateOnly = $currentDateTime->format('Y-m-d');

        $newest = Invoice::where('date', $dateOnly)
            ->orderBy('date', 'asc')
            ->get();
        // Retrieve the oldest invoice from one day ago
        $oldest = Invoice::where('date', '<', $oneDayAgo)
            ->orderBy('date', 'asc')
            ->get();
        return view('admin.inventory.purchased', ['invoices' => $invoices, 'newest' => $newest, 'oldest' => $oldest, 'today' => $dateOnly, 'notifs' => $out]);
    }

    public function rejectedProduct()
    {
        $rejected = Rejected::where('stocks', '>', 0)->orderBy('created_at', 'desc')->get();
        // dd($rejected);
        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.inventory.rejected', ['rejected' => $rejected, 'notifs' => $out]);
    }

    public function outofstocksProduct()
    {
        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.inventory.out-of-stocks', ['outofstocks' => $out, 'notifs' => $out]);
    }

    public function processProduct(Request $request)
    {
        // Use the $request object to access the 'ids' parameter
        $ids = $request->route('id');
        // Convert the comma-separated string of IDs to an array
        $idArray = explode(',', $ids);

        // Use the array of IDs to retrieve data from the database
        $inventory = Inventory::whereIn('id', $idArray)
            ->where('stocks', '!=', 0)
            ->get(); // Retrieve all matching records
        // dd($inventory);
        return view('admin.inventory.sold', ['inventories' => $inventory]);
    }
}
