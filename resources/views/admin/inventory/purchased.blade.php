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
                        <h4 class="mb-sm-0">Purchased Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Purchased Stocks</li>
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
                            <h4 class="card-title">Purchased Stocks Saving State
                                <a class="btn btn-info" href="#" id="process-selected-link">
                                    Void Products
                                    <span id="selected-count"></span>
                                </a>
                            </h4>
                            <div class="table-responsive">
                                {{-- <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100 available-p">
                                    <thead>
                                        <tr>
                                            <th class="text-info">Delete</th>
                                            <th class="text-info">Purchased By</th>
                                            <th class="text-info">Product ID</th>
                                            <th class="text-info">Product Type</th>
                                            <th class="text-info">Product Name</th>
                                            <th class="text-info">Product Brand</th>
                                            <th class="text-info">Product Sold</th>
                                            <th class="text-info">Purchased Date</th>
                                            <th class="text-info">Status</th>
                                            <th class="text-info">Amount</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td><input type="checkbox" class="staff-checkbox"
                                                        name="selected_purchased[]" value="{{ $invoice->id }}"></td>
                                                <td>{{ $invoice->sold_to }}</td>
                                                <td>INV-{{ $invoice->id }}</td>
                                                <td>{{ $invoice->inventory->product_type }}</td>
                                                <td>{{ $invoice->inventory->product_name }}</td>
                                                <td>{{ $invoice->inventory->product_brand }}</td>
                                                <td>{{ $invoice->quantity }}</td>
                                                <td>{{ $invoice->date }}</td>
                                                
                                                @if ($invoice->date === $today)
                                                    <td><span class="badge bg-info p-2"><b>Newest</b></span></td>
                                                @elseif ($oldest && $invoice->date != $today)
                                                    <td><span class="badge bg-warning p-2"><b>Oldest</b></span></td>
                                                @endif
                                                
                                                <td>₱ {{ $invoice->price }}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                    <tfoot>
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <a class="btn btn-info" href="#" id="process-selected-link">
                                                    Void Products
                                                    <span id="selected-count"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    </tfoot>
                                </table> --}}
                                <table id="purchased-table" class="table activate-select dt-responsive nowrap w-100 text-center" style="width:100%;border:0 solid transparent; padding:10px;font-weight:700;text-transform:capitalize;">
                                    
                                </table>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
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

    <script>
        var dataToRender =  @json($invoices);
        console.log(dataToRender)
        $(document).ready(function() {
            // render data
            $('#purchased-table').DataTable({
                data: dataToRender,
                "order": [],
                "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                }],                      
                columns: [
                    { 
                        title: 'Delete',
                        data: null,
                        render:function(data, type, row) {
                            
                            return `<input type="checkbox" class="staff-checkbox"
                                        name="selected_purchased[]" value="${row.id}">`
                        },
                    },
                    { data: 'id', title: 'Product ID : ' },
                    { data: 'sold_to', title: 'Purchased By : ' },
                    { 
                        title: 'Product Type : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.inventory.product_type}`
                        }
                    
                    },
                    { 
                        title: 'Product Name : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.inventory.product_name}`
                        }
                    
                    },
                    { 
                        title: 'Product Brand : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.inventory.product_brand}`
                        }
                    
                    },
                    { data: 'quantity', title: 'Product Quantity : ' },
                    { data: 'date', title: 'Date : ' },
                    { 
                        title: 'Status',
                        data: null,
                        render: function(data, type, row){
                            var today = new Date()
                            var givenDate = new Date(row.date)
                            if(givenDate < today){
                                return `<span class="badge bg-info p-1"><b>Newest</b></span>`
                            }else{
                                return `<span class="badge bg-warning p-1"><b>Oldest</b></span>`
                            }
                        }
                    },
                    { data: 'price', title: 'Amount : ' },
                    { 
                        title: 'Unit Type : ',
                        data: null,
                        render:function(data, type, row) {
                            return `<p class="badge bg-success p-1">${row.inventory.unit_type}</p>`
                        },
                    },
                    
                    // { data: 'product_brand', title: 'Product Brand : ' },
                    // { data: 'description', title: 'Description : ' },
                    // to render an action button
                    // {
                    //     title: 'Actions',
                    //     data: null,
                    //     render: function (data, type, row) {
                    //         return '<button onclick="editRow(\'' + row.name + '\')">Edit</button>';
                    //     }
                    // }
                ],
                responsive: true,
                "initComplete": function (settings, json) {
                    $(this.api().table().container()).addClass('bs4');
                },
            });

            const selectedStaffIds = [];
            let selectedIds;

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

            // Listen for changes in the checkboxes
            $('.staff-checkbox').change(function() {
                updateSelectedStaffIds(); // Update the selectedProductIds array
                updateButtonState();
            });

            // search
            $('.search-input').on('input', function() {
                var searchValue = $(this).val().toLowerCase();

                // Loop through each row in the table body
                $('.available-p tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();

                    // Check if the row contains the search value
                    if (rowText.includes(searchValue)) {
                        // Show the row if it contains the search value
                        $(this).show();
                    } else {
                        // Hide the row if it does not contain the search value
                        $(this).hide();
                    }
                });
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
                    const url = "{{ route('void.products', ['id' => ':ids']) }}".replace(':ids',
                        selectedIds);

                    //dynamic approach
                    makeRequest(url, 'null', csrfToken)
                        .done(function(res) {
                            console.log(res)
                            window.location.href ="/show-product-sold";
                        })
                        .fail(function(err) {
                            console.log(err)
                        })
                }
            });
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
        })
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
