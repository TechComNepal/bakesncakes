<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ $pageTitle }} | Bakes and Cakes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sryngar Ecommerce" name="description" />
    <meta content="Sryngar Ecommerce" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="">

    <!-- Bootstrap Css -->
    <link href="{{ asset('cms/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('cms/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('cms/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="" alt="" height="28"> <span class="logo-txt">Bakes and
                                            Cakes</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <h4>Verify your email</h4>
                                            <p>We have sent you verification email to your<span class="fw-bold">
                                                    Email Address</span>, Please check it</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <form action="{{ route('verification.request') }}" method="post">
                                            @csrf

                                            <p class="text-muted mb-0">Didn't receive an email ?
                                                <button type="submit" class="btn btn-primary btn-sm">Request a new
                                                    link</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p>©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        {{ 'Bakes and Cakes' }}. All Rights Reserved.
                                        Designed by
                                        <a href="https://www.stylustechnepal.com/"
                                            style="margin-left: 1px;color: goldenrod" target="_blank"> Stylus
                                            Technology</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('cms/libs/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/waves.min.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('cms/js/app.js') }}"></script>

</body>

</html>
