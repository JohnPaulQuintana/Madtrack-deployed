<?php

namespace App\Http\Controllers;

use Svg\Tag\Rect;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Inventory;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Helpers\GenerateTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    //get page
    public function report()
    {
        return view('admin.reports.report');
    }

    public function display()
    {
        $generatedR = Report::orderBy('created_at', 'desc')->get();
        // Loop through each report and format the created_at timestamp
        foreach ($generatedR as $report) {
            $formattedDate = Carbon::parse($report->created_at)->format('Y-m-d');
            $formattedTime = Carbon::parse($report->created_at)->format('H:i:s');
            // You can add this formatted date as a new attribute to each report
            $report->formatted_created_at = $formattedDate;
            $report->formatted_time = $formattedTime;
        }
        return response()->json(['generatedReports' => $generatedR]);
    }

    public function generate(Request $request)
    {
        // dd($request);

        // GenerateTable::doSomething();
        $types = $request->input('types');
        $from = $request->input('from');
        $to = $request->input('to');
        $selectedColumns = ['product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price'];
        switch ($types) {

            case 'stocks':
                // $selectedColumns = ['product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price'];
                $stocks = DB::table('inventories')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price') // Replace with the column names you want to select
                    ->where('stocks', '!=', 0)
                    ->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$from, $to])
                    ->get();
                // dd($stocks);
                if ($stocks->count() > 0) {
                    $names = ['Type', 'Name', 'Stocks', 'Pack', 'Price'];
                    $pdfId = $this->generateTablePdf($stocks, $names,  $types, $from, $to);
                    return response()->json(['names' => $names, 'value' => $stocks, 'id' => $pdfId]);
                }

                $notification = [
                    'status' => 'error',
                    'message' => 'No data found!',
                ];
                // Convert the notification to JSON
                $notificationJson = json_encode($notification);
                return response()->json(['notification' => $notificationJson], 500);

            case 'purchased':
                $purchased = DB::table('invoices')
                    ->join('inventories', 'invoices.inventories_id', '=', 'inventories.id')
                    ->select(
                        'inventories.id as id',
                        'inventories.product_name as product_type',
                        'invoices.sold_to as product_name',
                        'invoices.quantity as stocks',
                        'invoices.price as product_pcs_price',
                        'invoices.date as product_pack_price'
                    )
                    ->orderBy('invoices.created_at', 'asc')
                    ->get();

                if ($purchased->count() > 0) {
                    $names = ['Product Name', 'Buyer', 'Quantity', 'Price', 'Date'];
                    $pdfId = $this->generateTablePdf($purchased, $names,  'Purchased', $from, $to);
                    return response()->json(['names' => $names, 'value' => $purchased, 'id' => $pdfId]);
                }

                $notification = [
                    'status' => 'error',
                    'message' => 'No data found!',
                ];
                // Convert the notification to JSON
                $notificationJson = json_encode($notification);
                return response()->json(['notification' => $notificationJson], 500);

            case 'rejected':
                $rejected = DB::table('rejecteds')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                    ->orderBy('created_at', 'asc')
                    ->get();
                if ($rejected->count() > 0) {
                    $names = ['Type', 'Name', 'Stocks', 'Pack', 'Price'];
                    $pdfId = $this->generateTablePdf($rejected, $names,  'Purchased', $from, $to);
                    return response()->json(['names' => $names, 'value' => $rejected, 'id' => $pdfId]);
                }

                $notification = [
                    'status' => 'error',
                    'message' => 'No data found!',
                ];
                // Convert the notification to JSON
                $notificationJson = json_encode($notification);
                return response()->json(['notification' => $notificationJson], 500);

            case 'out':
                $out = DB::table('inventories')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                    ->where('stocks', 0)
                    ->orderBy('created_at', 'asc')
                    ->get();
                if ($out->count() > 0) {
                    $names = ['Type', 'Name', 'Stocks', 'Pack', 'Price'];
                    $pdfId = $this->generateTablePdf($out, $names,  'Purchased', $from, $to);
                    return response()->json(['names' => $names, 'value' => $out, 'id' => $pdfId]);
                }

                $notification = [
                    'status' => 'error',
                    'message' => 'No data found!',
                ];
                // Convert the notification to JSON
                $notificationJson = json_encode($notification);
                return response()->json(['notification' => $notificationJson], 500);

            case 'all':
                // dd('dwadwadwad');
                $stocks = DB::table('inventories')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price') // Replace with the column names you want to select
                    ->where('stocks', '!=', 0)
                    ->orderBy('created_at', 'asc')
                    ->get();

                $purchased = DB::table('invoices')
                    ->join('inventories', 'invoices.inventories_id', '=', 'inventories.id')
                    ->select(
                        'inventories.id as id',
                        'inventories.product_name as product_type',
                        'invoices.sold_to as product_name',
                        'invoices.quantity as stocks',
                        'invoices.price as product_pcs_price',
                        'invoices.date as product_pack_price'
                    )
                    ->orderBy('invoices.created_at', 'asc')
                    ->get();
                    
                $rejected = DB::table('rejecteds')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                    ->orderBy('created_at', 'asc')
                    ->get();

                $out = DB::table('inventories')
                    ->select('id', 'product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                    ->where('stocks', 0)
                    ->orderBy('created_at', 'asc')
                    ->get();
                    
                    $all = [
                        'stocks' => $stocks,
                        'purchased' => $purchased,
                        'rejected' => $rejected,
                        'out' => $out,
                    ];
                    $keyLabel = ['Available Stocks','Purchased Products','Rejected Products','Out Of Stocks'];
                    $all2 = [
                        (!empty($stocks) ? $keyLabel[0] : '') => $stocks,
                        (!empty($purchased) ? $keyLabel[1] : '') => $purchased,
                        (!empty($rejected) ? $keyLabel[2] : '') => $rejected,
                        (!empty($out) ? $keyLabel[3] : '') => $out,
                    ];
                    // Remove elements with empty Laravel collections
                    $all2 = collect($all2)->reject(function ($value) {
                        return $value->isEmpty();
                    })->toArray();

                // dd($all2);
                
                    $names = ['Type', 'Name', 'Stocks', 'Pack', 'Price'];
                    $pdfId = $this->generateTablePdfAll($all2, $names, Carbon::now());
                    return response()->json(['names' => $names, 'value' => $all, 'id' => $pdfId]);
                


            default:
                # code...
                break;
        }
    }

    // create pdf
    public function generated(Request $request)
    {
        dd($request);
    }

    // public function generatedPdf($data, $names, $types)
    // {
    //     $fpdf = new Fpdf('P', 'mm', 'A4');
    //     $fpdf->AddPage();

    //     // Header
    //     $fpdf->SetFont('Courier', 'B', 18);
    //     $fpdf->Cell(0, 10, 'MadTrack ' . $types . ' Report', 0, 1, 'C');
    //     $fpdf->SetFont('Courier', '', 12);
    //     $fpdf->Cell(0, 5, 'From: 2023-22-22 | To: 2023-22-23', 0, 1, 'C');
    //     $fpdf->Ln(10);

    //     // Column Names
    //     $columnWidth = 190 / count($names); // Adjust this width as needed
    //     $fpdf->SetFont('Arial', 'B', 12);
    //     foreach ($names as $name) {
    //         $fpdf->Cell($columnWidth, 10, $name, 1, 0, 'C');
    //     }
    //     $fpdf->Ln(); // Move to the next row

    //     // Data Rows
    //     $fpdf->SetFont('Arial', '', 10);
    //     $bgColor = 211; // Initial background color (gray)
    //     foreach ($data as $value) {
    //         // Set the background color
    //         $fpdf->SetFillColor($bgColor, $bgColor, $bgColor);
    //         $bgColor = $bgColor === 211 ? 255 : 211; // Alternate background color

    //         $product_type = $value->product_type;
    //         $product_name = $value->product_name;
    //         $stocks = $value->stocks;
    //         $product_pcs_price = $value->product_pcs_price;
    //         $product_pack_price = $value->product_pack_price;

    //         // Define a maximum character limit for each cell
    //     $maxChars = 10; // Adjust this value as needed

    //     // Truncate or shrink the text if it's too long
    //     if (strlen($product_type) > $maxChars) {
    //         $product_type = substr($product_type, 0, $maxChars);
    //     }

    //     if (strlen($product_name) > $maxChars) {
    //         $product_name = substr($product_name, 0, $maxChars);
    //     }

    //     if (strlen($stocks) > $maxChars) {
    //         $stocks = substr($stocks, 0, $maxChars);
    //     }

    //     if (strlen($product_pcs_price) > $maxChars) {
    //         $product_pcs_price = substr($product_pcs_price, 0, $maxChars);
    //     }

    //     if (strlen($product_pack_price) > $maxChars) {
    //         $product_pack_price = substr($product_pack_price, 0, $maxChars);
    //     }

    //     $fpdf->Cell($columnWidth, 10, $product_type, 0, 0, 'C', true);
    //     $fpdf->Cell($columnWidth, 10, $product_name, 0, 0, 'C', true);
    //     $fpdf->Cell($columnWidth, 10, $stocks, 0, 0, 'C', true);
    //     $fpdf->Cell($columnWidth, 10, $product_pcs_price, 0, 0, 'C', true);
    //     $fpdf->Cell($columnWidth, 10, $product_pack_price, 0, 0, 'C', true);
    //         $fpdf->Ln(); // Move to the next row
    //     }

    //     // Output the PDF
    //     $uniqueId = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    //     $fpdf->Output('F', public_path('reports/') . $uniqueId . '.pdf');

    //     return $uniqueId;
    // }

    public function generateTablePdf($datas, $names, $types, $from, $to)
    {

        $pdf = new GenerateTable('P', 'mm', 'A4', $from, $to); //custom class for generating table
        // $fpdf = new Fpdf('P', 'mm', 'A4');
        $pdf->AddPage();
        $bgColor = 211; // Initial background color (gray)
        // Header
        $pdf->SetFont('Courier', 'B', 18);
        $pdf->Cell(0, 10, 'MadTrack ' . $types . ' Report', 0, 1, 'C');
        $pdf->SetFont('Courier', '', 12);
        $pdf->Cell(0, 5, 'From: ' . $from . ' | To: ' . $to, 0, 1, 'C');
        $pdf->Ln(10);

        // get the title for next page
        $pdf->getHeader($types);
        $pdf->SetFont('Courier', '', 14);
        $columnWidth = 190 / count($names); // Adjust this width as needed
        $pos = 'C';
        foreach ($names as $name) {
            if($name === 'Type'){
                $pos = 'L';
            }elseif($name === 'Name'){
                $pos = 'L';
            }else{
                $pos = 'C';
            }
            // Set the background color
            $pdf->SetFillColor(211, 211, 211);
            $pdf->Cell($columnWidth, 10, $name, 0, 0, $pos, true);
        }
        $pdf->Ln(12); // Move to the next row

        $pdf->SetFont('Courier', '', 12);

        $pdf->SetWidths(array(37, 60, 31, 31, 31)); //set width for each column (6)

        $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L', 'L'));
        $pdf->SetLineHeight(6); //hieght of each lines, not rows

        $json = file_get_contents(public_path('MOCK_DATA.json')); //read data
        $data = json_decode($json, true);

        foreach ($datas as $item) {

            //write data using Row() methiod containing array of value
            //    $pdf->Row(Array(
            //         'PRD-'.$item['id'],
            //         $item['first_name'],
            //         $item['last_name'],
            //         $item['email'],
            //         $item['gender'],
            //         $item['address'],
            //    ));

            $pdf->Row(array(
                // $item->id,
                $item->product_type,
                $item->product_name,
                $item->stocks,
                $item->product_pcs_price,
                $item->product_pack_price,
            ));
        }

        // Output the PDF
        $uniqueId = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $pdf->Output('F', public_path('reports/') . $uniqueId . '.pdf');

        //save it to database
        $report = Report::create(['path' => $uniqueId . '.pdf']);

        return $uniqueId;
        // $pdf->Output();
    }
   
    public function generateTablePdfAll($datas, $names, $from)
    {
        $pdf = new GenerateTable('P', 'mm', 'A4');
        
    
        // // Header
        // $pdf->AddPage();
        
    
        foreach ($datas as $type => $typeData) {
            
            // Add a new page for each $typeData
            $pdf->AddPage();
            $pdf->SetFont('Courier', 'B', 18);
            $pdf->Cell(0, 10, 'MadTrack Report', 0, 1, 'C');
            $pdf->SetFont('Courier', '', 12);
            $pdf->Cell(0, 5, 'From: ' . $from, 0, 1, 'C');
            $pdf->Ln(10);
            // Dynamic header based on type
            $pdf->SetFont('Courier', 'B', 14);
    
            // Check if there are no records for the type
            if (empty($typeData)) {
                // Display a red header indicating "No records"
                $pdf->SetFillColor(255, 0, 0);
                $pdf->Cell(0, 10, 'Type: ' . $type . ' - No records', 0, 1, 'L', true);
                $pdf->Ln(5);
    
                // Skip displaying the table header
                continue;
            }
    
            // Display the regular header
            $pdf->SetFillColor(211, 211, 211);
            $pdf->Cell(0, 10, 'Report : ' . $type, 0, 1, 'L');
            $pdf->Ln(5);
    
            $pdf->SetFont('Courier', '', 14);
            $columnWidth = 190 / count($names);
            $pos = 'C';
            foreach ($names as $name) {
                if($name === 'Type'){
                    $pos = 'L';
                }elseif($name === 'Name'){
                    $pos = 'L';
                }else{
                    $pos = 'C';
                }
                $pdf->SetFillColor(211, 211, 211);
                $pdf->Cell($columnWidth, 10, $name, 0, 0, $pos, true);
            }
    
            $pdf->Ln(12);
    
            $pdf->SetFont('Courier', '', 12);
            $pdf->SetWidths(array(37, 60, 31, 31, 31));
            $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L', 'L'));
            $pdf->SetLineHeight(6);
    
            foreach ($typeData as $item) {
                $pdf->Row(array(
                    // $item->id,
                    $item->product_type,
                    $item->product_name,
                    $item->stocks,
                    $item->product_pcs_price,
                    $item->product_pack_price,
                ));
            }
        }
    
        // Output the combined PDF
        $uniqueId = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $pdf->Output('F', public_path('reports/') . $uniqueId . '.pdf');
    
        // Save it to the database (optional)
        $report = Report::create(['path' => $uniqueId . '.pdf']);
    
        return $uniqueId;
    }
    

    //delete
    public function deletePdf($filename)
{
   

    try {
        $report = Report::findOrFail($filename); // Assuming $filename is the ID
        $report->delete();
        return response()->json(['success' => true, 'message' => 'PDF deleted successfully']);
        
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
    
    
}
