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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

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
                        <h4 class="mb-sm-0">Rejected Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Rejected Stocks</li>
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

                            

                            <h4 class="card-title"><span class="text-danger">Rejected Stocks</span> Saving State
                                {{-- <input class="form-control me-2 search-input" type="search" placeholder="Search"
                                aria-label="Search" style="width: 250px;"> --}}
                                {{-- <a class="btn btn-danger rejectedAdd" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Add Rejected
                                
                                    </a> --}}
                            </h4>
                            
                            <div class="table-responsive">
                                {{-- <table id="state-saving-datatable"
                                    class="table activate-select dt-responsive nowrap w-100 text-center available-p">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Type</th>
                                            <th>Product Quantity</th>
                                            <th>Product Name</th>
                                            <th>Product Brand</th>
                                            <th>Description</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($rejected as $reject)
                                            <tr>

                                                <td>RJT-{{ $reject->id }}</td>
                                                <td>{{ $reject->product_type }}</td>
                                                <td class="text-danger">{{ $reject->stocks }}</td>
                                                <td>{{ $reject->product_name }}</td>
                                                <td>{{ $reject->product_brand }}</td>
                                                <td class="text-danger">{{ $reject->description }}</td>
                                                

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                               <table id="rejected-table" class="table activate-select dt-responsive nowrap w-100 text-center" style="width:100%;border:0 solid transparent; padding:10px;font-weight:700;text-transform:capitalize;"></table>

                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>

        @include('admin.modals.rejected')
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

    {{-- datatables --}}
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


    <!-- Datatable init js -->
    {{-- <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        // test data format
        var dataArray = [
        { name: 'John Doe', email: 'john@example.com', age: 25 },
        { name: 'Jane Smith', email: 'jane@example.com', age: 30 },
        // Add more objects as needed
        ];
        var dataToRender =  @json($rejected);
        console.log(dataToRender)

        $(document).ready(function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // render data
            $('#rejected-table').DataTable({
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
                    // { 
                    //     data: null, 
                    //     title: 'Product Size : ',
                    //     render: function(data, type, row){
                    //         if(row.inventory.size != null){
                    //             return `<span class="badge bg-success p-1"><b>${row.inventory.size}</b></span>`
                    //         }else{
                    //             return `<span class="badge bg-danger p-1"><b>Not-Available</b></span>`
                    //         }
                    //     } 
                    // },
                    { data: 'stocks', title: 'Product Quantity : ' },
                    { 
                        data: null, 
                        title: 'Date : ',
                        render:function(data, type, row){
                            // Create a Date object with the given date string
                            const originalDate = new Date(row.inventory.created_at);

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
                        title: 'Status',
                        data: null,
                        render: function(data, type, row){
                            // Create a Date object with the given date string
                            const originalDate = new Date(row.inventory.created_at);

                            // Extract components of the date
                            const year = originalDate.getUTCFullYear();
                            const month = originalDate.getUTCMonth() + 1; // Months are zero-based, so add 1
                            const day = originalDate.getUTCDate();

                            // Format the new date string
                            const formattedDateString = `${year}-${month < 10 ? '0' : ''}${month}-${day < 10 ? '0' : ''}${day}`;
                            // return formattedDateString;

                            var today = new Date()
                            var givenDate = new Date(formattedDateString)
                            if(givenDate < today){
                                return `<span class="badge bg-info p-1"><b>Newest</b></span>`
                            }else{
                                return `<span class="badge bg-warning p-1"><b>Oldest</b></span>`
                            }
                        }
                    },
                    { 
                        title: 'Unit Type : ',
                        data: null,
                        render:function(data, type, row) {
                            return `<p class="badge bg-success p-1">${row.inventory.unit_type}</p>`
                        },
                    },
                    { data: 'description', title: 'Description : ' },
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
            // add rejected products
            // $(document).on('click', '.rejectedAdd', function() {
            //     $('#addRejectedModal').modal('show')
            // })

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
            
            $('#productName').on('input', function() {
                console.log($(this).val())
                makeRequest($(this).val())
                .done((res)=>{
                    // console.log(res)
                    $('#productBrand').val(res.rejected.product_brand)
                    $('#productStock').val(res.rejected.stocks)
                    $('#productPrice').val(res.rejected.product_pcs_price)
                })
                .fail((err)=>{
                    console.log(err)
                })
            })
            // make a request to the ai
            function makeRequest(p, csrfToken) {
                return $.ajax({
                    method: 'GET',
                    url: '/get-rejected',
                    data: {'productName':p},
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            }
        })
    </script>
@endsection
