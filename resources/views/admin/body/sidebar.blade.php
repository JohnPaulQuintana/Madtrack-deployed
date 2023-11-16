<div class="vertical-menu bg-dark">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            {{-- <div class="">
                <img src=" {{ asset('logo/admin.png') }}" alt=""
                    class="avatar-md rounded-circle">
            </div> --}}
            <div class="mt-3">
                <h4 class="font-size-16 mb-1 text-white">{{ Auth::user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    <span class="text-color">{{ Auth::user()->name }}</span>
                </span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-white">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        {{-- <span class="badge rounded-pill bg-success float-end">3</span> --}}
                        <span class="text-white">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title text-white">Tables for Inventories</li>    
                <li><a href="{{ route('inventory.available.stocks') }}" class="waves-effect"><i class="ri-shopping-cart-line text-primary"></i> <span class="text-white">Stocks </span></a></li>
                <li><a href="{{ route('inventory.product.sold') }}"><i class="ri-archive-line text-success"></i> <span class="text-white">Purchased</span></a></li>
                <li><a href="{{ route('inventory.product.rejected') }}"><i class="ri-close-circle-line text-danger"></i> <span class="text-white">Rejected</span></a></li>
                <li><a href="{{ route('inventory.product.outofstocks') }}"><i class="ri-error-warning-line text-warning"></i> <span class="text-white">Out-Of-Stock</span></a></li>

                <li class="menu-title text-white">Tables for Employee's</li>

                <li><a href="{{ route('employee.table') }}"><i class="ri-user-line text-primary"></i> <span class="text-white">Present Employee</span></a></li>
                <li><a href="layouts-hori-topbar-light.html"><i class="ri-user-line text-danger"></i> <span class="text-white">Absent Employee</span></a></li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Inventory</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('inventory.available.stocks') }}">Available Stocks</a></li>
                                <li><a href="{{ route('inventory.product.sold') }}">Purchased Products</a></li>
                                <li><a href="{{ route('inventory.product.rejected') }}">Rejected Products</a></li>
                                <li><a href="{{ route('inventory.product.outofstocks') }}">Out-Of-Stock</a></li>
                        
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Employee</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('employee.table') }}">Present Employee</a></li>
                                <li><a href="layouts-hori-topbar-light.html">Absent Employee</a></li>
                               
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                <li class="menu-title text-white">Sub menu</li>
                <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line text-info"></i>
                        <span class="text-white">Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.create') }}" class="waves-effect">
                        <i class="ri-bar-chart-line text-danger"></i>
                        <span class="text-white">Reports</span>
                    </a>
                </li>

                <li class="menu-title text-white">Attendance</li>
                <li><a href="#" id="openModalAttendance"><i class="ri-calendar-line text-info"></i> <span class="text-white">Employee's Attendance</span></a></li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" id="openModalAttendance">Employee's Attendance</a></li>
                        <li><a href="auth-register.html">Register</a></li>
                        <li><a href="auth-recoverpw.html">Recover Password</a></li>
                        <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->

       
    </div>
</div>
