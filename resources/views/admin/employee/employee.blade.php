@extends('admin.admin-dashboard')

{{-- header links --}}
@section('header-links')
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add this line -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    {{-- toast css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/toastr/build/toastr.min.css') }}">


    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css id="bootstrap-style"-->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css id="app-style"-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- calendar --}}
    <style>
        :root {
            --primary-clr: #12051f;
        }

        /* nice scroll bar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f5f5f5;
            border-radius: 50px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-clr);
            border-radius: 50px;
        }

        .container.cal {
            position: relative;
            width: 100%;
            min-height: 850px;
            margin: 0 auto;
            padding: 5px;
            color: #fff;
            display: flex;

            border-radius: 10px;
            background-color: #373c4f;
        }

        .left {
            width: 60%;
            padding: 20px;
        }

        .calendar {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: space-between;
            color: var(--primary-clr);
            border-radius: 5px;
            background-color: #fff;
        }

        /* set after behind the main element */
        .calendar::before,
        .calendar::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            width: 12px;
            height: 97%;
            border-radius: 0 5px 5px 0;
            background-color: #d3d4d6d7;
            transform: translateY(-50%);
        }

        .calendar::before {
            height: 94%;
            left: calc(100% + 12px);
            background-color: rgb(153, 153, 153);
        }

        .calendar .month {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .calendar .month .prev,
        .calendar .month .next {
            cursor: pointer;
        }

        .calendar .month .prev:hover,
        .calendar .month .next:hover {
            color: var(--primary-clr);
        }

        .calendar .weekdays {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .weekdays div {
            width: 14.28%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calendar .days {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .calendar .days .day {
            width: 14.28%;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--primary-clr);
            border: 1px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(7n + 1) {
            border-left: 2px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(7n) {
            border-right: 2px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(-n + 7) {
            border-top: 2px solid #f5f5f5;
        }

        .calendar .days .day:nth-child(n + 29) {
            border-bottom: 2px solid #f5f5f5;
        }

        .calendar .days .day:not(.prev-date, .next-date):hover {
            color: #fff;
            background-color: var(--primary-clr);
        }

        .calendar .days .prev-date,
        .calendar .days .next-date {
            color: #b3b3b3;
        }

        .calendar .days .active {
            position: relative;
            font-size: 2rem;
            color: #fff;
            background-color: var(--primary-clr);
        }

        .calendar .days .active::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 10px 2px var(--primary-clr);
        }

        .calendar .days .today {
            font-size: 1.2rem;
        }

        .calendar .days .event {
            position: relative;
        }

        .calendar .days .event::after {
            content: "";
            position: absolute;
            bottom: 10%;
            left: 50%;
            width: 75%;
            height: 6px;
            border-radius: 30px;
            transform: translateX(-50%);
            background-color: var(--primary-clr);
        }

        .calendar .days .day:hover.event::after {
            background-color: #fff;
        }

        .calendar .days .active.event::after {
            background-color: #fff;
            bottom: 20%;
        }

        .calendar .days .active.event {
            padding-bottom: 10px;
        }

        .calendar .goto-today {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 0 20px;
            margin-bottom: 20px;
            color: var(--primary-clr);
        }

        .calendar .goto-today .goto {
            display: flex;
            align-items: center;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid var(--primary-clr);
        }

        .calendar .goto-today .goto input {
            width: 100%;
            height: 30px;
            outline: none;
            border: none;
            border-radius: 5px;
            padding: 0 20px;
            color: var(--primary-clr);
            border-radius: 5px;
        }

        .calendar .goto-today button {
            padding: 5px 10px;
            border: 1px solid var(--primary-clr);
            border-radius: 5px;
            background-color: transparent;
            cursor: pointer;
            color: var(--primary-clr);
        }

        .calendar .goto-today button:hover {
            color: #fff;
            background-color: var(--primary-clr);
        }

        .calendar .goto-today .goto button {
            border: none;
            border-left: 1px solid var(--primary-clr);
            border-radius: 0;
        }

        .container .right {
            position: relative;
            width: 40%;
            min-height: 100%;
            padding: 20px 0;
        }

        .right .today-date {
            width: 100%;
            height: 50px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            padding-left: 70px;
            margin-top: 50px;
            margin-bottom: 20px;
            text-transform: capitalize;
        }

        .right .today-date .event-day {
            font-size: 2rem;
            font-weight: 500;
        }

        .right .today-date .event-date {
            font-size: 1rem;
            font-weight: 400;
            color: #878895;
        }

        .events {
            width: 100%;
            height: 100%;
            max-height: 600px;
            overflow-x: hidden;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding-left: 4px;
        }

        .events .event {
            position: relative;
            width: 95%;
            min-height: 70px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            padding: 0 20px;
            padding-left: 50px;
            color: #fff;
            background: linear-gradient(90deg, #3f4458, transparent);
            cursor: pointer;
        }

        /* even event */
        .events .event:nth-child(even) {
            background: transparent;
        }

        .events .event.act {
            background: linear-gradient(90deg, var(--primary-clr), transparent);
        }

        .events .event .title {
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .events .event .title .event-title {
            font-size: 1rem;
            color: white;
            font-weight: 400;
            margin-left: 20px;
        }

        .events .event i {
            color: var(--primary-clr);
            font-size: 0.5rem;
        }

        .events .event:hover i {
            color: #fff;
        }

        .events .event .event-time {
            font-size: 0.8rem;
            font-weight: 400;
            color: #fbfbff;
            margin-left: 15px;
            pointer-events: none;
        }

        .events .event:hover .event-time {
            color: #fff;
        }

        /* add tick in event after */
        .events .event::after {
            content: "✓";
            position: absolute;
            top: 50%;
            right: 0;
            font-size: 3rem;
            line-height: 1;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0.3;
            color: var(--primary-clr);
            transform: translateY(-50%);
        }

        .events .event:hover::after {
            display: flex;
        }

        .add-event {
            position: absolute;
            bottom: 30px;
            right: 30px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #878895;
            border: 2px solid #878895;
            opacity: 0.5;
            border-radius: 50%;
            background-color: transparent;
            cursor: pointer;
        }

        .add-event:hover {
            opacity: 1;
        }

        .add-event i {
            pointer-events: none;
        }

        .events .no-event {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 500;
            color: #878895;
        }

        .add-event-wrapper {
            position: absolute;
            bottom: 100px;
            left: 50%;
            width: 90%;
            max-height: 0;
            overflow: hidden;
            border-radius: 5px;
            background-color: #fff;
            transform: translateX(-50%);
            transition: max-height 0.5s ease;
        }

        .add-event-wrapper.active {
            max-height: 300px;
        }

        .add-event-header {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #373c4f;
            border-bottom: 1px solid #f5f5f5;
        }

        .add-event-header .close {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .add-event-header .close:hover {
            color: var(--primary-clr);
        }

        .add-event-header .title {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .add-event-body {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 20px;
        }

        .add-event-body .add-event-input {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .add-event-body .add-event-input input {
            width: 100%;
            height: 100%;
            outline: none;
            border: none;
            border-bottom: 1px solid #f5f5f5;
            padding: 0 10px;
            font-size: 1rem;
            font-weight: 400;
            color: #373c4f;
        }

        .add-event-body .add-event-input input::placeholder {
            color: #a5a5a5;
        }

        .add-event-body .add-event-input input:focus {
            border-bottom: 1px solid var(--primary-clr);
        }

        .add-event-body .add-event-input input:focus::placeholder {
            color: var(--primary-clr);
        }

        .add-event-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .add-event-footer .add-event-btn {
            height: 40px;
            font-size: 1rem;
            font-weight: 500;
            outline: none;
            border: none;
            color: #fff;
            background-color: var(--primary-clr);
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            border: 1px solid var(--primary-clr);
        }

        .add-event-footer .add-event-btn:hover {
            background-color: transparent;
            color: var(--primary-clr);
        }

        /* media queries */

        @media screen and (max-width: 1000px) {
            body {
                align-items: flex-start;
                justify-content: flex-start;
            }

            .container {
                min-height: 100vh;
                flex-direction: column;
                border-radius: 0;
            }

            .container .left {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .container .right {
                width: 100%;
                height: 100%;
                padding: 20px 0;
            }

            .calendar::before,
            .calendar::after {
                top: 100%;
                left: 50%;
                width: 97%;
                height: 12px;
                border-radius: 0 0 5px 5px;
                transform: translateX(-50%);
            }

            .calendar::before {
                width: 94%;
                top: calc(100% + 12px);
            }

            .events {
                padding-bottom: 340px;
            }

            .add-event-wrapper {
                bottom: 100px;
            }
        }

        @media screen and (max-width: 500px) {
            .calendar .month {
                height: 75px;
            }

            .calendar .weekdays {
                height: 50px;
            }

            .calendar .days .day {
                height: 40px;
                font-size: 0.8rem;
            }

            .calendar .days .day.active,
            .calendar .days .day.today {
                font-size: 1rem;
            }

            .right .today-date {
                padding: 20px;
            }
        }

        .credits {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #fff;
            background-color: #b38add;
        }

        .credits a {
            text-decoration: none;
            font-weight: 600;
        }

        .credits a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

{{-- main contents --}}
@section('admin-dashboard')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Employee's</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Employee's</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="dropdown float-end">
                                <a href="#" class="ri-user-add-fill card-drop addEmployees" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Add Employee
                                </a>

                            </div>
                            <h4 class="card-title">Employee Table State Saving</h4>

                            <div class="table-responsive">
                                <table id="state-saving-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>

                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>BirthDate</th>
                                            <th>Gender</th>
                                            <th>Contact Number</th>
                                            <th>Date Hired</th>
                                            {{-- <th>Qrcode</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- {{ $employees }} --}}
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>EMP-{{ $employee->id }}</td> <!-- Display employee_id -->
                                                <td class="text-info">{{ $employee->first_name }}
                                                    {{ $employee->middle_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->birthdate }}</td>
                                                <td class="text-info">{{ $employee->gender }}</td>
                                                <td>+63-{{ $employee->contact }}</td>
                                                <td class="text-info "><b>{{ $employee->hired }}</b></td>
                                                {{-- <td
                                                    class="{{ is_null($employee->status) || $employee->status == 0 ? 'text-danger' : 'text-info' }}">
                                                    <b>{{ is_null($employee->status) || $employee->status == 0 ? 'not generated' : 'generated' }}</b>
                                                </td> --}}
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a class="fas fa-address-card h4 view"
                                                            data-id="{{ $employee->id }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Attendace Record"></a>
                                                        <a class="ri-edit-2-fill h4 edit text-info"
                                                            data-id="{{ $employee->id }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Edit Record"
                                                            style="font-size: 25px;"></a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Combined Total Records Count and Pagination Links -->
                            <div class="d-flex justify-content-between mt-2">
                                <div>
                                    <p>Total: {{ $employees->total() }} records</p>
                                </div>

                                <div>
                                    {{ $employees->links('pagination::simple-bootstrap-5') }}
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

            @include('admin.modals.add-employee')
            @include('admin.modals.view-employee')
            @include('admin.modals.qrcodes-editor')
            @include('admin.modals.edit-employee')
        </div>
    </div>
@endsection

{{-- footer script --}}
@section('footer-script')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.j') }}s"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- Add this script tag to include moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            // Check if DataTable is already initialized
            $(document).on('click', '.addEmployees', function() {
                $('#addEmployeeModal').modal('show')
            })

            //view
            $(document).on('click', '.view', function() {

                const staff_id = $(this).data('id')
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                //format data to send
                let data = {
                    'id': staff_id
                }

                //for debug
                // $('#employeeModal').modal('show')
                //dynamic approach
                makeRequest('/get-attendance', data, csrfToken)
                    .done(function(res) {

                        console.log(res)
                        // populateTable(res.attendances)
                        calendarTable(res.attendances)
                        $('#employeeModal').modal('show')
                    })
                    .fail(function(err) {
                        console.log(err)
                    })


            })

            $(document).on('click', '.uploadqr', function() {
                $('#attendanceTestModal').modal('show')
            })

            // edit modal process
            $(document).on('click', '.edit', function() {
                const staff_id = $(this).data('id')
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                //format data to send
                let data = {
                    'id': staff_id
                }
                //dynamic approach
                makeRequest('/edit-employee', data, csrfToken)
                    .done(function(res) {
                        console.log(res)

                        $('#emp_id').val(res.employee.id)
                        $('#employeeFirstNameE').val(res.employee.first_name)
                        $('#employeeMiddleNameE').val(res.employee.middle_name)
                        $('#employeeLastNameE').val(res.employee.last_name)
                        $('#employeeBirthDateE').val(res.employee.birthdate)
                        $('#employeeGenderE').val(res.employee.gender)
                        $('#employeeAddressE').val(res.employee.address)
                        $('#employeeContactE').val(res.employee.contact)
                        $('#employeeHiredE').val(res.employee.hired)
                        $('#employeeStatusE').val(res.employee.status)
                        $('.remove-emp').attr('data-id', res.employee.id)
                        // populateCalendar(res.attendances)
                        $('#editEmployeeModal').modal('show')
                    })
                    .fail(function(err) {
                        console.log(err)
                    })
                // $('#editEmployeeModal').modal('show')
            })

            //remove emplyee
            $(document).on('click', '.remove-emp', function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        let data = {
                            'id': $(this).data('id')
                        }
                        makeRequest('/remove-employee', data, csrfToken)
                            .done(function(res) {
                                console.log(res)
                                if (res.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Employee information has been deleted.",
                                        icon: "success"
                                    });
                                    $('#editEmployeeModal')
                                    $('#editEmployeeModal').modal('hide')
                                    window.location.href = `{{ route('employee.table') }}`
                                } else {
                                    Swal.fire({
                                        title: "Unabled!",
                                        text: "Unabled to delete this record!.",
                                        icon: "error"
                                    });
                                }
                            })


                    }
                });
            })
            // make a request to the ai
            function makeRequest(url, data, csrfToken) {
                // console.log(id)
                return $.ajax({
                    method: 'GET',
                    url: url,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            }

            // populate table
            function populateTable(datas) {
                var month = ['Default', 'January', 'February', 'March', 'April', 'May', 'June', 'July', "August",
                    "September", "October", "November", 'December'
                ]
                var pop = ''
                if (typeof datas[0] !== 'undefined' && datas[0].employee_name) {
                    $('#name').html(capitalizeAllWords(datas[0].employee_name));
                    datas.forEach(data => {
                        pop += `<tr>
                                    <td>${month[data.month]}-${data.day},${data.year}</td>
                                    <td>${data.time_in}</td>
                                    <td>${data.time_out}</td>
                                    <td><img src="{{ asset('${data.captured}') }}" class="img-thumbnail" alt="..." style="width:50px;height:50px;"/></td>
                                </tr>`
                    });
                } else {
                    $('#name').html(capitalizeAllWords("No"));
                }

                $('.tbody').html(pop)
            }

            //calendar
            function calendarTable(datas) {
                const calendar = document.querySelector(".calendar.cal"),
                    date = document.querySelector(".date"),
                    daysContainer = document.querySelector(".days"),
                    prev = document.querySelector(".prev"),
                    next = document.querySelector(".next"),
                    todayBtn = document.querySelector(".today-btn"),
                    gotoBtn = document.querySelector(".goto-btn"),
                    dateInput = document.querySelector(".date-input"),
                    eventDay = document.querySelector(".event-day"),
                    eventDate = document.querySelector(".event-date"),
                    eventsContainer = document.querySelector(".events"),
                    addEventBtn = document.querySelector(".add-event"),
                    addEventWrapper = document.querySelector(".add-event-wrapper "),
                    addEventCloseBtn = document.querySelector(".close "),
                    addEventTitle = document.querySelector(".event-name "),
                    addEventFrom = document.querySelector(".event-time-from "),
                    addEventTo = document.querySelector(".event-time-to "),
                    addEventSubmit = document.querySelector(".add-event-btn ");

                let today = new Date();
                let activeDay;
                let month = today.getMonth();
                let year = today.getFullYear();

                const months = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ];

                // const eventsArr = [
                //   {
                //     day: 13,
                //     month: 11,
                //     year: 2022,
                //     events: [
                //       {
                //         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
                //         time: "10:00 AM",
                //       },
                //       {
                //         title: "Event 2",
                //         time: "11:00 AM",
                //       },
                //     ],
                //   },
                // ];

                const eventsArr = datas;
                // getEvents();
                console.log(eventsArr);

                //function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
                function initCalendar() {
                    const firstDay = new Date(year, month, 1);
                    const lastDay = new Date(year, month + 1, 0);
                    const prevLastDay = new Date(year, month, 0);
                    const prevDays = prevLastDay.getDate();
                    const lastDate = lastDay.getDate();
                    const day = firstDay.getDay();
                    const nextDays = 7 - lastDay.getDay() - 1;

                    date.innerHTML = months[month] + " " + year;

                    let days = "";

                    for (let x = day; x > 0; x--) {
                        days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
                    }

                    for (let i = 1; i <= lastDate; i++) {
                        //check if event is present on that day
                        let event = false;
                    
                        eventsArr.forEach((eventObj) => {
                            if (
                                eventObj.day === i &&
                                eventObj.month === month + 1 &&
                                eventObj.year === year
                            ) {
                                event = true;
                            }
                        });
                        // responsible for adding day and events rendering
                        if (
                            i === new Date().getDate() &&
                            year === new Date().getFullYear() &&
                            month === new Date().getMonth()
                        ) {
                            activeDay = i;
                            getActiveDay(i);
                            updateEvents(i);
                            if (event) {
                                days += `<div class="day today active event">${i}</div>`;
                            } else {
                                days += `<div class="day today active">${i}</div>`;
                            }
                        } else {
                            if (event) {
                                days += `<div class="day event">${i}</div>`;
                            } else {
                                days += `<div class="day ">${i}</div>`;
                            }
                        }
                    }

                    for (let j = 1; j <= nextDays; j++) {
                        days += `<div class="day next-date">${j}</div>`;
                    }
                    daysContainer.innerHTML = days;
                    addListner();
                }

                //function to add month and year on prev and next button
                function prevMonth() {
                    month--;
                    if (month < 0) {
                        month = 11;
                        year--;
                    }
                    initCalendar();
                }

                function nextMonth() {
                    month++;
                    if (month > 11) {
                        month = 0;
                        year++;
                    }
                    initCalendar();
                }

                prev.addEventListener("click", prevMonth);
                next.addEventListener("click", nextMonth);

                initCalendar();

                //function to add active on day
                function addListner() {
                    const days = document.querySelectorAll(".day");
                    days.forEach((day) => {
                        day.addEventListener("click", (e) => {
                            getActiveDay(e.target.innerHTML);
                            updateEvents(Number(e.target.innerHTML));
                            activeDay = Number(e.target.innerHTML);
                            //remove active
                            days.forEach((day) => {
                                day.classList.remove("active");
                            });
                            //if clicked prev-date or next-date switch to that month
                            if (e.target.classList.contains("prev-date")) {
                                prevMonth();
                                //add active to clicked day afte month is change
                                setTimeout(() => {
                                    //add active where no prev-date or next-date
                                    const days = document.querySelectorAll(".day");
                                    days.forEach((day) => {
                                        if (
                                            !day.classList.contains("prev-date") &&
                                            day.innerHTML === e.target.innerHTML
                                        ) {
                                            day.classList.add("active");
                                        }
                                    });
                                }, 100);
                            } else if (e.target.classList.contains("next-date")) {
                                nextMonth();
                                //add active to clicked day afte month is changed
                                setTimeout(() => {
                                    const days = document.querySelectorAll(".day");
                                    days.forEach((day) => {
                                        if (
                                            !day.classList.contains("next-date") &&
                                            day.innerHTML === e.target.innerHTML
                                        ) {
                                            day.classList.add("active");
                                        }
                                    });
                                }, 100);
                            } else {
                                e.target.classList.add("active");
                            }
                        });
                    });
                }

                todayBtn.addEventListener("click", () => {
                    today = new Date();
                    month = today.getMonth();
                    year = today.getFullYear();
                    initCalendar();
                });

                dateInput.addEventListener("input", (e) => {
                    dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
                    if (dateInput.value.length === 2) {
                        dateInput.value += "/";
                    }
                    if (dateInput.value.length > 7) {
                        dateInput.value = dateInput.value.slice(0, 7);
                    }
                    if (e.inputType === "deleteContentBackward") {
                        if (dateInput.value.length === 3) {
                            dateInput.value = dateInput.value.slice(0, 2);
                        }
                    }
                });

                gotoBtn.addEventListener("click", gotoDate);

                function gotoDate() {
                    console.log("here");
                    const dateArr = dateInput.value.split("/");
                    if (dateArr.length === 2) {
                        if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
                            month = dateArr[0] - 1;
                            year = dateArr[1];
                            initCalendar();
                            return;
                        }
                    }
                    alert("Invalid Date");
                }

                //function get active day day name and date and update eventday eventdate
                function getActiveDay(date) {
                    const day = new Date(year, month, date);
                    const dayName = day.toString().split(" ")[0];
                    eventDay.innerHTML = dayName;
                    eventDate.innerHTML = date + " " + months[month] + " " + year;
                }

                //function update events when a day is active
                function updateEvents(date) {
                    let events = "";
                    eventsArr.forEach((event) => {
                        if (
                            date === event.day &&
                            month + 1 === event.month &&
                            year === event.year
                        ) {
                            event.events.forEach((event) => {
                                events += `<div class="event act">
                                    <div class="title">
                                    <i class="fas fa-circle"></i>
                                    <h3 class="event-title">${event.title}</h3>
                                    </div>
                                    <div class="event-time">
                                    <span class="event-time">${event.time}</span>
                                    </div>
                                    
                                </div>`;
                            });
                            events += `<div class="event-image text-center">
                                        <span class="event-time">Captured Image</span>
                                        <img src="{{ asset('${event.captured}') }}" class="img-thumbnail" alt="..." />
                                    </div>`
                        }

                        
                    });
                    if (events === "") {
                        events = `<div class="no-event">
                            <h3>No Records</h3>
                        </div>`;
                    }
                    
                    eventsContainer.innerHTML = events;
                    // saveEvents();
                }

                //function to add event
                addEventBtn.addEventListener("click", () => {
                    addEventWrapper.classList.toggle("active");
                });

                addEventCloseBtn.addEventListener("click", () => {
                    addEventWrapper.classList.remove("active");
                });

                document.addEventListener("click", (e) => {
                    if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
                        addEventWrapper.classList.remove("active");
                    }
                });

                //allow 50 chars in eventtitle
                addEventTitle.addEventListener("input", (e) => {
                    addEventTitle.value = addEventTitle.value.slice(0, 60);
                });

                // function defineProperty() {
                //     var osccred = document.createElement("div");
                //     osccred.innerHTML =
                //         "A Project By <a href='https://www.youtube.com/channel/UCiUtBDVaSmMGKxg1HYeK-BQ' target=_blank>Open Source Coding</a>";
                //     osccred.style.position = "absolute";
                //     osccred.style.bottom = "0";
                //     osccred.style.right = "0";
                //     osccred.style.fontSize = "10px";
                //     osccred.style.color = "#ccc";
                //     osccred.style.fontFamily = "sans-serif";
                //     osccred.style.padding = "5px";
                //     osccred.style.background = "#fff";
                //     osccred.style.borderTopLeftRadius = "5px";
                //     osccred.style.borderBottomRightRadius = "5px";
                //     osccred.style.boxShadow = "0 0 5px #ccc";
                //     document.body.appendChild(osccred);
                // }

                // defineProperty();

                //allow only time in eventtime from and to
                addEventFrom.addEventListener("input", (e) => {
                    addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
                    if (addEventFrom.value.length === 2) {
                        addEventFrom.value += ":";
                    }
                    if (addEventFrom.value.length > 5) {
                        addEventFrom.value = addEventFrom.value.slice(0, 5);
                    }
                });

                addEventTo.addEventListener("input", (e) => {
                    addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
                    if (addEventTo.value.length === 2) {
                        addEventTo.value += ":";
                    }
                    if (addEventTo.value.length > 5) {
                        addEventTo.value = addEventTo.value.slice(0, 5);
                    }
                });

                //function to add event to eventsArr
                addEventSubmit.addEventListener("click", () => {
                    const eventTitle = addEventTitle.value;
                    const eventTimeFrom = addEventFrom.value;
                    const eventTimeTo = addEventTo.value;
                    if (eventTitle === "" || eventTimeFrom === "" || eventTimeTo === "") {
                        alert("Please fill all the fields");
                        return;
                    }

                    //check correct time format 24 hour
                    const timeFromArr = eventTimeFrom.split(":");
                    const timeToArr = eventTimeTo.split(":");
                    if (
                        timeFromArr.length !== 2 ||
                        timeToArr.length !== 2 ||
                        timeFromArr[0] > 23 ||
                        timeFromArr[1] > 59 ||
                        timeToArr[0] > 23 ||
                        timeToArr[1] > 59
                    ) {
                        alert("Invalid Time Format");
                        return;
                    }

                    const timeFrom = convertTime(eventTimeFrom);
                    const timeTo = convertTime(eventTimeTo);

                    //check if event is already added
                    let eventExist = false;
                    eventsArr.forEach((event) => {
                        if (
                            event.day === activeDay &&
                            event.month === month + 1 &&
                            event.year === year
                        ) {
                            event.events.forEach((event) => {
                                if (event.title === eventTitle) {
                                    eventExist = true;
                                }
                            });
                        }
                    });
                    if (eventExist) {
                        alert("Event already added");
                        return;
                    }
                    const newEvent = {
                        title: eventTitle,
                        time: timeFrom + " - " + timeTo,
                    };
                    console.log(newEvent);
                    console.log(activeDay);
                    let eventAdded = false;
                    if (eventsArr.length > 0) {
                        eventsArr.forEach((item) => {
                            if (
                                item.day === activeDay &&
                                item.month === month + 1 &&
                                item.year === year
                            ) {
                                item.events.push(newEvent);
                                eventAdded = true;
                            }
                        });
                    }

                    if (!eventAdded) {
                        eventsArr.push({
                            day: activeDay,
                            month: month + 1,
                            year: year,
                            events: [newEvent],
                        });
                    }

                    console.log(eventsArr);
                    addEventWrapper.classList.remove("active");
                    addEventTitle.value = "";
                    addEventFrom.value = "";
                    addEventTo.value = "";
                    updateEvents(activeDay);
                    //select active day and add event class if not added
                    const activeDayEl = document.querySelector(".day.active");
                    if (!activeDayEl.classList.contains("event")) {
                        activeDayEl.classList.add("event");
                    }
                });

                //function to delete event when clicked on event
                eventsContainer.addEventListener("click", (e) => {
                    if (e.target.classList.contains("event")) {
                        if (confirm("Are you sure you want to delete this event?")) {
                            const eventTitle = e.target.children[0].children[1].innerHTML;
                            eventsArr.forEach((event) => {
                                if (
                                    event.day === activeDay &&
                                    event.month === month + 1 &&
                                    event.year === year
                                ) {
                                    event.events.forEach((item, index) => {
                                        if (item.title === eventTitle) {
                                            event.events.splice(index, 1);
                                        }
                                    });
                                    //if no events left in a day then remove that day from eventsArr
                                    if (event.events.length === 0) {
                                        eventsArr.splice(eventsArr.indexOf(event), 1);
                                        //remove event class from day
                                        const activeDayEl = document.querySelector(".day.active");
                                        if (activeDayEl.classList.contains("event")) {
                                            activeDayEl.classList.remove("event");
                                        }
                                    }
                                }
                            });
                            updateEvents(activeDay);
                        }
                    }
                });

                // //function to save events in local storage
                // function saveEvents() {
                //     localStorage.setItem("events", JSON.stringify(eventsArr));
                // }

                // //function to get events from local storage
                // function getEvents() {
                //     //check if events are already saved in local storage then return event else nothing
                //     if (localStorage.getItem("events") === null) {
                //         return;
                //     }
                //     eventsArr.push(...JSON.parse(localStorage.getItem("events")));
                // }

                function convertTime(time) {
                    //convert time to 24 hour format
                    let timeArr = time.split(":");
                    let timeHour = timeArr[0];
                    let timeMin = timeArr[1];
                    let timeFormat = timeHour >= 12 ? "PM" : "AM";
                    timeHour = timeHour % 12 || 12;
                    time = timeHour + ":" + timeMin + " " + timeFormat;
                    return time;
                }

            }

            $(document).on('click', '.att-record', function() {
                console.log($(this).data('id'), $(this).data('day'))
                let data = {
                    'id': $(this).data('id'),
                    'day': $(this).data('day')
                }
                // Array to map month numbers to month names
                const monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                //dynamic approach
                makeRequest('/get-attendance-record', data, csrfToken)
                    .done(function(res) {
                        console.log('ginagaawa ', res.perday[0].timeout)
                        const date = new Date(res.perday[0].timein);
                        const date2 = res.perday[0].timeout ? new Date(res.perday[0].timeout) : null;

                        const formattedTime = date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        const formattedTimeOut = date2 ? date2.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }) : "No Timeout";
                        console.log(formattedTimeOut)
                        $('#day-title').text(res.perday[0].day + " of " + monthNames[res.perday[0]
                            .month - 1]);
                        $('#timein-info').text('Time-in : ' + formattedTime);
                        $('#timeout-info').text('Time-Out : ' + formattedTimeOut);
                        $('#dayDisplayTime').modal('show');

                    })
                    .fail(function(err) {
                        console.log(err)
                    })
            })

            function capitalizeAllWords(str) {
                return str.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            }
        });
    </script>

    {{-- // notification --}}
    @if (session()->has('notification'))
        <script>
            $(document).ready(function() {
                // Set Toastr options
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                var notificationJson = {!! json_encode(session('notification')) !!};
                var notification = JSON.parse(notificationJson);
                console.log(notification)
                toastr[notification.status](notification.message);
            });
        </script>
    @endif
@endsection
