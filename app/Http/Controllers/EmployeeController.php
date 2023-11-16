<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Inventory;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function employeeTable(){
        // $today = Carbon::now()->toDate();
     
        // $PresentEmployees = User::whereHas('employees', function ($query) {
        //     $query->whereNotNull('employee_id')
        //             ->whereDate('time_in', Carbon::now()->toDate()) // Filter by today's date
        //           ->latest('time_in'); // Order by the time_in column in descending order
        // })->with(['employees' => function ($query) {
        //     $query->whereNotNull('employee_id')
        //             ->where('status','present')
        //           ->latest('time_in')
        //           ->first(); // Get the latest employee record
        // }])->get();
        
        // foreach ($PresentEmployees as $user) {
        //     foreach ($user->employees as $employee) {
        //         $employee->time_in = Carbon::parse($employee->time_in)->format('h:i:s A');
        //         $employee->day = str_pad($employee->day, 2, '0', STR_PAD_LEFT);
        //         $employee->month = Carbon::create(null, $employee->month)->formatLocalized('%B');
        //     }
        // }

        // $employees = Staff::all();
        $employees = Staff::leftJoin('qrcodemodels', 'staff.id', '=', 'qrcodemodels.staff_id')
        ->orderBy('qrcodemodels.created_at', 'desc')
        ->select('staff.*', 'qrcodemodels.path', 'qrcodemodels.status')
        ->get();


        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at','desc')
            ->get();
            
        return view('admin.employee.employee',['employees'=>$employees,'notifs'=>$out]);
    }
}
