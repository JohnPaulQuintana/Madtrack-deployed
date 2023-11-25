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
@endsection

@section('admin-dashboard')
    <div class="page-content">
        <div class="container-fluid">
            <section>
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Inventory Products</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Add Stocks</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- start page add products --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="text-info"><b>Add Stocks</b></span> Saving State</h4>
                                <div class="table-responsive">
                                    {{-- {{ route('bulk.add.stocks') }} --}}
                                    <form action="{{ route('bulk.manage.stocks') }}" method="POST" style="overflow-x: auto;">
                                        @csrf
                                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Product Type</th>
                                                    <th>Product Name</th>
                                                    <th>Product Brand</th>
                                                    <th>Product Stocks</th>
                                                    <th>Product Price(pcs)</th>
                                                    <th>Product Price(pck)</th>
                                                    <th>Product Pcs(per-pck)</th>
                                                    <!-- Add more table headers as needed -->
                                                </tr>
                                            </thead>
                                            <tbody id="productInputs">
                                                <!-- Initial input fields for product details -->
                                                <input type="text" name="req" class="form-control" value="add"
                                                    id="action" hidden>
                                                <tr>
                                                    <td><input type="text" name="product_type[]" class="form-control"
                                                        placeholder="Sticker">
                                                    </td>
                                                    <td><input type="text" name="product_name[]" class="form-control"
                                                        placeholder="Sticker">
                                                    </td>
                                                    <td><input type="text" name="product_brand[]" class="form-control"
                                                        placeholder="Sticker">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="product_stocks[]" class="form-control"
                                                        placeholder="₱ 0.00">
                                                        
                                                    </td>
                                                    <td>
                                                        <input type="number" name="product_price_pcs[]" class="form-control"
                                                        placeholder="₱ 0.00">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="product_price_pck[]" class="form-control"
                                                        placeholder="₱ 0.00">
                                                    <td>
                                                        <input type="number" name="product_pcs_pck[]" class="form-control"
                                                        placeholder="₱ 0.00">
                                                    </td>
                                                    <!-- Add more rows for additional entries -->
                                                </tr>
                                            </tbody>
                                        </table>
                                        {{-- <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button> --}}
                                        <button type="button" class="btn btn-secondary" id="addProductField">Add Product
                                            Field</button>
                                        <button type="submit" class="btn btn-primary" id="addStocksBtn">Add Stocks</button>

                                        <button type="submit" class="btn btn-warning" id="rejectStocksBtn">Rejected Stocks</button>
                                    </form>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>

                {{-- edit --}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="text-danger"><b>Edit Stocks</b></span> Saving State</h4>
                                <div class="table-responsive">
                                    {{-- {{ route('bulk.add.stocks') }} --}}
                                    <form action="{{ route('bulk.manage.stocks') }}" method="POST">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product Type</th>
                                                    <th>Product Name</th>
                                                    <th>Product Brand</th>
                                                    <th>Stocks</th>
                                                    <th>Price - (pcs)</th>
                                                    <th>Price - (pck)</th>
                                                    <th>Product Pack</th>
                                                    <th>Product Created</th>
                                                    <!-- Add more table headers as needed -->
                                                </tr>
                                            </thead>
                                            <tbody id="productInputsEdit">
                                                <!-- Initial input fields for product details -->
                                                <input type="text" name="req" class="form-control" value="edit"
                                                    hidden>
                                                    @foreach ($stocks as $stock)
                                                    @php
                                                        $stockValue = $stock->stocks;
                                                        $rowClass = $stockValue == 0 ? 'border border-danger' : 'border border-success';
                                                    @endphp
                                                    <tr>
                                                        
                                                        <td>
                                                            <input type="text" name="stocks_id[]" class="form-control" value="{{ $stock->id }}"
                                                            hidden>
                                                            <input style="width: 100px" type="text" name="product_type[]" class="form-control custom-select {{ $rowClass }}" 
                                                                value="{{ $stock->product_type }}">
                                                        </td>
                                                        <td><input type="text" name="product_name[]" class="form-control custom-select {{ $rowClass }}" 
                                                            value="{{ $stock->product_name }}">
                                                        </td>
                                                        <td><input type="text" name="product_brand[]" class="form-control custom-select {{ $rowClass }}" 
                                                            value="{{ $stock->product_brand }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="product_stocks[]" class="form-control custom-select {{ $rowClass }}"
                                                                value="{{ $stock->stocks }}">
                            
                                                        </td>
                                                        <td>
                                                            <input type="number" name="product_price_pcs[]" class="form-control custom-select {{ $rowClass }}"
                                                                value="{{ $stock->product_pcs_price }}">
                                                                    
                                                        </td>
                                                        <td>
                                                            <input type="number" name="product_price_pck[]" class="form-control custom-select {{ $rowClass }}"
                                                             value="{{ $stock->product_pack_price }}">
                                                                    
                                                        <td>
                                                            <input type="number" name="product_pcs_pck[]" class="form-control custom-select {{ $rowClass }}"
                                                                value="{{ $stock->product_pcs_per_pack }}">
                                                                    
                                                        </td>
                                                        <td>
                                                            <input type="text" name="product_created" class="form-control text-info {{ $rowClass }}" 
                                                            value="{{ $stock->created_at_formatted }}" readonly style="width: 140px">
                                                        </td>
                                                        <!-- Add more rows for additional entries -->
                                                    </tr>
                                                    @endforeach
                                                   
                                            </tbody>
                                        </table>
                                        {{-- <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button> --}}
                                       
                                        <button type="submit" class="btn btn-primary">Update Stocks</button>
                                    </form>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div>
                </div>

            </section>
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
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
     $(document).ready(function() {
            // Handle the "Add Stocks" button click event
            $('#addStocksBtn').click(function() {
                $('#action').val('add'); // Update the value to "add"
            });

            // Handle the "Rejected Stocks" button click event
            $('#rejectStocksBtn').click(function() {
                $('#action').val('reject'); // Update the value to "reject"
            });

            // Add product
            $("#addProductField").on("click", function() {
                var newRow = `<tr>
                                <td><input type="text" name="product_type[]" class="form-control"></td>
                                <td><input type="text" name="product_name[]" class="form-control"></td>
                                <td><input type="text" name="product_brand[]" class="form-control"></td>
                                <td><input type="number" name="product_stocks[]" class="form-control"></td>
                                <td><input type="number" name="product_price_pcs[]" class="form-control"></td>
                                <td><input type="number" name="product_price_pck[]" class="form-control"></td>
                                <td><input type="number" name="product_pcs_pck[]" class="form-control"></td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>`;
                // Append the new row to the relevant table body (productInputs or productInputsEdit)
                // ...
                $("#productInputs").append(newRow);
                // Add event listener to delete buttons
                $('.delete-row').click(function() {
                    $(this).closest('tr').remove(); // Remove the closest <tr> element
                });
            });

            // Editable input/select functionality using jQuery
            $("#productInputs, #productInputsEdit").on("change", ".custom-select", function() {
                makeEditable(this);
            });

            $("#productInputs, #productInputsEdit").on("click", ".cancel-edit", function() {
                const parentDiv = $(this).closest(".input-group");
                const originalHTML = parentDiv.data("original-html");
                parentDiv.html(originalHTML);
            });

            function makeEditable(element) {
                const originalName = $(element).attr("name");
                const isSelect = $(element).is("select");
                const selectedOption = isSelect ? $(element).find("option:selected") : $(element);

                if (selectedOption.val() !== "") {
                    const originalHTML = $(element).prop("outerHTML");

                    $(element).replaceWith(
                        `<div class="input-group">
                            <input type="text" class="form-control" name="${originalName}" value="${selectedOption.val()}" style="width:${15 * 4}px">
                            <button type="button" class="btn btn-danger fas fa-times cancel-edit"></button>    
                        </div>`);

                    const parentDiv = $(`[name='${originalName}']`).closest(".input-group");
                    parentDiv.data("original-html", originalHTML);

                    // Set input width based on value length
                    $("#productInputs, #productInputsEdit").on("input", "[name='${originalName}']", function() {
                        const input = $(this);
                        const valueLength = input.val().length;
                        input.css("width", `${valueLength}px`); // Adjust the multiplier as needed
                    });
                }
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
