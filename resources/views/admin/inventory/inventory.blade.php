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
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css
    " rel="stylesheet">
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

                            <h4 class="card-title">Available Stocks Saving State
                                <a class="btn btn-info" href="#" id="process-selected-link">
                                    Record as Purchased
                                    <span id="selected-count"></span>
                                </a>
                                <a href="{{ route('show.product.page') }}" class="btn btn-dark">Manage
                                    Products</a>
                            </h4>
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                {{-- <table id="state-saving-datatable"
                                    class="table activate-select dt-responsive nowrap w-100 text-center available-p">
                                    <thead
                                        style="background-color: #f5f5f5; padding: 10px; position: sticky; top: 0; z-index: 1;">
                                        <tr>
                                            <th>Record as Purchased</th>
                                           
                                            <th>Type</th>
                                            <th>Stocks</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Pack</th>
                                            <th>Unit Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                
                                                <td width="100"><input type="checkbox" class="product-checkbox"
                                                        name="selected_products[]" value="{{ $stock->id }}"></td>
                                               
                                                <td>{{ $stock->product_type }}</td>
                                                <td class="text-info">{{ $stock->stocks }}</td>
                                                <td>{{ $stock->product_name }}</td>
                                                <td>{{ $stock->product_brand }}</td>
                                                <td>
                                                    <p class="badge bg-success p-1">{{ $stock->size }}</p>
                                                </td>
                                                <td class="text-info">₱{{ $stock->product_pcs_price }}.00</td>
                                                
                                               
                                                <td>{{ $stock->product_pcs_per_pack }} pcs</td>
                                                <td>
                                                    <p class="badge bg-success p-1">{{ $stock->unit_type }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a class="fas fa-trash-alt h5 border bg-danger rounded text-white p-1 del-products"
                                                        data-id="{{ $stock->id }}"></a>
                                                    
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                    <tfoot style="padding: 10px; position: sticky; bottom: -10px; z-index: 1;">
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <a class="btn btn-info" href="#" id="process-selected-link">
                                                    Record as Purchased
                                                    <span id="selected-count"></span>
                                                </a>
                                            </td>

                                        </tr>
                                    </tfoot>
                                </table> --}}
                                <table id="inventory-table" class="table activate-select dt-responsive nowrap w-100 text-center" style="width:100%;border:0 solid transparent; padding:10px;font-weight:700;text-transform:capitalize;">
                                    
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         var dataToRender =  @json($stocks);
        // console.log(dataToRender)
        $(document).ready(function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $(document).on('click','.btn-action', function(){
                var stockID = $(this).data('id');
                var action = $(this).data('action')
                var stocks = $(this).data('stocks')
                if(action === 'p'){
                    Swal.fire({
                        title: "Add Stock",
                        html: `
                            
                            <input type="number" id="remaining-stocks" class="swal2-input text-center" value="${stocks}" style="margin-top:-5px;">
                        `,
                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Add",
                        showLoaderOnConfirm: true,
                        backdrop: false,  // Disable closing on clicking outside
                        preConfirm: async (login) => {
                            var newStocks = $('#remaining-stocks').val()
                            
                            if(parseInt(newStocks) < 0 || parseInt(newStocks) == 0){
                                return Swal.showValidationMessage(`
                                Unable to Performed, negative and zero number is prohibited
                                `);  
                            }
                            try {
                            // if(parseInt(newStocks) !==  parseInt(stocks)){
                                const response = await fetch(`{{ route('add.stocks') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        id: stockID,
                                        stocks: newStocks,
                                        action: action,
                                    }),
                                });
                            // }
                            
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                            } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                            title: "Added!",
                            text: `${result.value.message}`,
                            icon: "success"
                            });

                            setTimeout(() => {
                                if(result.value.refresh){
                                    window.location.reload()
                                }
                            }, 1000);
                        }
                    });
                }else if(action === 'm'){
                    Swal.fire({
                        title: "Update Remaining Stocks",
                        html: `
                           
                            <input type="number" id="remaining-stocks" class="swal2-input text-center" value="${stocks}" style="margin-top:-5px;">
                        `,
                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Update",
                        showLoaderOnConfirm: true,
                        backdrop: false,  // Disable closing on clicking outside
                        preConfirm: async (login) => {
                            var newStocks = $('#remaining-stocks').val()
                            if(parseInt(newStocks) > parseInt(stocks)){
                                return Swal.showValidationMessage(`
                                Unable to Performed, Remaining Stocks is ${stocks}
                                `);
                            }

                            if(parseInt(newStocks) < 0 || parseInt(newStocks) == 0){
                                return Swal.showValidationMessage(`
                                Unable to Performed, negative and zero number is prohibited
                                `);  
                            }
                            try {
                            // if(parseInt(newStocks) !==  parseInt(stocks)){
                                const response = await fetch(`{{ route('add.stocks') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        id: stockID,
                                        stocks: newStocks,
                                        action: action,
                                       
                                    }),
                                });
                            // }
                            
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                            } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                            title: "Remaining Stocks Updated!",
                            text: `Updates Completed!`,
                            icon: "success"
                            });

                            setTimeout(() => {
                                if(result.value.refresh){
                                    window.location.reload()
                                }
                            }, 1000);
                        }
                    });
                }else if(action === 'pr'){
                    var type = $(this).data('type')
                    var brand = $(this).data('brand')
                    var name = $(this).data('name')
                    var rejectedCount = $(this).data('rejected')
                    console.log(stockID, type, brand, name, stocks, rejectedCount, action)
                    Swal.fire({
                        title: "Add Rejected Product",
                        html: `
                        <label for="rejected-stocks">Remaining Stocks:</label><br/>
                        <input type="number" id="rejected-stocks" class="swal2-input text-center" value="${stocks}" required style="margin-top:-5px;">

                        <label for="productDescription">Product Description:</label>
                        <textarea class="form-control text-center p-2" id="productDescription" rows="5" required></textarea>
                    `,

                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Rejected",
                        showLoaderOnConfirm: true,
                        backdrop: false,  // Disable closing on clicking outside
                        preConfirm: async (login) => {
                            var newRejected = $('#rejected-stocks').val()
                            var description = $('#productDescription').val()
                            if(description == null || description == ''){
                                return Swal.showValidationMessage(`
                                    Description is required
                                `);
                            }
                            if(parseInt(newRejected) === parseInt(stocks)){
                                return Swal.showValidationMessage(`
                                There is no changes, Remaining Stocks is ${stocks}
                                `);
                            }
                            if(parseInt(newRejected) > parseInt(stocks)){
                                return Swal.showValidationMessage(`
                                Unable to performed, Remaining Stocks is ${stocks}
                                `);
                            }

                            if(parseInt(newRejected) < 0){
                                return Swal.showValidationMessage(`
                                Unable to Performed, negative number is prohibited
                                `);  
                            }
                            try {
                            // if(parseInt(newStocks) !==  parseInt(stocks)){
                                const response = await fetch(`{{ route('inventory.rejected.post') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        id: stockID,
                                        type: type,
                                        brand: brand,
                                        name: name,
                                        reject: newRejected,
                                        description: description,
                                        action: action,
                                       
                                    }),
                                });
                            // }
                            
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                            } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                            title: "Added!",
                            text: `${result.value.message}`,
                            icon: "success"
                            });

                            setTimeout(() => {
                                if(result.value.refresh){
                                    window.location.reload()
                                }
                            }, 1000);
                        }
                    });

                }else if(action === 'mr'){
                    var type = $(this).data('type')
                    var brand = $(this).data('brand')
                    var name = $(this).data('name')
                    var rejectedCount = $(this).data('rejected')
                    console.log(stockID, type, brand, name, stocks, rejectedCount, action)
                    Swal.fire({
                        title: "Update Rejected Product",
                        html: `
                        <label for="rejected-stocks">Rejected Stocks:</label><br/>
                        <input type="number" id="rejected-stocks" class="swal2-input text-center" value="${rejectedCount}" required style="margin-top:-5px;">
                    `,

                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Rejected",
                        showLoaderOnConfirm: true,
                        backdrop: false,  // Disable closing on clicking outside
                        preConfirm: async (login) => {
                            var newRejected = $('#rejected-stocks').val()

                            if(parseInt(newRejected) > parseInt(rejectedCount)){
                                return Swal.showValidationMessage(`
                                Unable to performed, Rejected Stocks is ${rejectedCount}
                                `);
                            }

                            if(parseInt(newRejected) <= 0){
                                return Swal.showValidationMessage(`
                                Unable to Performed, negative and zero number is prohibited
                                `);  
                            }
                            try {
                            // if(parseInt(newStocks) !==  parseInt(stocks)){
                                const response = await fetch(`{{ route('inventory.rejected.post') }}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        id: stockID,
                                        type: type,
                                        brand: brand,
                                        name: name,
                                        reject: newRejected,
                                        description: 'hdjhdjwa',
                                        action: action,
                                    }),
                                });
                            // }
                            
                            if (!response.ok) {
                                return Swal.showValidationMessage(`
                                ${JSON.stringify(await response.json())}
                                `);
                            }
                            return response.json();
                            } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error}
                            `);
                            }
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                            title: "Update Successfully!",
                            text: `${result.value.message}`,
                            icon: "success"
                            });

                            setTimeout(() => {
                                if(result.value.refresh){
                                    window.location.reload()
                                }
                            }, 1000);
                        }
                    });
                }
                
            })


            // render data
            $('#inventory-table').DataTable({
                data: dataToRender,
                "order": [],
                "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                }],                       
                columns: [
                    {
                        title:'Purchased',
                        data : null,
                        render: function(data, type, row){
                            //check if have purchased
                            
                            var classNameStatus = ''
                            if(parseInt(row.invoice_count) > 0 ){
                                classNameStatus = 'bg-success'
                            }else{
                                classNameStatus = 'bg-danger'
                            }

                            return `
                                <input type="checkbox" class="form-check-input product-checkbox" name="selected_products[]" value="${row.id}">
                                <span class="badge ${classNameStatus}">${row.invoice_count}</span>
                                `
                        }

                    },
                    // { data: 'id', title: 'Product ID : ' },
                    { data: 'product_type', title: 'Product Type : ' },
                    
                    { data: 'product_name', title: 'Product Name : ' },
                    { data: 'product_brand', title: 'Product Brand : ' },
                    { data: 'size', title: 'Size : ' },
                    { data: 'product_pcs_price', title: 'Price : ' },
                    { data: 'product_pcs_per_pack', title: 'Per-Pack : ' },
                    { 
                        data: null,
                        title: 'Available Stocks : ',
                        render: function(data, type, row){
                            var classNameStatus = ''
                            var renderMinusBtn = `<i class="fas fa-minus-circle text-danger btn-action" data-id="${row.id}" data-stocks="${row.stocks}" data-action="m" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Minus Stocks"></i>`
                            var renderPlusBtn = `<i class="fas fa-plus-circle text-success  btn-action" data-id="${row.id}" data-stocks="${row.stocks}" data-action="p" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Stocks"></i>`
                            if(parseInt(row.stocks) > 0 ){
                                classNameStatus = 'bg-light text-success p-2'
                                
                            }else{
                                classNameStatus = 'bg-light text-danger p-2'
                                renderMinusBtn = '';
                            }

                            // Surround the <span> with plus and minus icons
                            return `<div>
                                        ${renderMinusBtn}
                                        <span class="badge ${classNameStatus}" style="font-size:15px;font-weight:700;">${row.stocks}</span>
                                        ${renderPlusBtn}
                                    </div>`;
                        }
                    },
                    { 
                        title: 'Unit Type : ',
                        data: null,
                        render:function(data, type, row) {
                            return `<p class="badge bg-success p-1">${row.unit_type}</p>`
                        },
                    },
                    
                    {
                        title:'Rejected',
                        data : null,
                        render: function(data, type, row){
                            //check if have purchased
                            var classNameStatus = ''
                            var renderMinusBtn = `<i class="fas fa-minus-circle text-danger btn-action" data-id="${row.id}" data-name="${row.product_name}" data-brand="${row.product_brand}" data-type="${row.product_type}" data-stocks="${row.stocks}" data-rejected="${row.rejected_count}" data-action="mr" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Minus Rejected"></i>`
                            var renderPlusBtn = `<i class="fas fa-plus-circle text-success  btn-action" data-id="${row.id}" data-name="${row.product_name}" data-brand="${row.product_brand}" data-type="${row.product_type}" data-stocks="${row.stocks}" data-rejected="${row.rejected_count}" data-action="pr" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Rejected"></i>`
                            if(parseInt(row.rejected_count) > 0 ){
                                classNameStatus = 'bg-light text-success p-2'
                                
                            }else{
                                classNameStatus = 'bg-light text-danger p-2'
                                renderMinusBtn = '';
                            }

                            // Surround the <span> with plus and minus icons
                            return `<div>
                                        ${renderMinusBtn}
                                        <span class="badge ${classNameStatus}" style="font-size:15px;font-weight:700;">${row.rejected_count}</span>
                                        ${renderPlusBtn}
                                    </div>`;
                        }

                    },
                    
                    {
                        title:'Overall Stock',
                        data : null,
                        render: function(data, type, row){
                            //check if have purchased
                            var testValue = parseInt(row.rejected_count) + parseInt(row.stocks) + parseInt(row.invoice_count)
                            var classNameStatus = ''
                            if(testValue > 0 ){
                                classNameStatus = 'bg-success'
                            }else{
                                classNameStatus = 'bg-danger'
                            }

                            return `<span class="badge ${classNameStatus}">${testValue}</span>`
                        }

                    },
                    {
                        title: 'Action : ',
                        data: null,
                        render: function (data, type, row) {
                            return `<a class="fas fa-trash-alt h5 border bg-danger rounded text-white p-1 del-products"
                                                        data-id="${row.id}"></a>`;
                        }
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

            // delete products
            $(document).on('click', '.del-products', function() {
              
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

                        makeRequest($(this).data('id'), csrfToken)
                        .done((res)=>{
                            console.log(res)
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            setTimeout(() => {
                                window.location.href =`{{ route('inventory.available.stocks') }}` 
                            }, 1000);
                        })
                        .fail((err)=>{
                            console.log(err)
                        })
                        
                    }
                });
            })

            // make a request to the ai
            function makeRequest(id, csrfToken) {
                return $.ajax({
                    method: 'POST',
                    url: '/delete-products',
                    data: JSON.stringify({'productId': id}),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
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
