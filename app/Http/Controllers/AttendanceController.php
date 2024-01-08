<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Timein;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Libern\QRCodeReader\QRCodeReader;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AttendanceController extends Controller
{
    // get the image name base on face label matched
    public function imageName(Request $request)
    {

        $folderPath = public_path('backend/face/labels');
        $subfolderNames = collect(File::directories($folderPath))->map(function ($directory) {
            return pathinfo($directory)['basename'];
        })->toArray();


        return response()->json(['subFolder' => $subfolderNames]);
    }


    public function storedAttendance(Request $request)
    {

        
        // Define the time ranges
        $currentTime = Carbon::now();
        $timeInStart = Carbon::createFromTime(8, 0, 0);       // 8:00 AM
        $timeInEnd = Carbon::createFromTime(12, 30, 0);        // 12:30 PM
        $timeOutStart = Carbon::createFromTime(13, 0, 0);       // 1:00 PM
        $timeOutEnd = Carbon::createFromTime(7, 0, 0)->addDay();         // 7:00 AM of the next day
        $action = null;
        // dd($currentTime);
        // Check if user already recorded time-in for the current day within the range
        $attendanceRecords = Attendance::where('employee_name', $request->input('label'))
            ->where('month', now()->month)
            ->where('day', now()->day)
            ->whereNotNull('time_in')
            ->latest()
            ->first();

        $publicDirectory = public_path("backend/face/labels/{$request->input('label')}");
            // Get all files in the folder
            $files = array_diff(scandir($publicDirectory), ['.', '..']);

            // Find the last index
            $lastIndex = 0;
            $imageName = '';
            foreach ($files as $file) {
                $index = pathinfo($file, PATHINFO_FILENAME);
                if (is_numeric($index) && $index > $lastIndex) {
                    $lastIndex = $index;
                }
            }


            // Increment the last index to generate a new file name
            $newIndex = $lastIndex + 1;

            // Retrieve the image file from the request
            $image = $request->file('image');

            // Set the public path and image name
            $publicPath = public_path("backend/face/captured/{$request->input('label')}");
            // Replace spaces and colons with underscores
            // $formattedTime = str_replace([' ', ':'], '_', $request->input('formattedTime'));

            $imageName = $newIndex . ".jpg"; // You can adjust the file name and extension

            // Ensure the directory exists
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            // Save the image to the public folder
            $image->move($publicPath, $imageName);

        // Check if the current time is within the time-in range
        if ($currentTime->between($timeInStart, $timeInEnd)) {
            if (!$attendanceRecords) {
                $attendance = Attendance::create([
                    'status' => 'P',
                    'time_in' => $request->input('formattedTime'),
                    'day' => now()->day,
                    'month' => now()->month,
                    'year' => now()->year,
                    'employee_name' => $request->input('label'),
                    'captured' => "backend/face/captured/{$request->input('label')}/{$newIndex}.jpg",
                ]);

                // Assuming your model is named User and your columns are first_name and last_name
                $staff = Staff::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$request->input('label')])->first();
                // dd($staff);
                $staff->update([
                    'present' => 1,
                ]);

                $action = 'Time-In';
                
            }
        }else{
            $action = null;
        }

        // Check if the current time is within the time-out range
        if ($currentTime->between($timeOutStart, $timeOutEnd)) {
            if (!$attendanceRecords || $attendanceRecords->time_out === null) {
                // dd('ginagawa');
                if ($attendanceRecords) {
                    $attendanceRecords->update([
                        'time_out' => $request->input('formattedTime'),
                        // other fields...
                    ]);
                }

                // Assuming your model is named User and your columns are first_name and last_name
                $staff = Staff::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$request->input('label')])->first();
                // dd($staff);
                $staff->update([
                    'present' => 0,
                ]);
                $action = 'Time-Out';
               
            }
        }else{
            $action = null;
        }

        
        // Return a response with the URL or any other information as needed
        return response()->json(['action' => $action]);
    }

    //stored timein
    public function attendance(Request $request)
    {
        // dd($request);
        $today = Carbon::now()->toDateString(); //toDateTimeString -> including H:m:s

        // Check if the user exists in the users table chnage when you have id on qrcode
        $registeredEmployee = Staff::find($request->input('Id'));
        // dd($registeredEmployee);
        if (!$registeredEmployee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your not registered Employee ask the administrator.',
            ]);
        }

        $modelClass = 'App\\Models\\' . $request->input('model');
        $query = $request->input('query');
        // Check if user already recorded attendance for the current day
        $alreadyAttendance = $modelClass::where('employee_id', $request->input('Id'))
            ->whereDate($request->input('query'), $today)
            ->whereNotNull($request->input('query'))  // Additional check to ensure 'time_in' is not null
            ->first();

        $alreadytimein = Timein::where('employee_id', $request->input('Id'))
            ->whereDate('timein', $today)
            ->whereNotNull('timein')  // Additional check to ensure 'time_in' is not null
            ->first();

        if (!$alreadyAttendance) {
            // Store the data in your database using the Attendance model
            // dd('ginagawa');
            if ($query === 'timeout') {
                if (!$alreadytimein) {
                    return response()->json([
                        'status' => 'default',
                        'message' => "You are not able to do timeout unless you're already timein.",
                    ]);
                } else {
                    $attendance = $modelClass::create([
                        'status' => 'P',
                        'day' => now()->day, // Current day
                        'month' => now()->month, // Current month
                        'year' => now()->year, // Current year
                        'employee_id' => $request->input('Id'),
                        $query => now()->toDateTimeString(),
                    ]);
                }
            } else {
                $attendance = $modelClass::create([
                    'status' => 'P',
                    'day' => now()->day, // Current day
                    'month' => now()->month, // Current month
                    'year' => now()->year, // Current year
                    'employee_id' => $request->input('Id'),
                    $query => now()->toDateTimeString(),
                ]);
            }

            // Parse and format the time_in to "12:00:00 AM" format
            $formattedTime = Carbon::parse($attendance->timein)->format('h:i:s A');

            // Format the day as a two-digit string
            $formattedDay = Carbon::parse($attendance->timein)->format('d');

            // Format the month as its textual representation (January to December)
            $formattedMonth = Carbon::parse($attendance->timein)->formatLocalized('%B');


            if ($request->input('query') === 'timein') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Time-in recorded successfully!',
                    'credentials' => [
                        'name' => $registeredEmployee->first_name . ' ' . $registeredEmployee->last_name,
                        'day' => $formattedDay,
                        'month' => $formattedMonth,
                        'year' => now()->year,
                        'time_in' => $formattedTime,
                    ]
                ]);
            } else if ($request->input('query') === 'timeout') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Time-out recorded successfully!',
                    'credentials' => [
                        'name' => $registeredEmployee->first_name . ' ' . $registeredEmployee->last_name,
                        'day' => $formattedDay,
                        'month' => $formattedMonth,
                        'year' => now()->year,
                        'time_in' => $formattedTime,
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'default',
                    'message' => "You are not able to take timeout unless you're already timein.",
                ]);
            }
        } else {

            return response()->json([
                'status' => 'already',
                'message' => 'You have already recorded your attendance for today.',
            ]);
        }
    }

    //get attendance
    public function employeeTableAttendance(Request $request)
    {
        // dd($request->input('id'));
        // Assuming your model is named User and your columns are first_name and last_name
        $staff = Staff::where('id',$request->input('id'))->first();

        $attendance = Attendance::where("employee_name", $staff->first_name.' '.$staff->last_name)->get();

        $attendanceData = $attendance->map(function ($attendanceItem) {
            return [
                'captured' => $attendanceItem->captured, 
                'day' => $attendanceItem->day,
                'events' => [['title'=>'Time-In','time'=>$attendanceItem->time_in ?? 'not-taken'],['title'=>'Time-Out','time'=>$attendanceItem->time_out ?? 'not-taken']],
                'month' => $attendanceItem->month,
                'year' => $attendanceItem->year,
            ];
        });

        // dd($attendance);
        return response()->json(['attendances' => $attendanceData]);
    }

    //get per day
    public function attendanceRecord(Request $request)
    {
        $id = $request->input('id');
        $day = $request->input('day');
        $recordperday = Timein::leftJoin('timeouts', 'timeins.employee_id', '=', 'timeouts.employee_id')
            ->where('timeins.day', $day)
            ->where('timeins.employee_id', $id)
            // ->where('timeouts.created_at', Carbon::now())
            ->select('timeins.*', 'timeouts.timeout')
            ->get();
        // dd($recordperday);
        return response()->json(['perday' => $recordperday]);
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
