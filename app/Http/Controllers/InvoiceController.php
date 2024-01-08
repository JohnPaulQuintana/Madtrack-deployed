<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function createInvoices(Request $request){
        // dd($request);
        $req = $request->input('req'); // Assuming you have 'req' parameter in your form
        // dd($request);
        $clientName = $request->input('client_name');
        $productId = $request->input('inventories_id',[]);
        $productType = $request->input('product_type',[]);
        $productName = $request->input('product_name',[]);
        $productBrand = $request->input('product_brand',[]);
        $productQuantity = $request->input('product_quantity',[]);
        $productPrice = $request->input('product_price',[]);
        $productAmount = $request->input('product_amount',[]);
        // dd(count($productId));
        $insertedProductsNotif = []; // Initialize an array to store inserted products

        for ($i = 0; $i <= count($productId) - 1; $i++) {
            $product_data = [
                'sold_to' => $clientName,
                'inventories_id' => $productId[$i],
                'quantity' => $productQuantity[$i],
                'price' => $productAmount[$i],
                'date' =>DB::raw('NOW()'),
                
                // ... other fields
            ];

            if ($req === 'invoice') {
                // Validate product data (e.g., productId, productQuantity)
                // Ensure that $productId[$i] corresponds to a valid inventory item and $productQuantity[$i] is a positive integer.
            
                $inventory = Inventory::findOrFail($productId[$i]);
            
                // Check if there are enough stocks available
                if ($inventory->stocks >= $productQuantity[$i]) {
                    // Create an Invoice record
                   try {
                        $invoice = Invoice::create($product_data);
                
                        // Update the stock count in the Inventory model
                        $inventory->stocks -= $productQuantity[$i];
                        $inventory->save();
                    // dd('ginagawa');
                        // Record a transaction history
                        $transaction = Transaction::create([
                            "transaction_id" => $productId[$i],
                            "transaction_type" => $req,
                            "transaction_description" => "{$clientName} bought {$productQuantity[$i]} units of {$inventory->product_name} at {$inventory->product_pcs_price} each.",
                            "date" => now(),
                        ]);
                        
                        // $transaction->save();
                
                        $insertedProductsNotif[] = $invoice;
                   } catch (\Throwable $th) {
                    dd($th);
                        $insertedProductsNotif[] = $invoice;
                   }
                } else {
                    // Handle the case where there are not enough stocks available.
                    // You can provide an error message to the user or handle it based on your application's requirements.
                }
            }
            
        }

         // Build the success message
         $message = 'Invoice Successfully ' . ($req === 'edit' ? 'Edited' : 'Created') . ' ' . count($insertedProductsNotif) . ' product(s)!';

         // Prepare the toast notification data
         $notification = [
             'status' => 'success',
             'message' => $message,
         ];
 
         // Convert the notification to JSON
         $notificationJson = json_encode($notification);
 
         // Assuming you have already prepared the $notificationJson variable
        return redirect()->route('inventory.available.stocks')->with('notification', $notificationJson);

    }

    // void product
    public function voidProducts(Request $request){
        $ids = $request->route('id');
         // Convert the comma-separated string of IDs to an array
        $idArray = explode(',', $ids);

        $purchased = Invoice::whereIn('id', $idArray)->get();

        // Retrieve quantities and corresponding inventory IDs
        $quantitiesToUpdate = [];
        $inventoryIdsToUpdate = [];
        foreach ($purchased as $invoice) {
            $quantitiesToUpdate[$invoice->inventories_id] = $invoice->quantity; // Assuming you have a 'quantity' column
            $inventoryIdsToUpdate[] = $invoice->inventories_id;
        }
        // Update the inventories table with the new quantities
        foreach ($quantitiesToUpdate as $inventoryId => $quantity) {
            $inventory = Inventory::find($inventoryId);

            // Ensure the inventory record exists
            if ($inventory) {
                $inventory->stocks += $quantity;
                $inventory->save();
            }
        }
        // dd($quantitiesToUpdate);
        // Delete the corresponding Invoice records
        Invoice::whereIn('id', $idArray)->delete();

 
         return response()->json(['url'=>'inventory.available.stocks']);
        
       
    }
}
