<x-new-site-master-layout>
    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">

        <!--End header-->
        <main class="main pages">
            <div class="page-header breadcrumb-wrap">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Pages <span></span> About us
                    </div>
                </div>
            </div>
            <div class="page-content pt-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 col-lg-12 m-auto">
                            <section class="row align-items-center mb-50">
                                <div class="col-lg-6">
                                    <img src="{{ $about->getFirstOrDefaultMediaUrl('image', 'original') }}" alt=""
                                        class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4">
                                </div>
                                <div class="col-lg-6">
                                    <div class="pl-25">
                                        <h2 class="mb-30">About Us</h2>
                                        <p class="mb-25">{!! $about->description !!}
                                        </p>


                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>


            </div>
        </main>
</x-new-site-master-layout>
