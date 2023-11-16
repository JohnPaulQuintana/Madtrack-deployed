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
                            <h4 class="card-title">Purchased Stocks Saving State</h4>
                            <div class="table-responsive">    
                                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-info">Purchased By</th>
                                            <th class="text-info">Product ID</th>
                                            <th class="text-info">Product Type</th>
                                            <th class="text-info">Product Name</th>
                                            <th class="text-info">Product Brand</th>
                                            <th class="text-info">Product Sold</th>
                                            <th class="text-info">Purchased Date</th>
                                            <th class="text-info">Status</th>
                                            <th class="text-info">Amount</th>
                                            {{-- <th>Per Pack</th>
                                            <th>Pcs Per Pack</th> --}}
                                            <th class="text-info">Action</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->sold_to }}</td>
                                                <td>INV-{{ $invoice->id }}</td>
                                                <td>{{ $invoice->inventory->product_type }}</td>
                                                <td>{{ $invoice->inventory->product_name }}</td>
                                                <td>{{ $invoice->inventory->product_brand }}</td>
                                                <td>{{ $invoice->quantity }}</td>
                                                <td>{{ $invoice->date }}</td>
                                                {{-- <td> --}}
                                                    @if ($invoice->date === $today)
                                                        <td><span class="badge bg-info p-2"><b>Newest</b></span></td>
                                                    @elseif ($oldest && $invoice->date != $today)
                                                        <td><span class="badge bg-warning p-2"><b>Oldest</b></span></td>
                                                    @endif
                                                {{-- </td> --}}
                                                <td>₱ {{ $invoice->price }}</td>
                                                <td class="text-center"><a class="fas fa-address-card h4 text-info" href="route-with-id"></a></td>
        
                                            </tr>
                                        @endforeach
                                    </tbody>
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
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

@endsection