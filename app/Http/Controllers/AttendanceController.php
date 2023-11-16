<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Libern\QRCodeReader\QRCodeReader;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AttendanceController extends Controller
{
    public function storedAttendance(Request $request)
    {
        // dd($request);
        // Get the parsed data from the request
        $parsedData = $request->all();
        $today = Carbon::now()->toDateString(); //toDateTimeString -> including H:m:s

        // Check if the user exists in the users table chnage when you have id on qrcode
        $registeredEmployee = User::find(2);
        if (!$registeredEmployee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your not registered Employee ask the administrator.',
            ]);
        }
        // Check if user already recorded attendance for the current day
        $alreadyAttendance = Employee::where('employee_id', 2)
            ->whereDate('time_in', $today)
            ->orderBy('time_in', 'desc') // Order by time_in in descending order
            ->first();

        if (!$alreadyAttendance) {
            // Store the data in your database using the Attendance model
            $attendance = Employee::create([
                'status' => 'present',
                'day' => now()->day, // Current day
                'month' => now()->month, // Current month
                'year' => now()->year, // Current year
                'time' => now()->format('H:i:s'), // Current time
                'employee_id' => 2, // Assuming a fixed employee ID for now, chnage this when qr have the id
                'time_in' => now()->toDateTimeString(),
            ]);
            // Return response with credentials
            // Parse and format the time_in to "12:00:00 AM" format
            $formattedTime = Carbon::parse($attendance->time_in)->format('h:i:s A');

            // Format the day as a two-digit string
            $formattedDay = str_pad($attendance->day, 2, '0', STR_PAD_LEFT);

            // Format the month as its textual representation (January to December)
            $formattedMonth = Carbon::create(null, $attendance->month)->formatLocalized('%B');

            
            return response()->json([
                'status' => 'success',
                'message' => 'Attendance recorded successfully!',
                'credentials' => [
                    'email' => $parsedData['Email'],
                    'name' => $parsedData['Name'],
                    'day' => $formattedDay,
                    'month' => $formattedMonth,
                    'year' => $attendance->year,
                    'time_in' => $formattedTime,
                ]
            ]);
        }else{
            // Return message if attendance already recorded
            return response()->json([
                'status' => 'already',
                'message' => 'You have already recorded your attendance for today.',
            ]);
        }
    }

    //get attendance
    public function employeeTableAttendance(Request $request){
        // dd($request->input('id'));
        $attendanceRecords = Staff::leftJoin('attendances', 'staff.id', '=', 'attendances.staff_id')
        ->where('staff.id', $request->input('id'))
        ->orderBy('attendances.created_at', 'desc')
        ->select('attendances.*', 'staff.first_name', 'staff.last_name')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('F');
        });

    

        return response()->json(['attendances'=>$attendanceRecords]);
    }

    public function processScan(Request $request)
    {
        $scannedData = $request->input('scanned_data'); // Data scanned from QR code

        // Process scanned data, update attendance records, etc.

        return redirect()->route('attendance')->with(['success' => 'Attendance recorded.', 'scan' =>  $scannedData]);
    }

    public function viewAttendance()
    {
        // Retrieve and display attendance records

        return view('admin.attendance.attendance');
    }

    // for now we used upload
    public function uploadQR(Request $request)
    {
        dd($request->qr_code_image);
        $request->validate([
            'qr_code_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // destination
        $destinationPath = 'qrcodes';
        // qrnames
        $myqrcodes = $request->qr_code_image->getClientOriginalName();
        // move to
        $request->qr_code_image->move(public_path($destinationPath), $myqrcodes);

        // qr decoder
        $QRCodeReader = new QRCodeReader();
        // qr value for image path or url
        $qrcode_text = $QRCodeReader->decode(public_path($destinationPath . '/' . $myqrcodes));
        // qr value for image stream
        // $qrcode_text = $QRCodeReader->decode(base64_encode("image_stream"));
        // dd($qrcode_text);
        return response()->json(['success' => 'QR code uploaded successfully.', 'qrcode' => $qrcode_text]);
    }

    // generate qrcodes
    public function generateQRCode($qrCodeData)
    {
        $qrCode = QrCode::size(250)
            ->backgroundColor(255, 255, 255) // Light green background color
            ->color(0, 102, 0)
            ->generate($qrCodeData);

        return $qrCode;
    }
}
