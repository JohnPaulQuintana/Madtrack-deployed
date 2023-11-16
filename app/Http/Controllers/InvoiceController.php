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

        $insertedProductsNotif = []; // Initialize an array to store inserted products

        for ($i = 0; $i < count($productId); $i++) {
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
                    $invoice = Invoice::create($product_data);
            
                    // Update the stock count in the Inventory model
                    $inventory->stocks -= $productQuantity[$i];
                    $inventory->save();
            
                    // Record a transaction history
                    $transaction = new Transaction;
                    $transaction->transaction_id = $productId[$i];
                    $transaction->transaction_type = $req;
                    $transaction->transaction_description = "{$clientName} bought {$productQuantity[$i]} units of {$inventory->product_name} at {$inventory->product_pcs_price} each.";
                    $transaction->date = now(); // Use the current date and time
                    $transaction->save();
            
                    $insertedProductsNotif[] = $invoice;
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
}
