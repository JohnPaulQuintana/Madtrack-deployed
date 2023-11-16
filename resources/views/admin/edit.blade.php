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
    <link rel="shortcut icon" href=" {{ asset('backend/assets/images/favicon.ico') }}">

    <!-- jquery.vectormap css -->
    <link href=" {{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href=" {{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

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
@section('admin-dashboard')
<section class="page-content">
     <!-- start page title -->
     {{-- <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 mx-2">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0 me-2">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">B.I.S</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div> --}}
    {{-- <div class="header">
        <h6 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            <a href="{{ route('dashboard') }}" class="text-decoration-none border-bottom border-primary mx-4">Dashboard</a> <span class="me-4">&gt;</span> <span class="mx-auto">{{ __('Profile') }}</span>
        </h6>  
    </div> --}}

    <div class="py-12 mt-4">
        <div class="container">
            <div class="row gx-4 gy-6">
                <div class="col-12 col-sm-6 mb-5">
                    <div class="p-4 bg-white shadow rounded-lg">
                        <div class="max-w-xl">
                            @include('admin.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
        
                <div class="col-12 col-sm-6 mb-5">
                    <div class="p-4 bg-white shadow rounded-lg">
                        <div class="max-w-xl">
                            @include('admin.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="p-4 bg-white shadow rounded-lg">
                        <div class="max-w-xl">
                            @include('admin.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
@endsection
@section('footer-script')
     <!-- JAVASCRIPT -->
     <script src=" {{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
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
     {{-- <script src="{{ asset('html5-qrcodes/html5-qrcode.min.js') }}"></script>
     <script src="{{ asset('html5-qrcodes/scan.js') }}"></script> --}}
@endsection