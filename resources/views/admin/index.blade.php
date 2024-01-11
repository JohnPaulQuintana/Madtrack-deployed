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
    <link rel="shortcut icon" href="{{ asset('logo/logo.png') }}">

    <!-- jquery.vectormap css -->
    <link href=" {{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    {{-- <link href=" {{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}

    <!-- Responsive datatable examples -->
    <link href=" {{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style"> --}}
    <link href=" {{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href=" {{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}" id="app-style"> --}}
    <link href=" {{ asset('backend/assets/css/app.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- main contents --}}
@section('admin-dashboard')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Madtrack</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                {{-- @foreach ($sales_report as $key => $report)
                    <p>{{ $key }} {{ $report }}</p>
                @endforeach --}}
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Sales Current Month</p>
                                    <h4 class="mb-2">₱{{ $sales_report['totalSalesCurrentMonth'] }}
                                        
                                           @if ($sales_report['salesStatus'] == 'Increasing')
                                                <span class="text-success font-size-12 me-1">
                                                    <i class="ri-arrow-right-up-line me-1 align-middle text-success"></i>
                                                    {{ $sales_report['percentageChange'] }} {{ $sales_report['salesStatus'] }}
                                                </span>
                                           @else
                                            <span class="text-danger font-size-12 me-1">
                                                <i class="ri-arrow-right-down-line align-middle"></i>
                                                {{ $sales_report['percentageChange'] }} {{ $sales_report['salesStatus'] }}
                                            </span>
                                           @endif
                                
                                        
                                    </h4>
                                    {{-- <p class="text-muted mb-0 fw-bold">{{ $sales_report['salesStatus'] }}</p> --}}

                                    {{-- <p class="text-muted mb-0 fw-bold">
                                        @if ($sales_report['salesStatus'] == 'Increasing')
                                            <span class="text-success fw-bold font-size-12 me-2">
                                                <i class="ri-arrow-right-up-line me-1 align-middle text-success"></i>
                                                {{ $sales_report['percentageToday'] }}
                                            </span>
                                            
                                        @else
                                            <span class="text-danger fw-bold font-size-12 me-2">
                                                <i class="ri-arrow-right-down-line me-1 align-middle"></i>
                                                {{ $sales_report['percentageToday'] }}
                                            </span>
                                        @endif
                                        from today
                                       
                                    </p>

                                    <p class="text-muted mb-0">
                                        <span class="text-success fw-bold font-size-12 me-2">
                                            <i class="ri-arrow-right-up-line me-1 align-middle text-success"></i>
                                            {{ $sales_report['percentagePrevMonth'] }}
                                        </span>
                                        from previous month
                                    </p> --}}
        
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

              

                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Employee's</p>
                                    <h4 class="mb-2">{{ $employee['count'] }}</h4>
                                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from
                                        previous period</p> --}}
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            

                            <h4 class="card-title mb-4">Latest Transactions</h4>
                            <div class="table-responsive">
                                {{-- <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr class="text-info">
                                            
                                            <th>Transaction Type</th>
                                            <th>Transaction Description</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Status</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-info align-middle me-2"></i>{{ $transaction->transaction_type }}
                                                </div>
                                            </td>
                                            <td>{{ $transaction->transaction_description }}</td>
                                            <td>
                                                <div class="font-size-13">{{ $transaction->date }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-info align-middle me-2"></i>{{ __('Success') }}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                        <!-- end -->
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table --> --}}

                                <table id="logs-table" class="table activate-select dt-responsive nowrap w-100 text-center" style="width:100%;border:0 solid transparent; padding:10px;font-weight:700;text-transform:capitalize;">
                                    
                                </table>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>

    </div>
@endsection

{{-- footer script --}}
@section('footer-script')
     <!-- JAVASCRIPT -->
     <script src=" {{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
     <script src=" {{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <script src=" {{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
     <script src=" {{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
     <script src=" {{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
 
 
     <!-- apexcharts -->
     {{-- <script src=" {{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
 
     <!-- jquery.vectormap map -->
     <script src=" {{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
     </script>
     <script
         src=" {{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
     </script>
 
     <!-- Required datatable js -->
     <script src=" {{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
     <script src=" {{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 
     <!-- Responsive examples -->
     <script src=" {{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
     <script src=" {{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
     </script>
 
     {{-- <script src=" {{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script> --}}
 
     <!-- App js -->
     <script src=" {{ asset('backend/assets/js/app.js') }}"></script>

     <script>
        var dataToRender =  @json($transactions);
        console.log(dataToRender)
        $(document).ready(function(){
            // <th>Transaction Type</th>
            // <th>Transaction Description</th>
            // <th>Transaction Date</th>
            // <th>Transaction Status</th>
            $('#logs-table').DataTable({
                data: dataToRender,                               
                columns: [
                    { 
                        data: null, 
                        title: 'Transaction Type : ',
                        render:function(data, type, row){
                            var renderClass = ''
                            switch (row.transaction_type) {
                                case "Purchased Added":
                                    renderClass = 'bg-success'
                                    break;
                                case "Rejected Added":
                                    renderClass = 'bg-danger'
                                    break;
                                case "Add Stocks":
                                    renderClass = 'bg-info'
                                    break;
                                case "Stock Depletion":
                                    renderClass = 'bg-danger'
                                    break;
                                case "Rejected Depletion":
                                    renderClass = 'bg-danger'
                                    break;
                                case "Purchase Voided":
                                    renderClass = 'bg-info'
                                    break;
                            
                                default:
                                renderClass = 'bg-dark'
                                    break;
                            }
                            return `<span class="badge ${renderClass}">${row.transaction_type}</span>`
                        } 
                    },
                    {
                        title: "Transaction Description",
                        data: "transaction_description"
                    },
                    {
                        title: "Transaction Date",
                        data: "date"
                    },
                    {
                        title: "Transaction Status",
                        data: null,
                        render: function(data, type, row){
                            return `
                            <div class="font-size-13"><i
                                class="ri-checkbox-blank-circle-fill font-size-10 text-info align-middle me-2"></i>{{ __('Success') }}
                            </div>
                            `
                        }
                    },
                    
                ],
                responsive: true,
                "initComplete": function (settings, json) {
                    $(this.api().table().container()).addClass('bs4');
                },

            })
        })
     </script>
     {{-- <script src="{{ asset('html5-qrcodes/html5-qrcode.min.js') }}"></script>
     <script src="{{ asset('html5-qrcodes/scan.js') }}"></script> --}}
@endsection