<?php

namespace App\Helpers;

use Carbon\Carbon;

class ProcessEmployees
{
    private $employee;
    private $modelClass;
    public function __construct($emp)
    {
        $this->employee = $emp;
        $this->modelClass = 'App\\Models\\' . $this->employee['answer']['model'];
    }

    public function getAllEmployees()
    { //no function for now
        try {
            $data = $this->modelClass::where('username', '!=', $this->employee['answer']['exclude'])->get();
        } catch (\Throwable $th) {
            return ['error' => 'An error occurred.'];
        }
    }

    public function getEmployeePresent()
    {
        try {
            $data = $this->modelClass::join('users', 'users.id', '=', $this->employee['answer']['table'] . '.' . $this->employee['answer']['include-employee'])
                ->where('users.id', '=', $this->employee['answer']['include-employee'])
                ->get();

            $data = \App\Models\User::whereHas($this->employee['answer']['table'], function ($query) {
                $query->whereNotNull('employee_id')
                    ->whereDate('time_in', Carbon::now()->toDate()) // Filter by today's date
                    ->latest('time_in'); // Order by the time_in column in descending order
            })->with([$this->employee['answer']['table'] => function ($query) {
                $query->whereNotNull('employee_id')
                    ->latest('time_in')
                    ->first(); // Get the latest employee record
            }])->get();

            // Loop through the data and extract desired values
            $formattedResult = '';
            $count = count($data);
            $total = "We have a total of {$count} Present Employee.  im going to navigate you to a Employee Table. ";
            $formattedResult = [
                // 'answer' =>$total. implode(', ', $formattedResponse),
                'answer' => $total,
                'init' => 'Initializing Employee Tables...' . $total,
                'action' => 'employee.present'
            ];
            return $formattedResult;
        } catch (\Throwable $th) {
            return ['error' => 'An error occurred.'];
        }
    }
}
