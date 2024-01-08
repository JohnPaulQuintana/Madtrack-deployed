<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class GenerateInventories
{
    private $inventory;
    private $modelClass;
    private $subquery;
    private $keywords;
    private $productName;
    private $message;
    private $formattedResult;
    private $action;
    public function __construct($inv)
    {
        $this->inventory = $inv;
        // Handle the NLP response
        $this->modelClass = 'App\\Models\\' . $this->inventory['answer']['model'];
        $this->subquery = $this->inventory['answer']['subquery'];
        $this->keywords = $this->inventory['wildcard'];
        $this->productName = $this->inventory['utteranceText'];
        // dd($this->productName);
    }

    public function processInventories()
    {
        try {
            // dd($this->subquery);
            switch ($this->subquery) {
                case 'all':
                    $data = $this->modelClass::where($this->inventory['answer']['include-stock'], '!=', 0)->get();
                    $count = count($data);
                    $this->message = "We have a product total of {$count}.  Available products displayed on the table below. ";
                    $this->action = 'available';
                    break;
                case 'latest':
                    $data = $this->modelClass::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->latest('created_at')
                    ->get();
                    $count = count($data);
                    $this->message = "We have a latest product total of {$count}";
                    $this->action = 'available';

                    $this->subquery = 'latest';
                    break;
                case 'oldest':
                    $data = $this->modelClass::oldest('created_at')
                    ->get();
                    $count = count($data);
                    $this->message = "We have a oldest product total of {$count}";
                    $this->action = 'available';

                    $this->subquery = 'oldest';
                    break;
                case 'search':
                    //exact name
                    $data = $this->modelClass::where('product_name', 'like', '%' . $this->keywords . '%')
                    ->where('stocks', '>', 0)
                    ->get();  
                    // dd($data);              
                    //any position
                    // $data = $this->modelClass::where('product_name', 'ilike', '%' . $this->keywords . '%')->get();

                    $count = count($data);
                    if($count > 0){
                        $this->message = "We have a total of {$count} {$this->keywords} Products";
                        $this->action = 'available';
                    }else{
                        $this->message = "There is no record!. for {$this->keywords}!. kindly check your spelling!";
                        $this->action = 'unavailable';
                    }
                    
                    
                    break;
                case 'rejected':
                    // dd('ginagawa');
                    $data = $this->modelClass::get();
                    $count = count($data);
                    $this->message = "We have a Rejected total of {$count}.  Rejected products displayed on the table below. ";
                    $this->action = 'rejected'; 
                    break;

                case 'out':
                    $data = $this->modelClass::where('stocks', 0)->get();
                    $count = count($data);
                    if($count > 0){
                        $this->message = "We have a total of {$count}.  Out of stocks products displayed on the table below. ";
                        $this->action = 'out'; 
                        $this->subquery = 'out';
                    }else{
                        $this->message = "We dont have out of stocks product!";
                        $this->action = 'cancel'; 
                        // $this->subquery = 'out';
                    }
                    
                    break;
                default:
                    # code...
                    dd('there is no subquery availables');
                    break;
            }

            // Store subquery in session
            Session::put('subquery', $this->subquery);
            Session::put('searched', $this->keywords);
            // Remove the trailing comma and whitespace
            $this->formattedResult = [
                // 'answer' =>$total. implode(', ', $formattedResponse),
                'answer' =>'Accesing your dashboard... Initializing Tables... '. $this->message,
                'init' => $this->message,
                'action' => $this->action,
            ];

            // dd($this->formattedResult);
            return $this->formattedResult;
        } catch (\Throwable $th) {
            return ['error' => 'An error occurred.'];
        }
    }
}
