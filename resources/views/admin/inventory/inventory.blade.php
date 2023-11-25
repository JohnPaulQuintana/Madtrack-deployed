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
                        <h4 class="mb-sm-0">Inventory</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Available Stocks</li>
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

                            <div class="float-end">
                                
                                <div class="dropdown">
                                
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="{{ route('show.product.page') }}" class="dropdown-item">Manage Products</a>
                                       
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title">Available Stocks Saving State</h4>
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table id="state-saving-datatable"
                                    class="table activate-select dt-responsive nowrap w-100 text-center">
                                    <thead style="background-color: #f5f5f5; padding: 10px; position: sticky; top: 0; z-index: 1;">
                                        <tr>
                                            <th>Invoice</th>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Stocks</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Piece</th>
                                            <th>Pack</th>
                                            <th>Per Pack</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                <!-- Add a checkbox with the corresponding Product ID as the value -->
                                                <td><input type="checkbox" class="product-checkbox"
                                                        name="selected_products[]" value="{{ $stock->id }}"></td>
                                                <td>PRD-{{ $stock->id }}</td>
                                                <td>{{ $stock->product_type }}</td>
                                                <td class="text-info">{{ $stock->stocks }}</td>
                                                <td>{{ $stock->product_name }}</td>
                                                <td>{{ $stock->product_brand }}</td>
                                                <td class="text-info">₱{{ $stock->product_pcs_price }}.00</td>
                                                <td class="text-info">₱ {{ $stock->product_pack_price }}.00</td>
                                                <td>{{ $stock->product_pcs_per_pack }} pcs</td>
                                                {{-- <td class="text-center"> --}}
                                                    {{-- <a class="fas fa-address-card h5 border bg-info rounded text-white p-1"
                                                        href="route-with-id"></a> --}}
                                                    {{-- <a class="fas fa-check h5 border bg-success rounded text-white p-1"
                                                        href="{{ route('inventory.process.sold', ['id' => $stock->id]) }}"></a> --}}
                                                {{-- </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- Add a footer row with a link to process selected product IDs -->
                                    <tfoot style="padding: 10px; position: sticky; bottom: -10px; z-index: 1;">
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <a class="btn btn-info" href="#" id="process-selected-link">
                                                    Create Invoice
                                                    <span id="selected-count"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('show.product.page') }}" class="btn btn-primary">Add Product</a>
                                </div> --}}
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

    <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // $('#state-saving-datatable').DataTable();
            // Initialize an empty array to store selected product IDs
            const selectedProductIds = [];

            // Function to update the selectedProductIds array
            function updateSelectedProductIds() {
                selectedProductIds.length = 0; // Clear the array
                $('.product-checkbox:checked').each(function() {
                    selectedProductIds.push($(this).val()); // Add the checked checkbox values to the array
                });
                // Now, you can use the selectedProductIds array as needed
                // Update the count element
                $('#selected-count').text(selectedProductIds.length);

                // Show/hide the "Create Invoice" button based on the selectedProductIds array
                const button = $('#process-selected-link');
                if (selectedProductIds.length > 0) {
                    button.show(); // Show the button if there are selected items
                } else {
                    button.hide(); // Hide the button if no items are selected
                }
            }

            // Function to update the "Create Invoice" button's disabled attribute
            function updateButtonState() {
                const checkboxes = $('.product-checkbox'); // Assuming this class is assigned to your checkboxes
                const selectedCount = checkboxes.filter(':checked').length;
                const button = $('#process-selected-link');

                // Disable the button if no checkboxes are checked, enable it otherwise
                button.prop('disabled', selectedCount === 0);

                // Update the selected count in the button text
                $('#selected-count').text(selectedCount > 0 ? ` (${selectedCount} selected)` : '');
            }

            // Initially hide the "Create Invoice" button using CSS
            $('#process-selected-link').hide();

            // Listen for changes in the checkboxes
            $('.product-checkbox').change(function() {
                updateSelectedProductIds(); // Update the selectedProductIds array
                updateButtonState();
            });

            // Listen for the click event on the "Process Selected" link
            $('#process-selected-link').click(function(e) {
                e.preventDefault(); // Prevent the default behavior of the link

                // Call the function to ensure the array is up-to-date
                updateSelectedProductIds();

                if (selectedProductIds.length > 0) {
                    // Construct the URL with the selected product IDs
                    const selectedIds = selectedProductIds.join(
                    ','); // Convert the array to a comma-separated string
                    const url = "{{ route('inventory.process.sold', ['id' => ':ids']) }}".replace(':ids',
                        selectedIds);

                    // Navigate to the constructed URL
                    window.location.href = url;
                }
            });

            // Initial button state update
            updateButtonState();
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
