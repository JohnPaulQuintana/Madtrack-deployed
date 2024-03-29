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
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     

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
                        <h4 class="mb-sm-0">Out-Of-Stocks</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Out-Of-Stocks</li>
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
                            
                            <h4 class="card-title"><span class="text-danger">Out-Of-Stocks</span> Saving State
                                <a href="{{ route('show.product.page') }}" class="btn btn-dark"
                                    >
                                    Manage Product
                                </a>
                                {{-- <input class="form-control me-2 search-input" type="search" placeholder="Search"
                                            aria-label="Search" style="width: 250px;"> --}}
                            </h4> 
                            <div class="table-responsive">   
                                {{-- <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100 text-center available-p">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Type</th>
                                            <th>Product Stocks</th>
                                            <th>Product Name</th>
                                            <th>Product Brand</th>
                            
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @foreach ($outofstocks as $stock)
                                            <tr>
                                       
                                                <td>PRD-{{ $stock->id }}</td>
                                                <td>{{ $stock->product_type }}</td>
                                                <td class="text-danger">{{ $stock->stocks }}</td>
                                                <td>{{ $stock->product_name }}</td>
                                                <td>{{ $stock->product_brand }}</td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                                {{-- <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('show.product.page') }}" class="btn btn-primary">Add Product</a>
                                </div> --}}

                                <table id="out-table" class="table activate-select dt-responsive nowrap w-100 text-center" style="width:100%;border:0 solid transparent; padding:10px;font-weight:700;text-transform:capitalize;"></table>

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
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        var dataToRender =  @json($outofstocks);
        console.log(dataToRender)
        $(document).ready(function(){

            $('#out-table').DataTable({
                data: dataToRender,
                "order": [],
                "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                }],

                columns: [
                    { 
                        title: 'Product Type : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.product_type}`
                        }
                    
                    },
                    { 
                        title: 'Product Name : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.product_name}`
                        }
                    
                    },
                    { 
                        title: 'Product Brand : ',
                        data: null,
                        render: function(data, type, row){
                            return `${row.product_brand}`
                        }
                    
                    },
                    { 
                        data: null, 
                        title: 'Product Size : ',
                        render: function(data, type, row){
                            if(row.size != null){
                                return `<span class="badge bg-success p-1"><b>${row.size}</b></span>`
                            }else{
                                return `<span class="badge bg-danger p-1"><b>Not-Available</b></span>`
                            }
                        } 
                    },
                    { data: 'stocks', title: 'Product Quantity : ' },
                    { 
                        data: null, 
                        title: 'Date : ',
                        render:function(data, type, row){
                            // Create a Date object with the given date string
                            const originalDate = new Date(row.created_at);

                            // Extract components of the date
                            const year = originalDate.getUTCFullYear();
                            const month = originalDate.getUTCMonth() + 1; // Months are zero-based, so add 1
                            const day = originalDate.getUTCDate();

                            // Format the new date string
                            const formattedDateString = `${year}-${month < 10 ? '0' : ''}${month}-${day < 10 ? '0' : ''}${day}`;
                            return formattedDateString;

                        } 
                    },
                    
                    { 
                        title: 'Unit Type : ',
                        data: null,
                        render:function(data, type, row) {
                            return `<p class="badge bg-success p-1">${row.unit_type}</p>`
                        },
                    },
                ],
                responsive: true,
                "initComplete": function (settings, json) {
                    $(this.api().table().container()).addClass('bs4');
                },
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
        })
    </script>

@endsection