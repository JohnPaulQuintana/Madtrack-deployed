@extends('admin.admin-dashboard')

{{-- header links --}}
@section('header-links')
    <meta charset="utf-8" />
    <title>Dashboard | MADTRACK - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add this line -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('logo/logo.png') }}">

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
@endsection

{{-- main contents --}}
@section('admin-dashboard')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">REPORTS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Generate Report's</li>
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
                            <h4 class="card-title">Generate Reports</h4>
                            <div class="row g-3 align-items-center">

                                <div class="col-sm-3">
                                    <label for="select reports" class="col-form-label">Select Reports</label>
                                    <select name="types" id="types" class="form-control" required>
                                        <option value="stocks">Stocks</option>
                                        <option value="purchased">Purchased</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="out">Out-of-Stock</option>
                                        <option value="present">Present Employee</option>
                                        <option value="absent">Absent Employee</option>
                                        <option value="invoices">Invoices</option>
                                        {{-- <option value=""></option> --}}
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="select reports" class="col-form-label">From Date</label>
                                    <input type="date" name="from" id="from" class="form-control" required />
                                </div>

                                <div class="col-sm-3">
                                    <label for="select reports" class="col-form-label">To Date</label>
                                    <input type="date" name="to" id="to" class="form-control" required />
                                </div>

                                <div class="col-sm-3">
                                    <label for="select reports" class="col-form-label text-white">To Date</label>
                                    <input type="button" value="generate report"
                                        class="btn btn-dark form-control generate" />
                                </div>

                                {{-- <h4 class="card-title mt-3">Available's fields</h4>
                                <div class="col-sm-12 row">
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                          Indeterminate checkbox
                                        </label>
                                      </div>
                                </div> --}}
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->


            {{-- pdf display --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Generated PDF Reports</h4>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap text-center">
                                    <thead>
                                        <tr class="tbl-head">
                                            <th>Reports generated from latest to oldest</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbl-body">
                                        <div class="row generated">



                                        </div>
                                    </tbody>
                                    {{-- <tfoot style="float: end;width:100%;">
                                        <tr class="tfoot" style="text-align: right;">
                                            
                                        </tr>
                                    </tfoot> --}}
                                </table>
                                <div class="tfoot border float-end">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.modals.view-report')
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
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>

    <script>
        $(document).ready(function() {

            // Encapsulate the logic in a function
            function isQueryParamPresent(paramName) {
                // Get the current URL
                var currentUrl = window.location.href;

                // Check if the specified query parameter is present
                var urlSearchParams = new URLSearchParams(window.location.search);
                return urlSearchParams.has(paramName);
            }

            // Usage
            var paramNameToCheck = 'p';
            var isParamPresent = isQueryParamPresent(paramNameToCheck);

            if (isParamPresent) {
                // The specified query parameter is present in the URL
                var path = new URLSearchParams(window.location
                    .search).get(paramNameToCheck)+'.pdf';
                    var pdfPath = 'reports/' + path;
                    $('#frame').attr('src', pdfPath);
                    $('#viewModal').modal('show');
                    path = 0;

            } else {
                // The specified query parameter is not present in the URL
                console.log(`Query parameter "${paramNameToCheck}" is not present`);
            }


            $('.generate').on('click', function() {
                var types = $('#types').val();
                var from = $('#from').val();
                var to = $('#to').val();

                if (types !== '' && from !== '' && to !== '') {
                    sendRequest(types, from, to)
                } else {
                    alert('all required')
                }

            })

            //    send function
            function sendRequest(types, from, to) {
                console.log(types, from, to)
                // Get the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var requestData = {
                    _token: csrfToken,
                    types: types,
                    from: from,
                    to: to,
                }

                // Make the AJAX request
                $.ajax({
                    type: 'POST', // Use the appropriate HTTP method
                    url: '/generate-reports', // Replace with your API endpoint URL
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Set the X-CSRF-TOKEN header
                    },
                    data: requestData, // Send the data
                    success: function(response) {
                        // Handle the success response
                        console.log('Request was successful');
                        console.log(response);
                        var pdfPath = 'reports/' + response.id + '.pdf';
                        $('#frame').attr('src', pdfPath);
                        $('#viewModal').modal('show');
                        path = 0;
                        displayGeneratedReports()
                        // populateTable(response);
                    },
                    error: function(error) {
                        // Handle the error response
                        console.log('An error occurred');
                        var notification = JSON.parse(error.responseJSON.notification);
                        responseJsonHandler(notification)
                    }
                });
            }

            //    populates table
            function populateTable(data) {
                var html = '';
                var currentDate = new Date().toISOString().split('T')[0]; // Get the current date in 'YYYY-MM-DD' format
                console.log(currentDate)
                data.forEach(report => {
                    var isToday = report.formatted_created_at === currentDate;
                    console.log(report.formatted_created_at)
                    var highlightBorder = isToday ? 'border border-success' : ''; // Use green background if the report was created today
                    var highlightColor = isToday ? 'bg-success' : ''; // Use green background if the report was created today
                    var highlightText = isToday ? 'New' : 'Old'; // Use green background if the report was created today

                    html += `
                        <div class="col-sm-2 border-0">
                            <div class="card">
                                <div class="card-body ${highlightBorder} text-center" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
                                    <h5 class="card-title">${report.formatted_created_at}</h5>
                                        <p class="card-text text-danger">
                                            <i class="fas fa-file-pdf fa-6x position-relative">
                                                <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill ${highlightColor}" style="font-size:small;">
                                                    ${highlightText}
                                                </span>
                                            </i>
                                        </p>
                                        <h6 class="text-secondary">${report.formatted_time}</h6>
                                        <button type="button" id="dl-btn" class="btn btn-dark dl-btn"
                                            data-path="${report.path}"> 
                                            <i class="ri-eye-fill"></i>
                                            Open
                                        </button>
                                </div>
                            </div>
                        </div>
                    `
                });
                $('.generated').html(html)

                // $('.dl-btn').attr('data-id',data.id)

                $(document).on('click', '.dl-btn', function() {
                    var path = $(this).data('path'); // Access data-path from the clicked element
                    console.log(path);
                    var pdfPath = 'reports/' + path;
                    $('#frame').attr('src', pdfPath);
                    $('#viewModal').modal('show');
                    path = 0;
                });

            }

            //display generated reports
            function displayGeneratedReports() {
                // Make the AJAX request
                $.ajax({
                    type: 'GET', // Use the appropriate HTTP method
                    url: '/display-reports', // Replace with your API endpoint URL
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Set the X-CSRF-TOKEN header
                    },
                    success: function(response) {
                        // Handle the success response
                        console.log('Request was successful');
                        console.log(response);
                        populateTable(response.generatedReports);
                    },
                    error: function(error) {
                        // Handle the error response
                        console.log('An error occurred');
                        var notification = JSON.parse(error.responseJSON.notification);
                        responseJsonHandler(notification)
                    }
                });
            }

            displayGeneratedReports()


            $('.btn-close').on('click', function() {
                $('#frame').attr('src', '')
                $('.dl-btn').attr('data-id', '')
            })


            function responseJsonHandler(notification) {
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

                toastr[notification.status](notification.message);
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
