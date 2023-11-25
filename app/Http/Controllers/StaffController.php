<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Qrcodemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'address' => $request->input('address'),
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

    // edit
    public function employeeTableEdit(Request $request){
        // dd($request);
        $emp = Staff::where('id', $request->input('id'))->first();
        return response()->json([
            'employee' => $emp,
        ]);
    }
    // update
    public function employeeTableUpdate(Request $request){
        $emp = Staff::find($request->input('id'));
         // Update the employee using the update method

         if($emp){
             // Get the existing QR code path
            $existingQrCodePath = public_path('qrcodes/EMP' . $emp->id . '.png');

            // Check if the existing QR code file exists before attempting to delete
            if (File::exists($existingQrCodePath)) {
                // Delete the existing QR code file
                File::delete($existingQrCodePath);
            }
            // Update the employee using the update method
            $emp->update([
                'first_name' => $request->input('fName'),
                'middle_name' => $request->input('mName'),
                'last_name' => $request->input('lName'),
                'birthdate' => $request->input('bdate'),
                'gender' => $request->input('gender'),
                'contact' => $request->input('contact'),
                'hired' => $request->input('datehired'),
                'status' => $request->input('status'),
                'address' => $request->input('address'),   
            ]);

            $fullname = $emp->first_name.' '.$emp->last_name;
            $bdate = $emp->birthdate;
            $datehired = $emp->hired;
            // Generate new QR code
            $qrCodeDataGenerate = "Id: $emp->id, Name: $fullname, BirthDate: $bdate, Hired: $datehired";
            $qrCode = (string)QrCode::format('png')
                ->size(250)
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->generate($qrCodeDataGenerate);

            // Save the new QR code image to the public folder
            $newQrCodePath = public_path('qrcodes/EMP' . $emp->id . '.png');
            file_put_contents($newQrCodePath, $qrCode);
         }
        
        // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => 'Successfully Updated employees information!',
        ];

        // Convert the notification to JSON
        $notificationJson = json_encode($notification);
        return redirect()->route('employee.table')->with('notification', $notificationJson);
    }

    //delete emplyoee
    public function employeeTableRemove(Request $request){
        $id = $request->input('id');
        // dd($request);
        // Assuming your model is named Staff
        $employee = Staff::find($id);
    
        $employee->delete();
    
        return response()->json(['status' => 'success']);
    }

}
