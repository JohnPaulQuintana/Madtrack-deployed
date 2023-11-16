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
    private $message;
    private $formattedResult;
    private $action;
    public function __construct($inv)
    {
        $this->inventory = $inv;
        // Handle the NLP response
        $this->modelClass = 'App\\Models\\' . $this->inventory['answer']['model'];
        $this->subquery = $this->inventory['answer']['subquery'];
        $this->keywords = $this->inventory['utteranceText'];
        // dd($this->inventory);
    }

    public function processInventories()
    {
        try {
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
                    break;
                case 'oldest':
                    $data = $this->modelClass::oldest('created_at')
                    ->get();
                    $count = count($data);
                    $this->message = "We have a oldest product total of {$count}";
                    $this->action = 'available';
                    break;
                case 'search':
                    //exact name
                    $data = $this->modelClass::where('product_name',$this->keywords)
                    ->where('stocks','>', 0)
                    ->get();
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

            return $this->formattedResult;
        } catch (\Throwable $th) {
            return ['error' => 'An error occurred.'];
        }
    }
}
