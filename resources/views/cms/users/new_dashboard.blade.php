<x-new-site-master-layout :pageTitle="'Dashboard'">
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>

        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">

                            @include('site._layouts._partials.sidebar')
                            <div class="col-lg-4 col-sm-6">
                                <div class="card-box card-box-profile">
                                    <div class="inner">
                                        <h3> {{ auth()->user()->orders->count() }} </h3>
                                        <h3 class="text-white"> Total Order </h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="card-box card-box-profile">
                                    <div class="inner">
                                        <h3> {{ auth()->user()->carts->count() }} </h3>
                                        <h3 class="text-white">Total Product in Cart</>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-new-site-master-layout>
