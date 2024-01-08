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

        $employees = Staff::paginate(10, ['*'], 'page');
        // $employees = table::('staff.id')
        // ->orderBy('created_at', 'desc')
        // ->select('staff.*', 'qrcodemodels.path', 'qrcodemodels.status')
        // ->get();


        $out = Inventory::where('stocks', '=', 0)
            ->orderBy('created_at','desc')
            ->get();
            
        return view('admin.employee.employee',['employees'=>$employees,'notifs'=>$out]);
    }
}
