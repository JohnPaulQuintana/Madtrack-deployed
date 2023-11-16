<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Qrcodemodel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StaffController extends Controller
{
    public function employeeTableAdd(Request $request)
    {
        // dd($request);
        $existEmployee = Staff::where('first_name', $request->input('fName'))
            ->where('middle_name', $request->input('mName'))
            ->where('last_name', $request->input('lName'))
            ->first();

        if ($existEmployee) {
            // Prepare the toast notification data
            $notification = [
                'status' => 'error',
                'message' => 'Your already added this employee!',
            ];

            // Convert the notification to JSON
            $notificationJson = json_encode($notification);
            return redirect()->route('employee.table')->with('notification', $notificationJson);
        }

        $employee = Staff::create([
            'first_name' => $request->input('fName'),
            'last_name' => $request->input('lName'),
            'middle_name' => $request->input('mName'),
            'birthdate' => $request->input('bdate'),
            'gender' => $request->input('gender'),
            'contact' => $request->input('contact'),
            'hired' => $request->input('datehired'),
        ]);

        $fullname = $employee->first_name .' '. $employee->last_name;
        $bdate = $employee->birthdate;
        $datehired = $employee->hired;
        //generate qrcodes
        $qrCodeDataGenerate = "Id: $employee->id, Name: $fullname, BirthDate: $bdate, Hired: $datehired";
        $qrCode = (string)QrCode::format('png')
        // ->mergeString(public_path('logo/logo.png'), .3)
        ->size(250)
        ->backgroundColor(255, 255, 255)
        ->color(0, 0, 0)   
        ->generate($qrCodeDataGenerate);
        // Save the QR code image to the public folder
        $qrCodePath = public_path('qrcodes/' . 'EMP'.$employee->id . '.png');
        file_put_contents($qrCodePath, $qrCode);

        $existQrcodes = Qrcodemodel::where('staff_id','=',$employee->id)->first();
        if (!$existQrcodes) {
            //insert it to qrcodes table
            $qrcodeTable = Qrcodemodel::create([
                'staff_id'=>$employee->id, 
                'path'=>'qrcodes/' . 'EMP'.$employee->id . '.png',
            ]);
        }
        
        // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => 'Successfully Added a new employee!',
        ];

        // Convert the notification to JSON
        $notificationJson = json_encode($notification);
        return redirect()->route('employee.table')->with('notification', $notificationJson);
    }
}
