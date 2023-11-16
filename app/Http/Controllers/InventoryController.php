<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Inventory;
use App\Models\Rejected;
use Illuminate\Http\Request;
// use PDF;
class InventoryController extends Controller
{
    public function showProductPage(){
        $stocks = Inventory::orderBy('product_name', 'asc')->orderBy('created_at', 'asc')->get();
        // Format created_at to days, months, years
        foreach ($stocks as $stock) {
            $stock->created_at_formatted = Carbon::parse($stock->created_at)->format('d F Y');
        }
        return view('admin.inventory.show-product-page', ['stocks'=>$stocks]);
    }

    public function manageProducts(Request $request){ 
        $req = $request->input('req'); // Assuming you have 'req' parameter in your form
        // dd($request);
        $productId = $request->input('stocks_id',[]);
        $productType = $request->input('product_type',[]);
        $productName = $request->input('product_name',[]);
        $productBrand = $request->input('product_brand',[]);
        $productPricePcs = $request->input('product_price_pcs',[]);
        $productPricePck = $request->input('product_price_pck',[]);
        $productPcsPck = $request->input('product_pcs_pck',[]);
        $productStocks = $request->input('product_stocks',[]);
        
        // Loop through the arrays and process the product details
        $insertedProductsNotif = []; // Initialize an array to store inserted products

        for ($i = 0; $i < count($productType); $i++) {
            // Process the $productId and $quantity, e.g., save them to the database
            // You can create new stock entries here based on the product details
            $product_data = [
                'product_type' => $productType[$i],
                'product_name' => $productName[$i],
                'product_brand' => $productBrand[$i],
                'stocks' => $productStocks[$i],
                'product_pcs_price' => (double)$productPricePcs[$i],
                'product_pack_price' => (double)$productPricePck[$i],
                'product_pcs_per_pack' => (double)$productPcsPck[$i],
                // ... other fields
            ];

            if ($req === 'edit') {
                // If it's an edit request, find the inventory record by product type and brand
                $inventory = Inventory::where('id', (integer)$productId[$i])->first();
                // dd($inventory->product_brand);
                // Compare the fields and update if changed
                if ($inventory) {
                    if ($inventory->product_type !== $productType[$i]) {
                        $inventory->product_type = $productType[$i];
                    }
                    if ($inventory->product_name !== $productName[$i]) {
                        $inventory->product_name = $productName[$i];
                    }
                    if ($inventory->product_brand !== $productBrand[$i]) {
                        $inventory->product_brand = $productBrand[$i];
                    }
                    if ($inventory->stocks !== (int)$productStocks[$i]) {
                        $inventory->stocks = (int)$productStocks[$i];
                    }
                    if ($inventory->product_pcs_price !== $productPricePcs[$i]) {
                        $inventory->product_pcs_price = $productPricePcs[$i];
                    }
                    if ($inventory->product_pack_price !== $productPricePck[$i]) {
                        $inventory->product_pack_price = $productPricePck[$i];
                    }
                    if ($inventory->product_pcs_per_pack !== $productPcsPck[$i]) {
                        $inventory->product_pcs_per_pack = $productPcsPck[$i];
                    }
                    // ... similar checks for other fields

                    // Update and save the changes if any field has changed
                    if ($inventory->isDirty()) {
                        $inventory->save();
                        $insertedProductsNotif[] = $inventory;
                    }
                }
            } else if ($req === 'add') {
                // If it's an add request, create a new inventory record
                $inventory = Inventory::create($product_data);
                // // Update the stock count
                // $inventory->stocks = $productStocks[$i];
                $inventory->save();
                $insertedProductsNotif[] = $inventory;
            } else if ($req === 'reject') {
                $reject = Rejected::create($product_data);
                $reject->save();
                $insertedProductsNotif[] = $reject;
            }

            // $insertedProducts = Inventory::create($product_data);

            //  // Add the inserted product to the array
            // $insertedProductsNotif[] = $insertedProducts;
        }
        // Build the success message
        $message = 'Successfully ' . ($req === 'edit' ? 'Edited' : 'Added') . ' ' . count($insertedProductsNotif) . ' product(s)!';

        // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => $message,
        ];

        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }

    // create pdf
    // public function createPDF() {
    //     $stocks = Inventory::orderBy('product_name', 'asc')->orderBy('created_at', 'asc')->get();
    //     // Format created_at to days, months, years
    //     foreach ($stocks as $stock) {
    //         $stock->created_at_formatted = Carbon::parse($stock->created_at)->format('d F Y');
    //     }

    //     // share data to view
    //   view()->share(['stocks',$stocks]);
    // $pdf = PDF::loadView('admin.print-pdf', ['stocks'=>$stocks]);
    // //   $pdf = PDF::loadView('admin.show-product-page', ['stocks'=>$stocks]);
    //   // download PDF file with download method
    //   return $pdf->download('pdf_file.pdf');
    // }

   
}
