<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaction extends Controller
{
    // public function transaction()
    // {
    //     // Create a Carbon instance for the current date and time
    //     $currentDateTime = Carbon::now();

    //     // Get only the date portion in "Y-m-d" format
    //     $dateOnly = $currentDateTime->format('Y-m-d');

    //     // transaction
    //     $transactions = DB::table('transactions')
    //         ->select('*')
    //         ->whereDate('date', '=', $dateOnly)
    //         ->orderBy('date', 'desc')
    //         ->get();

    //     // notification
    //     $out = Inventory::where('stocks', '=', 0)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     // present employee
    //     $present = Employee::where('status','present')
    //         ->orderBy('time_in', 'desc')
    //         ->get();

    //     // Define your date ranges
    //     $endDate = Carbon::now();
    //     $startDateToday = $endDate->copy()->startOfDay();
    //     $startDateCurrentMonth = $endDate->copy()->startOfMonth();
    //     $startDatePrevMonth = $startDateCurrentMonth->copy()->subMonth();

    //     // Query to get the sum of prices for today and the previous month
    //     $invoicesToday = $this->getTotalSalesForDateRange($startDateToday, $endDate);
    //     $invoicesCurrentMonth = $this->getTotalSalesForDateRange($startDateCurrentMonth, $endDate);
    //     $invoicesPrevMonth = $this->getTotalSalesForDateRange($startDatePrevMonth, $startDateCurrentMonth->subDay());

    //     // Calculate the total sales for today and the previous month
    //     $totalSalesToday = $invoicesToday->sum('total_price');
    //     $totalSalesCurrentMonth = $invoicesCurrentMonth->sum('total_price');
    //     $totalSalesPrevMonth = $invoicesPrevMonth->sum('total_price');

    //     // Calculate the percentage for today's sales
    //     $percentageToday = $this->calculatePercentage($totalSalesCurrentMonth, $totalSalesToday);

    //     // Calculate the percentage for the current month's sales
    //     $percentageCurrentMonth = $this->calculatePercentage($totalSalesPrevMonth, $totalSalesCurrentMonth);

    //     // Calculate the percentage for the prev month's sales
    //     $percentagePrevMonth = $this->calculatePercentage($totalSalesCurrentMonth,$totalSalesPrevMonth);

    //     // Calculate the percentage change in total sales between the current and previous months
    //     $percentageChange = (($totalSalesCurrentMonth - $totalSalesPrevMonth) / $totalSalesPrevMonth) * 100;

    //     // Determine if sales are increasing, decreasing, or staying the same
    //     if ($percentageChange > 0) {
    //         $status = 'Increasing';
    //     } elseif ($percentageChange < 0) {
    //         $status = 'Decreasing';
    //     } else {
    //         $status = 'No Improvement';
    //     }

    //     // Create a result array with the desired format
    //     $result = [
    //         'totalSales' => number_format($totalSalesToday, 2),
    //         'percentageToday' => number_format($percentageToday, 2) . '%', // Percentage for today's sales
    //         'totalSalesCurrentMonth' => number_format($totalSalesCurrentMonth, 2),
    //         'percentageCurrentMonth' => number_format($percentageCurrentMonth, 2) . '%', // Corrected variable name
    //         'totalSalesPrevMonth' => number_format($totalSalesPrevMonth, 2),
    //         'percentagePrevMonth' => number_format($percentagePrevMonth, 2) . '%',
    //         'percentageChange' => number_format($percentageChange, 2) . '%', // Percentage change between current and previous months
    //         'salesStatus' => $status, // Add the status
    //     ];

    //     $employee = [
    //         'present'=>$present,
    //         'count'=>count($present)
    //     ];

    //     return view('admin.index', 
    //         ['transactions' => $transactions, 'notifs' => $out, 'sales_report' => $result,
    //         'employee'=>$employee]);
    // }

    public function transaction()
{
    // Create a Carbon instance for the current date and time
    $currentDateTime = Carbon::now();

    // Get only the date portion in "Y-m-d" format
    $dateOnly = $currentDateTime->format('Y-m-d');

    // transaction
    $transactions = DB::table('transactions')
        ->select('*')
        // ->whereDate('date', '=', $dateOnly)
        ->orderBy('created_at', 'desc')
        ->get();

    // notification
    $out = Inventory::where('stocks', '=', 0)
        ->orderBy('created_at', 'desc')
        ->get();

    // present employee
    $emp = Staff::where('status',1)
        ->get();

    // Define your date ranges
    $endDate = Carbon::now();
    $startDateToday = $endDate->copy()->startOfDay();
    $startDateCurrentMonth = $endDate->copy()->startOfMonth();
    $startDatePrevMonth = $startDateCurrentMonth->copy()->subMonth();

    // Query to get the sum of prices for today and the previous month
    $invoicesToday = $this->getTotalSalesForDateRange($startDateToday, $endDate);
    $invoicesCurrentMonth = $this->getTotalSalesForDateRange($startDateCurrentMonth, $endDate);
    $invoicesPrevMonth = $this->getTotalSalesForDateRange($startDatePrevMonth, $startDateCurrentMonth->subDay());

    // Calculate the total sales for today and the previous month
    $totalSalesToday = $invoicesToday->sum('total_price');
    $totalSalesCurrentMonth = $invoicesCurrentMonth->sum('total_price');
    $totalSalesPrevMonth = $invoicesPrevMonth->sum('total_price');

    // Calculate the percentage for today's sales
    $percentageToday = $this->calculatePercentage($totalSalesCurrentMonth, $totalSalesToday);

    // Calculate the percentage for the current month's sales
    $percentageCurrentMonth = $this->calculatePercentage($totalSalesPrevMonth, $totalSalesCurrentMonth);

    // Calculate the percentage for the prev month's sales
    $percentagePrevMonth = $this->calculatePercentage($totalSalesCurrentMonth,$totalSalesPrevMonth);

    // Calculate the percentage change in total sales between the current and previous months
    $percentageChange = $totalSalesPrevMonth !== 0 ? (($totalSalesCurrentMonth - $totalSalesPrevMonth) / $totalSalesPrevMonth) * 100 : 0;

    // Determine if sales are increasing, decreasing, or staying the same
    if ($percentageChange > 0) {
        $status = 'Increasing';
    } elseif ($percentageChange < 0) {
        $status = 'Decreasing';
    } else {
        $status = 'No Improvement';
    }

    // Create a result array with the desired format
    $result = [
        'totalSales' => number_format($totalSalesToday, 2),
        'percentageToday' => number_format($percentageToday, 2) . '%', // Percentage for today's sales
        'totalSalesCurrentMonth' => number_format($totalSalesCurrentMonth, 2),
        'percentageCurrentMonth' => number_format($percentageCurrentMonth, 2) . '%', // Corrected variable name
        'totalSalesPrevMonth' => number_format($totalSalesPrevMonth, 2),
        'percentagePrevMonth' => number_format($percentagePrevMonth, 2) . '%',
        'percentageChange' => number_format($percentageChange, 2) . '%', // Percentage change between current and previous months
        'salesStatus' => $status, // Add the status
    ];

    $employee = [
        // 'present' => $present,
        'count' => count($emp)
    ];

    return view('admin.index', [
        'transactions' => $transactions,
        'notifs' => $out,
        'sales_report' => $result,
        'employee' => $employee
    ]);
}

    // Helper function to get total sales for a date range
    function getTotalSalesForDateRange($startDate, $endDate)
    {
        return DB::table('invoices')
            ->select(DB::raw('SUM(price) as total_price'))
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    }

    // Helper function to calculate the percentage
    function calculatePercentage($previousValue, $currentValue)
    {
        if ($previousValue == 0) {
            return 100.00; // 100% if there's no previous value
        }

        $percentage = ($currentValue / $previousValue) * 100;

        return $percentage;
    }
}
