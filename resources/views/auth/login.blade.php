<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ $pageTitle }} |Bakes and Cakes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bakes and Cakes" name="description" />
    <meta content="Bakes and Cakes" name="author" />
    <!-- App favicon -->
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="shortcut icon" type="image/png">

    <!-- Bootstrap Css -->
    <link href="{{ asset('auth/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('auth/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('auth/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    {{-- Register Css --}}
    <link rel="stylesheet" href="{{asset('site/css/login.css')}}">

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-white p-4">
                                        <h5 class="text-white">Welcome Back !</h5>
                                        <p>Sign in to continue to {{ config('app.name') }}.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('auth/assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="{{ url('/') }}" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="{{ url('/') }}" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('auth.login.authenticate') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username / Email</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" placeholder="Enter Username Or Email Address" name="username">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Enter password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check"
                                            name="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn login-btn waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <span class="text-muted">Don't have an account?
                                                    <a class="text-secondary" href="{{ route('auth.register.show') }}">Sign Up</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <label>
                                                    <a class="text-secondary" href="{{ route('forgot.password.show') }}">Forgot Your
                                                        Password </a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 text-center">
                                        <h5 class="font-size-14 mb-3">Sign in with</h5>

                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="{{ url('/auth/facebook') }}" class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ url('auth/google') }}" class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <div>
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{ config('app.name') }}. Crafted with <i
                                class="mdi mdi-heart text-danger"></i> by <a href="https://www.stylustechnepal.com/"
                                target="_blank" style="color: darkgoldenrod">Stylus Technology</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('auth/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('auth/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('auth/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('auth/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('cms/libs/js/feather.min.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('auth/assets/js/app.js') }}"></script>

</body>

</html>
