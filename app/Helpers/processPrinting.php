<?php 


    namespace App\Helpers;
    use App\Models\Report;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Session;
    class ProcessPrinting{
        private $modelClass;
        private $inventory;
        private $subquery;
        private $keywords;
        private $message;
        private $formattedResult;
        private $action;
        private $pdfId;

        private $todayDate;

        private $name = ['Type', 'Name', 'Stocks', 'Pack', 'Price'] ;
        public function __construct($prt){
            $this->inventory = $prt;
            $this->modelClass = 'App\\Models\\' . $this->inventory['answer']['model'];
            $this->subquery = $this->inventory['answer']['subquery'];
            $this->keywords = $this->inventory['utteranceText'];
            $this->todayDate = Carbon::now();
        }

        public function getProductsForPrinting(){
            $tdate = $this->todayDate->format('Y-m-d');
            try {
                // dd($this->inventory);
                switch ($this->subquery) {
                    case 'print.all'://print all available
                        $data = $this->modelClass::where($this->inventory['answer']['include-print'], '!=', 0)
                        ->select('id','product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                        ->get();
                        $this->pdfId = $this->generateTablePdf($data, $this->name,  "Available Product", $tdate);
                        $count = count($data);
                        if($count > 0){
                            $this->message = "We have a total product of {$count}!.  Printing process in progress... ";
                            $this->action = 'printing.all';
                        }else{
                            $this->message = "Printing process in queue i cant find all the products available!... ";
                            $this->action = 'printing.none';
                        }
                        
                        break;
                    
                    case 'print.only'://selected product only
                        $data = $this->modelClass::where($this->inventory['answer']['include-print'], '!=', 0)
                        ->where('product_name', $this->keywords)
                        ->select('id','product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                        ->get();
                        $this->pdfId = $this->generateTablePdf($data, $this->name,  "Available {$this->keywords}", $tdate);
                        $count = count($data);
                        if($count > 0){
                            $this->message = "We have a total of {$count} {$this->keywords}!.  Printing process in progress... ";
                            $this->action = 'printing.all';
                        }else{
                            $this->message = "Printing process in queue i cant find all the products available!... ";
                            $this->action = 'printing.none';
                        }
                        break;
                    case 'print.outofstock.all'://print all out of stock
                        $data = $this->modelClass::where($this->inventory['answer']['include-print'], 0)
                        ->where('product_name', $this->keywords)
                        ->select('id','product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                        ->get();
                        $this->pdfId = $this->generateTablePdf($data, $this->name,  "Out-Of-Stocks", $tdate);
                        $count = count($data);
                        if($count > 0){
                            $this->message = "We have a total of {$count} Out-Of-Stocks Product!.  Printing process in progress... ";
                            $this->action = 'printing.all';
                        }else{
                            $this->message = "Printing process in queue i cant find all the products available!... ";
                            $this->action = 'printing.none';
                        }
                        break;
                    case 'print.rejected.all'://print all rejected
                        $data = $this->modelClass::select('id','product_type', 'product_name', 'stocks', 'product_pcs_price', 'product_pack_price')
                        ->get();
                        $this->pdfId = $this->generateTablePdf($data, $this->name,  "Rejected Products", $tdate);
                        $count = count($data);
                        if($count > 0){
                            $this->message = "We have a total of {$count} Out-Of-Stocks Product!.  Printing process in progress... ";
                            $this->action = 'printing.all';
                        }else{
                            $this->message = "Printing process in queue i cant find all the products available!... ";
                            $this->action = 'printing.none';
                        }
                        break;
                    case 'print.purchased.all'://print all rejected
                        $data = $this->modelClass::select(
                            'invoices.id', 'invoices.inventories_id', 
                            'inventories.product_name as product_type', 'invoices.sold_to as product_name', 
                            'invoices.quantity as stocks', 'invoices.price as product_pcs_price', 
                            'invoices.date as product_pack_price')
                        ->join('inventories', 'invoices.inventories_id', '=', 'inventories.id')
                        ->get();

                        $this->pdfId = $this->generateTablePdf($data, ['Id','Product', 'Buyer', 'Quantity', 'Price', 'Date'],  "Purchased Products", $tdate);
                        $count = count($data);
                        if($count > 0){
                            $this->message = "We have a total of {$count} Purchased Product!.  Printing process in progress... ";
                            $this->action = 'printing.all';
                        }else{
                            $this->message = "Printing process in queue i cant find all the products available!... ";
                            $this->action = 'printing.none';
                        }
                        break;
                    default:
                        dd('there is no subquery availables');
                        break;
                }

                // Store subquery in session
                Session::put('subquery', $this->subquery);
                Session::put('print', $this->keywords);
                // Remove the trailing comma and whitespace
                $this->formattedResult = [
                    // 'answer' =>$total. implode(', ', $formattedResponse),
                    'answer' => $this->message,
                    'init' => $this->message,
                    'action' => $this->action,
                    'report_id'=>$this->pdfId,
                ];
                // dd($this->formattedResult);
                return $this->formattedResult;
            } catch (\Throwable $th) {
                return ['error' => 'An error occurred.'];
            }
            
        }

        public function generateTablePdf($datas, $names, $types, $tdate){
        
            $pdf = new GenerateTable('P', 'mm', 'A4');//custom class for generating table
            // $fpdf = new Fpdf('P', 'mm', 'A4');
            $pdf->AddPage();
            $bgColor = 211; // Initial background color (gray)
            // Header
            $pdf->SetFont('Courier', 'B', 18);
            $pdf->Cell(0, 10, 'MadTrack ' . $types . ' Report', 0, 1, 'C');
            $pdf->SetFont('Courier', '', 12);
            $pdf->Cell(0, 5, 'Date Created: '.$tdate, 0, 1, 'C');
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
    
            $pdf->SetFont('Courier','',12);
    
            $pdf->SetWidths(array(37, 60, 31, 31, 31)); //set width for each column (6)
    
            $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L'));
            $pdf->SetLineHeight(6);//hieght of each lines, not rows
    
            $json = file_get_contents(public_path('MOCK_DATA.json'));//read data
            $data = json_decode($json,true);
    
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
    
               $pdf->Row(Array(
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
            $report = Report::create(['path'=>$uniqueId . '.pdf']);
            return $uniqueId;
            // $pdf->Output();
        }
    }
?>