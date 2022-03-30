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
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <!-- Users -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <span data-key="t-calendar">All Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.create') }}">
                                <span data-key="t-chat">Create User</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Category -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.categories.index') }}">
                                <span data-key="t-calendar">All Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.create') }}">
                                <span data-key="t-chat">Create Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Brands -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Brands</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.brands.create') }}" data-key="t-login">Create Brands</a></li>
                        <li><a href="{{ route('admin.brands.index') }}" data-key="t-register">All Brands</a></li>
                    </ul>
                </li>

                <!-- Products -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.products.create') }}" data-key="t-login">Create Products</a></li>
                        <li><a href="{{ route('admin.products.index') }}" data-key="t-register">All Products</a></li>
                    </ul>
                </li>

                <!-- Promocodes -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="gift"></i>
                        <span data-key="t-ui-elements">Promocodes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.promocodes.create') }}" data-key="t-login">Create Promocodes</a>
                        </li>
                        <li><a href="{{ route('admin.promocodes.index') }}" data-key="t-register">All Promocodes</a>
                        </li>
                    </ul>
                </li>

                <!-- Sliders -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="layout"></i>
                        <span data-key="t-ui-elements">Sliders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.sliders.create') }}" data-key="t-login">Create Sliders</a>
                        </li>
                        <li><a href="{{ route('admin.sliders.index') }}" data-key="t-register">All Sliders</a>
                        </li>
                    </ul>
                </li>

                <!-- Advertisement -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="layout"></i>
                        <span data-key="t-ui-elements">Advertisements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.advertisements.create') }}" data-key="t-login">Create
                                Advertisement</a>
                        </li>
                        <li><a href="{{ route('admin.advertisements.index') }}" data-key="t-register">All
                                Advertisement</a>
                        </li>
                    </ul>
                </li>

                <!-- NewsLetters -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">NewsLetters</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.newsletters.index') }}" data-key="t-register">All
                                NewsLetters</a>
                        </li>
                    </ul>
                </li>

                <!-- NewsLetters -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Notifications</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.notifications.index') }}" data-key="t-register">All
                                Notifications</a>
                        </li>
                    </ul>
                </li>

                <!-- Pages -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Pages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <!--Abouts Us -->
                        <li><a href="{{ route('admin.aboutUs.setting') }}" data-key="t-starter-page">About Us</a>
                        </li>
                        <!--Contact Us-->
                        <li><a href="{{ route('admin.contactUs.list') }}" data-key="t-maintenance">Enquiry</a>
                        </li>
                        <li><a href="{{ route('admin.privacyAndPolicy.setting') }}" data-key="t-privacy">Privacy &
                                Policy</a></li>

                        <!--Services -->
                        <li><a href="{{ route('admin.services.index') }}" data-key="t-blogs"> Services</a></li>
                        <!--terms and condition -->
                        <li><a href="{{ route('admin.termsAndCondition.setting') }}" data-key="t-Terms">Terms &
                                Condition</a></li>
                        <!--Testimonials -->
                        <li><a href="{{ route('admin.testimonials.index') }}" data-key="t-blogs">Testimonials</a>
                    </ul>
                </li>

                <!-- Blogs -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="figma"></i>

                        <span data-key="t-blogs">Blogs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.blogs.create') }}" data-key="t-Terms">Create Blogs</a></li>
                        <li><a href="{{ route('admin.blogs.index') }}" data-key="t-blogs">All Blogs</a></li>

                    </ul>
                </li>



                <!-- Orders -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="shopping-cart"></i>
                        <span data-key="t-authentication">Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.orders.index') }}" data-key="t-register">All Orders</a></li>
                        <li><a href="{{ route('admin.customOrder.index') }}" data-key="t-cOrder">All Custom Order</a>

                    </ul>



                    <!-- Reports -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="hexagon"></i>
                        <span data-key="t-authentication">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.productStock.view') }}" data-key="t-login">Product stock
                                report</a></li>

                    </ul>
                </li>

                <!-- Settings -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="figma"></i>

                        <span data-key="t-blogs">Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.setting.index') }}" data-key="t-Terms">Web Settings</a>
                        </li>
                        <li><a href="{{ route('admin.setting.roles.permission.index') }}" data-key="t-blogs">Roles
                                &#38; Permission Setting</a></li>
                        <li><a href="{{ route('admin.setting.social.media.index') }}" data-key="t-blogs">Social
                                Media
                                Setting</a></li>
                        <li>
                            <a href="{{ route('admin.shippings.index') }}">
                                <span data-key="t-calendar">All Shipping</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="figma"></i>

                                <span data-key="t-blogs">Payment Settings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.setting.qrcode.index') }}" data-key="t-Terms">QR
                                        Code</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

            </ul>
            </li>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
