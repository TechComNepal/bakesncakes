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
    <!-- datepicker css -->
    <link href="{{ asset('cms/libs/css/flatpickr.min.css') }}" rel="stylesheet">


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
</head>

<body>
    


    <!-- Quick view -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-2.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-1.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-3.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-4.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-5.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('new_frontend\assets\imgs\shop\product-16-6.jpg ') }}"
                                            alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img
                                            src="{{ asset('new_frontend\assets\imgs\shop\product-16-7.jpg" alt="product image') }}">
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-3.jpg" alt="product image') }}">
                                    </div>
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-4.jpg" alt="product image') }}">
                                    </div>
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-5.jpg" alt="product image') }}">
                                    </div>
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-6.jpg" alt="product image') }}">
                                    </div>
                                    <div><img src="assets/imgs/shop/thumbnail-7.jpg" alt="product image"></div>
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-8.jpg" alt="product image') }}">
                                    </div>
                                    <div><img
                                            src="{{ asset('new_frontend\assets\imgs\shop\thumbnail-9.jpg" alt="product image') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <span class="stock-status out-stock"> Sale Off </span>
                            <h3 class="title-detail"><a href="shop-product-right.html" class="text-heading">Seeds of
                                    Change Organic Quinoa, Brown</a></h3>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">$38</span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15">26% Off</span>
                                        <span class="old-price font-md ml-15">$52</span>
                                    </span>
                                </div>

                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <span class="qty-val">1</span>
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"><i
                                            class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="font-xs">
                                <ul>
                                    <li class="mb-5">Vendor: <span class="text-brand">Nest</span></li>
                                    <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2021</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    @include('site._layouts._partials._new_partials.new_header')


    <main class="main">
        {{ $slot }}

    </main>


    @include('site._layouts._partials._new_partials.new_footer')

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

    <!-- datepicker js -->
    <script src="{{ asset('cms/libs/js/flatpickr.min.js') }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ asset('cms/libs/js/alertify.min.js') }}"></script>

    <!-- Vendor JS-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('new_frontend\assets\js\vendor\modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('new_frontend\assets\js\vendor\jquery-3.6.0.min.js') }}"></script>
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


        });
    </script>

    <script>
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

    @stack('scripts')
</body>

</html>
