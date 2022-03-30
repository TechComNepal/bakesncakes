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

                <!-- Category -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('employee.categories.index') }}">
                                <span data-key="t-calendar">All Category</span>
                            </a>
                        </li>

                        @if(auth()->user()->can('add category'))
                        <li>
                            <a href="{{ route('employee.categories.create') }}">
                                <span data-key="t-chat">Create Category</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <!-- Brands -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Brands</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.brands.index') }}" data-key="t-register">All Brands</a></li>
                        @if(auth()->user()->can('add brand'))
                            <li><a href="{{ route('employee.brands.create') }}" data-key="t-login">Create Brands</a></li>
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
                        <li><a href="{{ route('employee.products.index') }}" data-key="t-register">All Products</a></li>
                        @if(auth()->user()->can('add product'))
                            <li><a href="{{ route('employee.products.create') }}" data-key="t-login">Create Products</a></li>
                        @endif
                    </ul>
                </li>

                <!-- Blogs -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="figma"></i>

                        <span data-key="t-blogs">Blogs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employee.blogs.index') }}" data-key="t-blogs">All Blogs</a></li>
                        @if(auth()->user()->can('add blog'))
                        <li><a href="{{ route('employee.blogs.create') }}" data-key="t-Terms">Create Blogs</a></li>
                        @endif

                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
