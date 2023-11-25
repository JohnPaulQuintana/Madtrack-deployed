<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Qrcodemodel;
use BaconQrCode\Encoder\QrCode;
// use App\Helpers\GenerateTable;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function processQrcodes(Request $request){
        // Use the $request object to access the 'ids' parameter
        $ids = $request->route('id');
        // Convert the comma-separated string of IDs to an array
        $idArray = explode(',', $ids);
        // dd($idArray);
        // Use the array of IDs to retrieve data from the database
        $qrcodes = Qrcodemodel::whereIn('staff_id', $idArray)
        ->join('staff', 'qrcodemodels.staff_id', '=', 'staff.id')
        ->select('qrcodemodels.*', 'staff.first_name', 'staff.last_name')
        ->get();
        // dd($qrcodes);
        $pdfPath = $this->generateQRCodesPdf($qrcodes);

        $updatesQrStatus = Qrcodemodel::whereIn('staff_id', $idArray)
        ->update(['status' => 1]);
        return response()->json(['path'=>$pdfPath]);

    }

    //updates qrcodes
    public function updateQrcodes(Request $request){    
        $ids = $request->route('id');
        // dd($request);
        // Convert the comma-separated string of IDs to an array
        $idArray = explode(',', $ids);
        // dd($idArray);
        $updatesQrStatus = Qrcodemodel::whereIn('staff_id', $idArray)
        ->update(['status' => 0]);

        if(file_exists(public_path($request->input('path')))){
            unlink(public_path($request->input('path')));
        }else{
            dd('there is no file');
        }

       return response()->json(['message'=>'not generated']);
    }

    public function generateQRCodesPdf($qrCodeData)
    {
        $pdf = new Fpdf('P', 'mm', 'A4');//custom class for generating table
        $pdf->SetMargins(10, 10, 10); // Set left, top, and right margins to 10mm
        $pdf->AddPage();

        // Header
        $pdf->SetFont('Courier', 'B', 18);
        $pdf->Cell(0, 10, 'MadTrack Generated Qrcodes', 0, 1, 'C');
        $pdf->SetFont('Courier', '', 12);
        $pdf->Cell(0, 5, 'Date Created: '.Carbon::now()->format('Y-m-d'), 0, 1, 'C');
        $pdf->Ln(10);
    
        // Set the size and spacing for QR codes
        $qrCodeSize = 20;
        $spacing = 5;
    
        // Calculate the number of QR codes that can fit in a row
        //210 x 297 w and h in mm
        $qrCodesPerRow = floor((210 - 10 - 10) / ($qrCodeSize + $spacing));

        // Initial vertical position for QR codes below the header
        $initialY = $pdf->GetY();

        // Calculate the total number of rows needed
        $totalRows = ceil(count($qrCodeData) / $qrCodesPerRow);
    
        // Font settings for the name text
        $pdf->SetFont('Arial', 'B', 10);
    
        // Loop through the rows
        for ($row = 0; $row < $totalRows; $row++) {
            // Loop through the QR codes in the current row
            for ($col = 0; $col < $qrCodesPerRow; $col++) {
                $index = $row * $qrCodesPerRow + $col;
    
                // Check if there are more QR codes to process
                if ($index >= count($qrCodeData)) {
                    break;
                }
    
                // Calculate the position for the QR code
                $x = 10 + $col * ($qrCodeSize + $spacing);
                $y = $initialY + $row * ($qrCodeSize + $spacing);
    
                // add to the PDF
                $pdf->Image(public_path($qrCodeData[$index]->path), $x, $y, $qrCodeSize, $qrCodeSize);

                $fontSize = 10;
                // $verticalSpacing = 2;
                // Set Arial font
                $pdf->SetFont('Arial', 'B', $fontSize);
                $firstname = ucwords($qrCodeData[$index]->first_name);
                $lastname = ucwords($qrCodeData[$index]->last_name);

                // Calculate the position for the text
                $textWidthF = $pdf->GetStringWidth($firstname);
                $textHeightF = $fontSize / 2.54; // Convert from points to millimeters

               // Set position for the name text
                $pdf->SetXY($x + ($qrCodeSize - $textWidthF) / 2, $y + $qrCodeSize + 2);

                // Add the name text
                $pdf->Cell($textWidthF, $textHeightF, $firstname, 0, 0, 'C');

                $pdf->SetFont('Arial', '', $fontSize);
                // Calculate the position for the last name
                $textWidthL = $pdf->GetStringWidth($lastname);
                $textHeightL = $fontSize / 2.54; // Convert from points to millimeters

                // Set position for the last name text
                $pdf->SetXY($x + ($qrCodeSize - $textWidthL) / 2, $y + $qrCodeSize + 2 + $textHeightF + 0.5); // Adjust vertical spacing as needed

                // Add the last name text
                $pdf->Cell($textWidthL, $textHeightL, $lastname, 0, 0, 'C');
            }
        }

        // Generate a unique filename with a random 6-digit number
        $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    
        // Output the PDF
        $pdfPath = public_path('qrPdf/qrcodes_'.$randomNumber.'.pdf');
        $pdf->Output('F', $pdfPath);
    
        return 'qrPdf/qrcodes_'.$randomNumber.'.pdf';
    }
    
}
