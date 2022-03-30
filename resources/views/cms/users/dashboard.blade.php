<x-site-master-layout :pageTitle="'Dashboard'">

    <div class="mb-5">
        <div class="container">
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

</x-site-master-layout>