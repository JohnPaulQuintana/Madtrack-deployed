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

    <link rel="stylesheet" href="{{ asset('backend/assets/css/invoice.css') }}">

    <style>
        .tooltip-hidden {
            display: none;
        }
    </style>
@endsection

{{-- main content --}}
@section('admin-dashboard')
    <div class="page-content">
        <div class="container-fluid">
            <section>
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">
                                <a href="{{ route('inventory.available.stocks') }}" class="text-decoration-none text-info">
                                    <i class="fas fa-arrow-left"></i> Purchased Products
                                </a>
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Create Invoice</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- start page add products --}}
                <div class="row">
                    <div class="col-sm-12 border">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="text-info"><b>Create Invoice</b></span> Saving State
                                </h4>
                                <div class="table-responsive">
                                    {{-- {{ route('bulk.add.stocks') }} --}}
                                    <form action="{{ route('bulk.create.invoice') }}" method="POST">
                                        @csrf
                                        <!-- Add a text input field for the client name -->
                                        <div class="form-group">
                                            {{-- <label for="client_name">Client Name:</label> --}}
                                            <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter Client Name" required>
                                        </div>
                                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Client Name</th> --}}
                                                    <th>Product Type</th>
                                                    <th>Product Name</th>
                                                    <th>Product Brand</th>
                                                    <th>Product Size</th>
                                                    <th>Unit Type</th>
                                                    <th>Quantity</th>
                                                    <th>Per-Packed</th>
                                                    <th>Price (pcs)</th>
                                                    <th>Amount</th>
                                                    <th>Cancel</th>
                                                    <!-- Add more table headers as needed -->
                                                </tr>
                                            </thead>
                                            <tbody id="productInputs">
                                                <!-- Initial input fields for product details -->
                                                <input type="text" name="req" class="form-control" value="invoice"
                                                    hidden>

                                                @foreach ($inventories as $inventory)
                                                    <tr id="{{ $inventory->id }}" data-original-stocks="{{ $inventory->stocks }}">
                                                        <input type="text" name="inventories_id[]" class="form-control" value="{{ $inventory->id }}"
                                                            hidden>
                                                        <td>
                                                            <select name="product_type[]" id=""
                                                                class="form-control">
                                                                <option value="{{ $inventory->product_type }}">
                                                                    {{ $inventory->product_type }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="product_name[]" id=""
                                                                class="form-control">
                                                                <option value="{{ $inventory->product_name }}">
                                                                    {{ $inventory->product_name }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="product_brand[]" id=""
                                                                class="form-control">
                                                                <option value="{{ $inventory->product_brand }}">
                                                                    {{ $inventory->product_brand }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="product_size[]" id=""
                                                                class="form-control">
                                                                <option value="{{ $inventory->size }}">
                                                                    {{ $inventory->size }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="product_unitType[]" id=""
                                                                class="form-control" disabled>
                                                                <option value="{{ $inventory->unit_type }}">
                                                                    {{ $inventory->unit_type }}
                                                                </option>
                                                            </select>
                                                        </td>

                                                        @if ($inventory->unit_type === 'per-pack')

                                                        <td>
                                                            <select name="product_quantity[]" id=""
                                                                class="form-select quantity-input">
                                                                @php
                                                                    $devide = $inventory->stocks / $inventory->product_pcs_per_pack
                                                                @endphp
                                                                @for ($i=1;$i<=$devide;$i++)
                                                                    
                                                                <option value="{{ $inventory->product_pcs_per_pack * $i }}">{{ $inventory->product_pcs_per_pack * $i }}</option>
                                                                @endfor
                                                                {{-- <option value="{{ $inventory->product_pcs_per_pack }}">{{ $inventory->product_pcs_per_pack }}</option>
                                                                <option value="{{ $inventory->stocks }}">
                                                                    {{ $inventory->stocks }}
                                                                </option> --}}
                                                            </select>
                                                        </td>

                                                        @else
                                                        <td>
                                                            <select name="product_quantity[]" id=""
                                                                class="form-control custom-select quantity-input">
                                                                <option value="{{ $inventory->stocks }}">
                                                                    {{ $inventory->stocks }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        @endif
                                                        
                                                        <td>
                                                            <select name="product_pcs_pck[]" id="" disabled
                                                                class="form-control quantity-pack-input">
                                                                <option value="{{ $inventory->product_pcs_per_pack }}">
                                                                    {{ $inventory->product_pcs_per_pack }} Pcs
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="product_price[]" id=""
                                                                class="form-control text-info price-input" readonly>
                                                                <option value="{{ $inventory->product_pcs_price }}">
                                                                    {{ $inventory->product_pcs_price }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input name="product_amount[]" id="" class="form-control text-info text-center amount-input" 
                                                                value="{{ $inventory->stocks * $inventory->product_pcs_price }}"
                                                                style="width: 80px;"
                                                                readonly />
                                                               
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-row" data-delete="{{ $inventory->id }}">X</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button> --}}
                                        {{-- <button type="button" class="btn btn-secondary" id="addProductField">Add Product
                                            Field</button> --}}
                                        <button type="submit" class="btn btn-primary">Record as Purchased</button>
                                    </form>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>

                {{-- <div class="row">

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-container">
                                    <div class="invoice-header">
                                        <div class="title-date">
                                            <h2 class="title text-info">INVOICE</h2>
                                            <p class="date">Date : <span class="text-info">01-12-20</span></p>
                                            <p class="name">Sold-to : <span class="text-info">John Doe</span></p>
                                        </div>
                                        <div class="space"></div>
                                        <p class="invoice-number text-info">#08-279</p>
                                    </div>
                                    <div class="invoice-body">
                                        <table id="invoice-table">
                                            <thead>
                                                <th style="padding-left:12px;">TYPE</th>
                                                <th style="padding-left:12px;">PRODUCT</th>
                                                <th style="padding-left:12px;">BRAND</th>
                                                <th>QUANTITY</th>
                                                <th>PRICE</th>

                                            </thead>

                                            <tbody id="table-body">
                                                <tr class="single-row">
                                                    <td><input type="text" placeholder="Product Type"
                                                            class="product left in" readonly></td>
                                                    <td><input type="text" placeholder="Product Name"
                                                            class="product left in" readonly></td>
                                                    <td><input type="text" placeholder="Product Brand"
                                                            class="product left in" readonly></td>
                                                    <td><input type="number" placeholder="0" name="price"
                                                            class="price in" id="price" readonly></td>
                                                    <td><input type="number" placeholder="0" name="amount"
                                                            class="amount in" id="amount" readonly></td>

                                                </tr>

                                                <tr class="single-row">
                                                    <td><input type="text" placeholder="Product Type"
                                                            class="product left in" readonly></td>
                                                    <td><input type="text" placeholder="Product Name"
                                                            class="product left in" readonly></td>
                                                    <td><input type="text" placeholder="Product Brand"
                                                            class="product left in" readonly></td>
                                                    <td><input type="number" placeholder="0" name="price"
                                                            class="price in" id="price" readonly></td>
                                                    <td><input type="number" placeholder="0" name="amount"
                                                            class="amount in" id="amount" readonly></td>

                                                </tr>



                                            </tbody>
                                        </table>
                                        <div id="sum"><input type="text" placeholder="₱ 0.00" name="total"
                                                class="total text-info in" id="total" readonly></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}

                </body>

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

    {{-- <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Attach click event to delete buttons
            $('.delete-row').click(function() {
                // Get the parent row of the clicked button
                var row = $(this).closest('tr');
                // Get the inventory ID from the data attribute
                var inventoryId = $(this).data('delete');
                
                // Remove the row
                row.remove();

                // Remove the inventory ID from the hidden input array
                var inventoriesIdInput = $('input[name="inventories_id[]"][value="' + inventoryId + '"]');
                inventoriesIdInput.remove();

            });

            // Editable input/select functionality using jQuery
            $("#productInputs, #productInputsEdit").on("click", ".custom-select", function() {
                makeEditable(this);
            });

            // make editable
            function makeEditable(element) {
                const originalName = $(element).attr("name");
                const isSelect = $(element).is("select");
                const selectedOption = isSelect ? $(element).find("option:selected") : $(element);
                const originalStocks = $(element).closest("tr").data("original-stocks");
                

                if (selectedOption.val() !== "") {
                    const parentDiv = $(element).closest("td");
                    const parentRow = $(element).closest("tr"); // Get the parent row
                    const originalHTML = parentDiv.html(); // Store the original HTML content
                    
                    parentDiv.html(`
                        <div class="input-group">
                            <input type="text" class="form-control quantity-input" name="${originalName}" value="${selectedOption.val()}" style="width:${selectedOption.val().length * 5}px">
                            <button type="button" class="btn btn-danger fas fa-times cancel-edit"></button>
                        </div>`
                    );

                    // Enable Bootstrap tooltips
                    // parentDiv.find('[data-toggle="tooltip"]').tooltip();

                    
                    // Store the original HTML content in the parent div's data
                    parentDiv.data("original-html", originalHTML);

                    // Find the amount input within the same row (inside a td)
                    const amountInput = parentRow.find("td .amount-input");
                    // Get the original amount value
                    const originalAmount = parseFloat(amountInput.val());

                    // Store the original amount value in a data attribute
                    amountInput.data("original-value", originalAmount);

                    // Set input width based on value length
                    parentDiv.find("input").on("input", function() {
                        const input = $(this);
                        // const quantityPackInput2 = $(this).closest('tr').find(".quantity-pack-input").val();
                        const newValue = parseInt(input.val());
                        // alert(originalStocks)
                        if (newValue > originalStocks) {
                            alert('Available Products Stocks is ' + originalStocks + ' only!');
                            input.val(originalStocks); // Set the input value back to the original stocks
                        } else if (newValue < 1) {
                            // Avoid negative or zero values
                            input.val(1);
                        }
                        
                        // alert(inputStocks)
                        const valueLength = input.val().length;
                        input.css("width", `${valueLength * 4}px`); // Adjust the multiplier as needed
                    });
                }
            }

            // for cancel editing
            $("#productInputs, #productInputsEdit").on("click", ".cancel-edit", function() {
                const parentDiv = $(this).closest("td");
                const originalHTML = parentDiv.data("original-html");
                parentDiv.html(originalHTML);

                // Restore the original amount value
                const parentRow = parentDiv.closest("tr");
                const amountInput = parentRow.find(".amount-input");
                const originalValue = amountInput.data("original-value");
                amountInput.val(originalValue);
                  // Get the original amount value
                // /const originalAmount = parentDiv.find(".amount-input").data("original-value");

                // Set the amount input field back to its original value
                // parentDiv.find(".amount-input").val(originalAmount);
                
            });

             // Function to update the amount based on quantity and price
            function updateAmount(row) {
                const quantityInput = row.find(".quantity-input");
                // const quantityPackInput = row.find(".quantity-pack-input");
                const priceInput = row.find(".price-input");
                const amountInput = row.find(".amount-input");

                const quantity = parseFloat(quantityInput.val());
                const price = parseFloat(priceInput.val());
                // const pack = parseFloat(quantityPackInput.val());

                // Check if both quantity and price are valid numbers
                if (!isNaN(quantity) && !isNaN(price) ) {
                    const amount = quantity * price;
                    amountInput.val(amount.toFixed(2)); // Set the amount with two decimal places
                } else {
                    amountInput.val(""); // Clear the amount if either quantity or price is not a valid number
                }
            }

            // Add event listeners for quantity and price fields
            $("#productInputs").on("input", ".quantity-input, .price-input", function() {
                updateAmount($(this).closest("tr"));
            });

            // Initial calculation of amounts
            $("#productInputs tr").each(function() {
                updateAmount($(this));
            });
        });
    </script>
    
@endsection
