<header id="page-topbar" class="bg-white">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box bg-dark">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src=" {{ asset('logo/logo.png') }}" alt="logo-sm" height="22"  style="background: white;">
                    </span>
                    <span class="logo-lg">
                        <img src=" {{ asset('logo/logo.png') }}" alt="logo-dark" height="20"  style="background: white;">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src=" {{ asset('logo/logo.png') }}" alt="logo-sm-light" height="30"  style="background: white;">
                    </span>
                    <span class="logo-lg">
                        <img src=" {{ asset('logo/logo.png') }}" alt="logo-light" height="70" style="background: white;">
                    </span>
                    
                </a>
                
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle text-dark"></i>
            </button>  
            
        </div>

        <div class="d-flex bg-dark"> 
            {{-- assistant button --}}
            {{-- <div class="d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect assistant" id="assistant">
                    <i class="ri-apps-2-line text-white"></i>
                </button>
            </div> --}}
                
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line text-color"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            {{-- <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div> --}}
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        
                        @if (isset($notifs) && count($notifs) > 0)
                            <a href="{{ route('inventory.product.outofstocks') }}" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-danger rounded-circle font-size-16">
                                            <i class="ri-close-circle-line"></i> <!-- Use a different icon for out of stock -->
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ count($notifs)}} Product(s) Out of Stock</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">
                                                Your product
                                                @foreach ($notifs as $notif)
                                                    <span class="text-danger"><b>{{ $notif->product_name }}.</b></span><br>
                                                @endforeach 
                                                is now out of stock
                                            </p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 
                                            @php
                                                echo $currentDateTime = date('H:i:s'); // Format: HH:MM:SS    
                                            @endphp <!-- Replace with your actual timestamp --></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                        

                        {{-- <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src=" {{ asset('backend/assets/images/users/avatar-4.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.
                                        </p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a> --}}

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('inventory.product.outofstocks') }}">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--assistant-->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect assistant"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-apps-2-line text-color"></i>
                </button>
                
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user bg-white"
                        src="{{ asset('logo/logo.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 text-color">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block text-white"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end bg-dark">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="ri-user-line align-middle me-1 text-primary"></i>
                       <span class="text-white"> Profile</span>
                    </a>
            
                    <div class="dropdown-divider"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</header>

