<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('employee.dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>


                <!-- Brands -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Brands</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('vendor.brands.index') }}" data-key="t-register">All Brands</a></li>
                        @if (auth()->user()->can('add brand'))
                            <li><a href="{{ route('vendor.brands.create') }}" data-key="t-login">Create Brands</a>
                            </li>
                        @endif
                    </ul>
                </li>


                <!-- Products -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('vendor.products.index') }}" data-key="t-register">All Products</a>
                        </li>
                        @if (auth()->user()->can('add product'))
                            <li><a href="{{ route('vendor.products.create') }}" data-key="t-login">Create
                                    Products</a></li>
                        @endif
                    </ul>
                </li>

                <!-- Orders -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="shopping-cart"></i>
                        <span data-key="t-authentication">Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('vendor.orders.index') }}" data-key="t-register">All Orders</a></li>

                    </ul>

                </li>

                <!-- Reports -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('vendor.productStock.view') }}" data-key="t-login">Product stock
                                report</a></li>
                        <li><a href="{{ route('vendor.productSold.view') }}" data-key="t-login">Product Sold
                                report</a></li>

                    </ul>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
