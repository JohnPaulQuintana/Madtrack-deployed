@extends('admin.admin-dashboard')

{{-- header links --}}
@section('header-links')
    <meta charset="utf-8" />
    <title>Dashboard | BIS - Admin & Dashboard</title>
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
                                <li class="breadcrumb-item active">Employee's Present</li>
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
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">

                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a class="dropdown-item addEmployees"><i class="ri-user-add-fill"></i> Add
                                        Employee's</a>
                            
                                </div>
                            </div>
                            <h4 class="card-title">Employee Table State Saving</h4>

                            <div class="table-responsive">
                                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Qrcodes</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>BirthDate</th>
                                            <th>Gender</th>
                                            <th>Contact Number</th>
                                            <th>Date Hired</th>
                                            <th>Qrcode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- {{ $employees }} --}}
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td><input type="checkbox" class="staff-checkbox" name="selected_staff[]"
                                                        value="{{ $employee->id }}"
                                                        {{ $employee->status }}></td>
                                                <td>EMP-{{ $employee->id }}</td> <!-- Display employee_id -->
                                                <td class="text-info">{{ $employee->first_name }}
                                                    {{ $employee->middle_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->birthdate }}</td>
                                                <td class="text-info">{{ $employee->gender }}</td>
                                                <td>+63-{{ $employee->contact }}</td>
                                                <td class="text-info "><b>{{ $employee->hired }}</b></td>
                                                <td
                                                    class="{{ is_null($employee->status) || $employee->status == 0 ? 'text-danger' : 'text-info' }}">
                                                    <b>{{ is_null($employee->status) || $employee->status == 0 ? 'not generated' : 'generated' }}</b>
                                                </td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a class="fas fa-address-card h4 view" data-id="{{ $employee->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Attendace Record"></a>
                                                        <a class="ri-edit-2-fill h4 edit text-info" data-id="{{ $employee->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Edit Record"
                                                            style="font-size: 25px;"></a>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <!-- Add a footer row with a link to process selected product IDs -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <a class="btn btn-info" href="#" id="process-selected-link">
                                                    Generate Qrcodes
                                                    <span id="selected-count"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    </tfoot>
                                </table>
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
            const selectedStaffIds = [];
            let selectedIds;
            let qrpath;
            // Function to update the selectedProductIds array
            function updateSelectedStaffIds() {
                selectedStaffIds.length = 0; // Clear the array
                $('.staff-checkbox:checked').each(function() {
                    selectedStaffIds.push($(this).val()); // Add the checked checkbox values to the array
                });
                // Now, you can use the selectedProductIds array as needed
                // Update the count element
                $('#selected-count').text(selectedStaffIds.length);

                // Show/hide the "Create Invoice" button based on the selectedProductIds array
                const button = $('#process-selected-link');
                if (selectedStaffIds.length > 0) {
                    button.show(); // Show the button if there are selected items
                } else {
                    button.hide(); // Hide the button if no items are selected
                }
            }

            // Function to update the "Create Invoice" button's disabled attribute
            function updateButtonState() {
                const checkboxes = $('.staff-checkbox'); // Assuming this class is assigned to your checkboxes
                const selectedCount = checkboxes.filter(':checked').length;
                const button = $('#process-selected-link');

                // Disable the button if no checkboxes are checked, enable it otherwise
                button.prop('disabled', selectedCount === 0);

                // Update the selected count in the button text
                $('#selected-count').text(selectedCount > 0 ? ` (${selectedCount} selected)` : '');
            }

            // Initially hide the "Create Invoice" button using CSS
            $('#process-selected-link').hide();

            // Check if DataTable is already initialized
            $(document).on('click', '.addEmployees', function() {
                $('#addEmployeeModal').modal('show')
            })

            // Listen for changes in the checkboxes
            $('.staff-checkbox').change(function() {
                updateSelectedStaffIds(); // Update the selectedProductIds array
                updateButtonState();
            });

            // Listen for the click event on the "Process Selected" link
            $('#process-selected-link').click(function(e) {
                e.preventDefault(); // Prevent the default behavior of the link

                // Call the function to ensure the array is up-to-date
                updateSelectedStaffIds();

                if (selectedStaffIds.length > 0) {
                    console.log(selectedStaffIds)
                    // Construct the URL with the selected product IDs
                    selectedIds = selectedStaffIds.join(
                        ','); // Convert the array to a comma-separated string
                    const url = "{{ route('qrcodes.process.generate', ['id' => ':ids']) }}".replace(':ids',
                        selectedIds);

                    //dynamic approach
                    makeRequest(url, 'null', csrfToken)
                        .done(function(res) {
                            console.log(res)
                            qrpath = res.path//generated pdf path
                            $('#frame').attr('src', res.path)
                            $('#editorModal').modal('show')
                        })
                        .fail(function(err) {
                            console.log(err)
                        })
                }
            });

            //update qr to set status 1
            $(document).on('click', '.qrclose', function() {
                // alert(selectedIds)
                const url = "{{ route('qrcodes.process.update', ['id' => ':ids']) }}".replace(':ids',
                    selectedIds);
                let data = {"path":qrpath}
                makeRequest(url, data, csrfToken)
                    .done(function(res) {
                        console.log(res)
                        $('#editorModal').modal('hide')
                    })
                    .fail(function(err) {
                        console.log(err)
                    })

            })

            // Initial button state update
            updateButtonState();

            //view
            $(document).on('click', '.view', function() {
                const staff_id = $(this).data('id')
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                //format data to send
                let data = {
                    'id': staff_id
                }
                //dynamic approach
                makeRequest('/get-attendance', data, csrfToken)
                    .done(function(res) {
                        // console.log(res)
                        populateCalendar(res.attendances)
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
                        $('.remove-emp').attr('data-id',res.employee.id)
                        // populateCalendar(res.attendances)
                        $('#editEmployeeModal').modal('show')
                    })
                    .fail(function(err) {
                        console.log(err)
                    })
                // $('#editEmployeeModal').modal('show')
            })

            //remove emplyee
            $(document).on('click', '.remove-emp', function(){
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
                            if(res.status === 'success'){
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Employee information has been deleted.",
                                    icon: "success"
                                });
                                $('#editEmployeeModal')
                                $('#editEmployeeModal').modal('hide')
                            }else{
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

            //populate calendar
            function populateCalendar(datas) {
                var calendar = ''; // initialize the calendar outside the loop
                var fullname = ''
                Object.entries(datas).forEach(([monthYear, records]) => {
                    // Display the month and year header
                    calendar += `
                        <div class="col-sm-6">
                            <h5>${monthYear}</h5>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="float-end">2023</h5>
                        </div>
                        <hr>
                        <div class="col-sm-12 row text-center gap-1 mx-auto">
                    `;

                    // Sort records in ascending order based on the 'day' property
                    records.sort((a, b) => a.day - b.day);
                    // Iterate over the records within the month
                    records.forEach(rec => {
                        fullname = rec.first_name + ' ' + rec.last_name;
                        // Parse the created_at string using Carbon
                        // const createdAt = moment(rec.created_at);
                        // Extract the date and time components
                        // const day = createdAt.format('DD');
                        // console.log(day)
                        // const timePart = createdAt.format('HH:mm:ss');
                        // Determine the background color based on the status
                        const borderColor = rec.status === 'P' ? 'border border-success' :
                            'border border-danger';
                        const bgColor = rec.status === 'P' ? 'bg-success' : 'bg-danger';
                        // Display information for each record
                        if (rec.day != null) {
                            calendar += `
                            <div class="col-sm-2 card p-1 position-relative ${borderColor}" style="width: 50px;">
                                <span class="position-absolute top-0 start-50 translate-middle badge ${bgColor}" style="font-size: 14px;">
                                    ${rec.day}
                                </span>
                                <h4 class="mt-2">${rec.status}</h4>
                            </div>
                        `;
                        } else {
                            calendar +=
                                `<h4 class="mt-2 text-center text-secondary">There's is no record to this employee's</h4>`
                        }

                        console.log(rec);
                    });

                    // Close the row container
                    calendar += `</div>`;
                });

                // Set the generated HTML to the calendar container
                $('#name').html(capitalizeAllWords(fullname))
                $('.calendar').html(calendar);



            }

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
