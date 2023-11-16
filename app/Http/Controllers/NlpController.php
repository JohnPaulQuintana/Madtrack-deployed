<?php

namespace App\Http\Controllers;

use App\Helpers\ProcessEmployees;
use App\Helpers\ProcessPrinting;
use Carbon\Carbon;
use App\Helpers\GenerateInventories;
use App\Models\Inventory;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NlpController extends Controller
{
    public function process(Request $request)
    {
        //get all the products for searching
        $allPrd = Inventory::pluck('product_name');
        // dd($allPrd);
        // $url = env('APP_URL').'/nlp';
        $client = new Client();
        $response = $client->post('http://localhost:8000/nlp', [
            'json' => [
                'text' => $request->input('text'),
                'products' => $allPrd,
            ]
        ]);
        // $response = $client->post('https://madtrack-assistant.onrender.com/nlp', [
        //     'json' => ['text' => $request->input('text')]
        // ]);

        $result = json_decode($response->getBody(), true);
        // dd($result);

        // for all employee // not working
        if(isset($result['answer']['exclude'])){
           
        }

        // for all present
        if(isset($result['answer']['include-employee'])){
            $emp = new ProcessEmployees($result);
            return response()->json($emp->getEmployeePresent());
        }

        // for all product stocks not 0
        if(isset($result['answer']['include-stock'])){
            $invClass = new GenerateInventories($result);
            return response()->json($invClass->processInventories());
        }

        // for printing available products
        if(isset($result['answer']['include-print'])){
            $prtClass = new ProcessPrinting($result);
            return response()->json($prtClass->getProductsForPrinting());
        }

        // for attendance
        if(isset($result['answer']['include-attendance'])){
            $formattedResult = [
                'answer' =>$result['answer']['include-attendance'],
                'init'=>'Accesing your dashboard... Initializing camera... Activation Completed',
                'action' =>'attendance'
            ];
            return response()->json($formattedResult);
        }
    }
}
