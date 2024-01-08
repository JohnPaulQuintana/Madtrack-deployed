<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Rejected;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use PDF;
class InventoryController extends Controller
{
    public function showProductPage()
    {
        $stocks = Inventory::orderBy('product_name', 'asc')->orderBy('created_at', 'asc')->get();
        // Format created_at to days, months, years
        foreach ($stocks as $stock) {
            $stock->created_at_formatted = Carbon::parse($stock->created_at)->format('d F Y');
        }
        return view('admin.inventory.show-product-page', ['stocks' => $stocks]);
    }

    public function manageProducts(Request $request)
    {
        $req = $request->input('req'); // Assuming you have 'req' parameter in your form
        // dd($request);
        $productId = $request->input('stocks_id', []);
        $productType = $request->input('product_type', []);
        $productName = $request->input('product_name', []);
        $productBrand = $request->input('product_brand', []);
        $productPricePcs = $request->input('product_price_pcs', []);
        // $productPricePck = $request->input('product_price_pck', []);
        $productPcsPck = $request->input('product_pcs_pck', []);
        $productStocks = $request->input('product_stocks', []);
        $productUnitType = $request->input('product_unitType', []);
        $productSize = $request->input('product_size', []);

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
                'product_pcs_price' => (float)$productPricePcs[$i],
                'product_pack_price' => (float)$i,
                'product_pcs_per_pack' => (float)$productPcsPck[$i],
                'unit_type' => $productUnitType[$i],
                'size' => $productSize[$i],
                // ... other fields
            ];

            if ($req === 'edit') {
                // If it's an edit request, find the inventory record by product type and brand
                $inventory = Inventory::where('id', (int)$productId[$i])->first();
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
                    if($inventory->size !== $productSize[$i]){
                        $inventory->size = $productSize[$i];
                    }
                    if($inventory->unit_type !== $productUnitType[$i]){
                        $inventory->unit_type = $productUnitType[$i];
                    }
                    // if ($inventory->product_pack_price !== $productPricePck[$i]) {
                    //     $inventory->product_pack_price = $productPricePck[$i];
                    // }
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

    // get rejected
    public function getRejected(Request $request)
    {
        // dd($request->input('productName'));
        $inventories = Inventory::where('product_name', $request->input('productName'))->first();
        // Check if any inventory items were found
        if (!$inventories) {
            return response()->json(['rejected' => 'No inventory items found for the specified product name']);
        }
        return response()->json(['rejected' => $inventories]);
    }

    public function postRejected(Request $request)
    {
        // dd($request);
        // Extract only the relevant fields from the request
        $productData = [
            'product_type' => $request->input('product_type'),
            'product_name' => $request->input('product_name'),
            'product_brand' => $request->input('product_brand'),
            'stocks' => $request->input('stocks'),
            'product_pcs_price' => $request->input('product_pcs_price'),
            // Add other relevant fields
        ];
        // Find the existing record based on the specified fields
        $reject = Rejected::where('product_type', $request->input('product_type'))
            ->where('product_name', $request->input('product_name'))
            ->where('product_brand', $request->input('product_brand'))
            ->first();
        // If the product didn't exist, set additional data and save
        if (!$reject) {
            // Set additional data if needed
            // $reject->additional_attribute = 'value';
            $reject = Rejected::create($productData);
            $reject->save();
        } else {
            $reject->stocks += $request->input('stocks');
            // Save the updated record
            $reject->save();
        }
        // Add to the array of inserted products
        $insertedProductsNotif[] = $reject;

        // Build the success message
        $message = 'Successfully ' . ('Added') . ' ' . count($insertedProductsNotif) . ' product(s)!';

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


    // delete products

    public function deleteProduct(Request $request)
    {

        // Get the productId from the request
        $productId = $request->input('productId');

        // Find the product by ID
        $product = Inventory::find($productId);
        // dd($product);
        // Check if the product exists
        if ($product) {
            try {
                // Perform any additional checks or logic before deletion if needed
                 // Manually delete related invoices
                DB::table('invoices')->where('inventories_id', $productId)->delete();
                // Delete the product
                $product->delete();

                return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
            } catch (\Exception $e) {
                // Handle any exceptions or errors
                return response()->json(['error' => true, 'message' => 'Failed to delete product'], 500);
            }
        } else {
            // Product not found
            return response()->json(['error' => true, 'message' => 'Product not found'], 404);
        }
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
