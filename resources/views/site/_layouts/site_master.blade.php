<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ mix('site/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- alertifyjs Css -->

    <link href="{{ asset('cms/libs/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="{{ asset('cms/libs/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ mix('site/css/meanmenu.css') }}" rel="stylesheet">

    <link href="{{ mix('site/css/boxicons.min.css') }}" rel="stylesheet">

    <link href="{{ mix('site/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ mix('site/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <link href="{{ mix('site/css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ mix('site/css/slick-theme.min.css') }}" rel="stylesheet">

    <link href="{{ mix('site/css/magnific-popup.min.css') }}" rel="stylesheet">

    <!-- datepicker css -->
    <link href="{{ asset('cms/libs/css/flatpickr.min.css') }}" rel="stylesheet">


    <!-- Dropify -->

    <link href="{{ asset('site/libs/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ mix('site/css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('site/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/home-2.css') }}">

    <title>Bakes n Cakes</title>
    <link href="assets/img/favicon.png" rel="icon" type="image/png">

    <style>
        /* rating */
        .rating-css div {
            color: #ffab50;
            font-size: 20px;
            font-family: sans-serif;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            padding: 20px 0;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 20px;
            text-shadow: 1px 1px 0 #8f8420;
            cursor: pointer;
        }

        .rating-css input:checked+label~label {
            color: #b4afaf;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }

        .checked {
            color: #ffab50;
        }


        /* End of Star Rating */

        ul.pagination {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        ul.pagination li {
            display: inline;
        }

        ul.pagination .page-link {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        ul.pagination .page-link {
            background-color: rgba(146, 120, 128, 0.589);
            color: white;
        }

        ul.pagination .page-lin.active {
            /* background-color: #E7A9B1 */

            color: white;
        }


        .profile-nav,
        .profile-info {
            margin-top: 30px;
        }

        .profile-nav .user-heading {
            background: #fbc02d;
            color: #fff;
            border-radius: 4px 4px 0 0;
            -webkit-border-radius: 4px 4px 0 0;
            padding: 30px;
            text-align: center;
        }

        .profile-nav .user-heading.round a {
            border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 10px solid rgba(255, 255, 255, 0.3);
            display: inline-block;
        }

        .profile-nav .user-heading a img {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
        }

        .profile-nav .user-heading h1 {
            font-size: 22px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .profile-nav .user-heading p {
            font-size: 12px;
        }

        .profile-nav ul {
            margin-top: 1px;
        }

        .profile-nav ul>li {
            border-bottom: 1px solid #ebeae6;
            margin-top: 0;
            line-height: 30px;
        }

        .profile-nav ul>li:last-child {
            border-bottom: none;
        }

        .profile-nav ul>li>a {
            border-radius: 0;
            -webkit-border-radius: 0;
            color: #89817f;
            border-left: 5px solid #fff;
        }

        .profile-nav ul>li>a:hover,
        .profile-nav ul>li>a:focus,
        .profile-nav ul li.active a {
            background: #f8f7f5 !important;
            border-left: 5px solid #fbc02d;
            color: #89817f !important;
        }

        .profile-nav ul>li:last-child>a:last-child {
            border-radius: 0 0 4px 4px;
            -webkit-border-radius: 0 0 4px 4px;
        }

        .profile-nav ul>li>a>i {
            font-size: 16px;
            padding-right: 10px;
            color: #bcb3aa;
        }





        /* ul.pagination .page-link .active {background-color: rgb(177, 68, 68);} */

    </style>

    @stack('stylesheet')

    @livewireStyles
</head>

<body>

    <div class="loader" style="background: #fff; !important;">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <div class="navbar-area fixed-top mb-5">

        <div class="mobile-nav">
            <a class="logo" href="index.html">
                <img alt="Logo" src="{{ asset('site/img/logo-two.png') }}">
            </a>
        </div>

        <div class="main-nav main-nav-three">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('site.page') }}">
                        <img alt="Logo" src="{{ asset('site/img/logo.png') }}">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle active" href="{{ route('site.page') }}">Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('site.category') }}">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('site.page.aboutus') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('site.page.service') }}">Services</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('site.page.blog') }}">Blogs</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('site.page.contact') }}">Contact Us</a>
                            </li>

                            @if (session('impersonated_by'))
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0)">
                                        <span class="impersonate">Impersonated as
                                            {{ auth()->user()->name }}</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.impersonate.leave') }}">
                                        <span class="impersonate">
                                            {{ \Illuminate\Support\Str::upper('Finish Impersonated Session') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <div class="side-nav">
                            <ul class="navbar-nav">
                                <li class="nav-item nav-user">
                                    <a class="nav-link dropdown-toggle" href="#"><i
                                            class="fas fa-user-alt user-icon"></i>
                                    </a>
                                    @auth
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('user.dashboard') }}">My
                                                    Panel</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                            </li>
                                        </ul>
                                    @endauth
                                    @guest
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('auth.login.show') }}">Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('auth.register.show') }}">Register</a>
                                            </li>
                                        </ul>
                                    @endguest
                                </li>
                            </ul>
                        </div>

                        <div class="side-nav">
                            <span id="refresh_cart">
                                @include('site._layouts._partials.cart')
                            </span>

                        </div>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="pt-100 slot">

        {{ $slot }}

    </div>
    <footer class="pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a href="{{ route('site.page') }}">
                                <img alt="Logo" src="{{ asset('site/img/logo.png') }}">
                            </a>
                            <p class="text-justify">We are continuously working for providing better service to our
                                customers.
                                You can connect to us by clicking on different social media links provided below.</p>
                            <div class="social-link">
                                <ul>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class='bx bxl-facebook'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class='bx bxl-twitter'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class='bx bxl-instagram'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class='bx bxl-youtube'></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-service">
                            <h3>Services</h3>
                            <ul>
                                {{-- <li>
                                    <a href="contact-us.html">
                                        <i class='bx bx-chevron-right'></i>
                                        Support
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bx-chevron-right'></i>
                                        Career
                                    </a>
                                </li> --}}
                                {{-- <li>
                                    <a href="chefs.html">
                                        <i class='bx bx-chevron-right'></i>
                                        Chefs
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="#">
                                        <i class='bx bx-chevron-right'></i>
                                        Testimonials
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('site.page.privacyAndPolicy') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Privacy & Policy
                                    </a>
                                </li>

                                <li>


                                    <a href="{{ route('site.page.termsAndCondition') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Terms And Conditions</a>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-service">
                            <h3>Quick Links</h3>
                            <ul>
                                <li>
                                    <a href="{{ route('site.page.service') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Services
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('site.category') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Shop
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('site.page.blog') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Blogs
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('site.page.contact') }}">
                                        <i class='bx bx-chevron-right'></i>
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-service">
                            <h3>Contact Us</h3>
                            <ul>
                                <li>
                                    <a href="tel:+1123456789">
                                        <i class='bx bx-phone-call'></i>
                                        +977 1234 56 789
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:+5143456768">
                                        <i class='bx bx-phone-call'></i>
                                        +1 1434 56 768
                                    </a>
                                </li>
                                <li>
                                    <a href="../../cdn-cgi/l/email-protection.html#026b6c646d4270677176636c762c616d6f">
                                        <i class='bx bx-message-detail'></i>
                                        <span class="__cf_email__"
                                            data-cfemail="751c1b131a3507100601141b015b161a18">[email&#160;protected]</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../../cdn-cgi/l/email-protection.html#026b6c646d4270677176636c762c616d6f">
                                        <i class='bx bx-location-plus'></i>
                                        Br1. 28/A Street, Kathmandu, Nepal
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright-area">
        <div class="container">
            <div class="copyright-item">
                <p>Copyright © 2022 Design & Developed by <a href="https://stylustechnepal.com" target="_blank">Stylus
                        Technology</a></p>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="popupQuickview" tabindex="-1" aria-labelledby="popupQuickviewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ps-quickview" id="modal-size">
            <div class="modal-content">
                <div id="addToCart-modal-body">

                </div>

            </div>
        </div>
    </div>

    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
    </script> --}}

    {{-- <script src="{{ mix('site/js/jquery.js') }}"></script> --}}

    <script src="{{ mix('site/js/jquery-3.5.1.min.js') }}"></script>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('site/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <!-- datepicker js -->
    <script src="{{ asset('cms/libs/js/flatpickr.min.js') }}"></script>

    {{-- <script src="assets/js/popper.min.js"></script> --}}
    {{-- <script src="assets/js/bootstrap.min.js"></script> --}}
    <!-- Dropify -->
    <script src="{{ asset('site/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/libs/dropify/dist/js/dropify.min.js') }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ asset('cms/libs/js/alertify.min.js') }}"></script>

    <script src="{{ mix('site/js/jquery.meanmenu.js') }}"></script>

    <script src="{{ mix('site/js/owl.carousel.min.js') }}"></script>
    <script src="{{ mix('site/js/jquery.mixitup.min.js') }}"></script>

    <script src="{{ mix('site/js/slick.min.js') }}"></script>

    <script src="{{ mix('site/js/jquery.ajaxchimp.min.js') }}"></script>


    <script src="{{ mix('site/js/form-validator.min.js') }}"></script>


    <script src="{{ mix('site/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('cms/libs/js/sweetalert2.min.js') }}"></script>



    <script src="{{ mix('site/js/custom.js') }}"></script>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#refresh_cart, #cart-mini, .ps-cart--mini').hover(function(e) {
                $(".ps-cart--mini").stop(true, true).addClass("active");
            }, function() {
                $(".ps-cart--mini").stop(true, true).removeClass("active");
            });
        });
    </script>

    <!--  -->
    <script>
        function productview(id) {
            $('#popupQuickview').modal();
            $('#addToCart-modal-body').html(null);

            $.ajax({
                type: "GET",
                url: '{{ route('product.quickView') }}',
                data: {
                    id: id,
                },
                success: function(data) {
                    if (!$('#modal-size').hasClass('modal-xl')) {
                        $('#modal-size').addClass('modal-xl');
                    }
                    $('#addToCart-modal-body').html(data.modal_view);
                    $('#popupQuickview').modal('show');

                },
                error: function(data) {
                    console.log(data);
                }

            })

        }

        function addToCart() {
            $('#popupQuickview').modal();
            let ser = $('#add-to-cart-form').serializeArray();
            var delivery_date = $('#delivery_date').val();
            if (delivery_date == '') {
                $('#add_delivery_date').html(
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Delivery Date is required<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );
            } else {
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: ser,
                    success: function(data) {
                        $('#addToCart-modal-body').html(null);
                        $('#modal-size').removeClass('modal-xl');
                        $('#addToCart-modal-body').html(data.modal_view);
                        updateNavCart(data.nav_cart_view, data.cart_count);
                        $('#popupQuickview').modal('show');


                    },
                    error: function(data) {
                        console.log(data);
                        console.log('Quick View Error');
                    }
                });
            }

        }

        function updateNavCart(view, count) {
            $('.cart-count').html(count);
            $('#refresh_cart').html(view);
        }

        function removeFromCart(key) {
            $.ajax({
                type: "POST",
                url: '{{ route('cart.removeFromCart') }}',
                data: {
                    id: key
                },
                success: function(data) {
                    $('#cart-summary').html(data.cart_view);
                    updateNavCart(data.nav_cart_view, data.cart_count);
                },
                error: function(data) {
                    console.log(data);
                    console.log('Quick View Error');
                }
            });
        }

        //store newsletter and send email to admin
        $('body').on('click', '#news-btn', function(e) {
            e.preventDefault();

            var email = $("#email").val();
            $.ajax({
                url: "{{ route('newsletters.subscribe') }}",
                type: "POST",
                data: {
                    email: email,
                },
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },

                success: function(data) {

                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });

                    } else {
                        alertify.success(data.message);
                        $('#news-form')[0].reset();
                    }

                },
                error: function(data) {
                    console.log(data.error);
                }
            });
        });

        // category slide toggle

        //jquery for toggle sub menus
        $('.sub-btn').click(function() {
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.arrow').toggleClass('rotate');
        });

        //accordins
        $('.accordin_desc').hide();

        $('.accordin_title').on('click', function() {
            $(this).next().slideToggle('slow');
            $(this).parent().toggleClass('active');

            $('.accordin_title').not(this).next().slideUp('slow');
            $('.accordin_title').not(this).parent().removeClass('active');
            $(this).find('.arrow').toggleClass('rotate');
        })


        //jquery for toggle sub menus

        // $('.sub-btn').click(function() {
        //     $(this).next('.sub-menu').slideToggle();
        //     $(this).find('.dropdown').toggleClass('rotate');
        // });
    </script>


    <!-- Alertify -->
    @if (Session::has('info'))
        <script>
            alertify.message("{{ Session::get('info') }}");
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            alertify.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            alertify.error("{{ Session::get('error') }}");
        </script>
    @endif
    @if (Session::has('warning'))
        <script>
            alertify.warning("{{ Session::get('warning') }}");
        </script>
    @endif

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/61cee4b4c82c976b71c43c67/1fo82qp3a';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>


    @stack('scripts')

    @livewireScripts
</body>

</html>
