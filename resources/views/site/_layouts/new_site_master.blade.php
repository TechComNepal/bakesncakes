<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Bakes n Cakes</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- jQuery and Bootstrap Icons -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ mix('site/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- alertifyjs Css -->

    <link href="{{ asset('cms/libs/css/alertify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('new_frontend\assets\imgs\theme\favicon.svg') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('new_frontend\assets\css\plugins\animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_frontend\assets\css\main.css?v=4.1') }}">
    <link rel="stylesheet" href="{{ asset('new_frontend\assets\css\new_main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/noUiSlider/nouislider.css') }}">
    <!-- datepicker css -->
    <link href="{{ asset('cms/libs/css/flatpickr.min.css') }}" rel="stylesheet">
    <!-- Dropify -->

    <link href="{{ asset('site/libs/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">


    <style>
        /* rating */
        .rating-css div {
            color: #ffab50;
            font-size: 30px;
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
            font-size: 40px;
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




    @include('site._layouts._partials._new_partials.new_header')


    <main class="main">
        {{ $slot }}

    </main>


    @include('site._layouts._partials._new_partials.new_footer')

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


    {{-- <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('new_frontend\assets\imgs\theme\Disk-1s-200px.svg') }}" alt="loader">
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bootstrap Icons -->
    <script src="{{ mix('site/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('site/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <!-- datepicker js -->
    <script src="{{ asset('cms/libs/js/flatpickr.min.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('new_frontend\assets\js\vendor\jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/libs/dropify/dist/js/dropify.min.js') }}"></script>


    <script src="{{ asset('frontend/plugins/noUiSlider/nouislider.min.js') }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ asset('cms/libs/js/alertify.min.js') }}"></script>

    <!-- Vendor JS-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('new_frontend\assets\js\vendor\modernizr-3.6.0.min.js') }}"></script>

    <script src="{{ asset('new_frontend\assets\js\vendor\jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\vendor\bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\slick.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\waypoints.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\wow.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\magnific-popup.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\select2.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\counterup.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\images-loaded.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\isotope.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\scrollup.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\plugins\jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('new_frontend\assets\js\main.js?v=4.1') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\shop.js?v=4.1') }}"></script>

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

        $('.minus').on('click', function() {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').on('click', function() {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    </script>

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

        function addToWishList(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('wishlist.store') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('.wishlist').html(data);
                    console.log(data);
                    alertify.success("Item has been added to wishlist");
                },
                error: function(data) {
                    alertify.warning("Please login first.");
                }
            });
        }

        function addToCompare(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('compare.addToCompare') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#compare').html(data);
                    alertify.success("Item has been added to compare list");
                    // $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);
                },
                error: function(data) {
                    console.log(data);
                    console.log('Compare Error');
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

    @livewireScripts
    @stack('scripts')
</body>

</html>
