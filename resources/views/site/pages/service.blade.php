<x-site-master-layout>
    <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>


    <div class="page-title-area page-title-img-three">
        <div class="container">
            <div class="page-title-item">
                <h2>Service</h2>
                <ul>
                    <li>
                        <a href="{{  route('site.page')  }}">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Service</li>
                </ul>
            </div>
        </div>

    </div>
    


    <section class="service-area service-area-four pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach ( $services as $service)
                <div class="col-sm-6 col-lg-4">
                    <div class="service-item">
                        <a href="{{ route('site.page.singleService',$service->slug) }}">
                            <img alt="Collection" src="{{$service->getFirstOrDefaultMediaUrl('image','thumb') }}">

                            <img class="service-shape" src="{{ asset('site/img/home-one/service-shape.png') }}"
                                alt="Service">
                            <h3>{{ $service->title }}</h3>
                            <p>{!! Str::limit($service->description, 160) !!}</p>
                        </a>
                    </div>
                </div>
                @endforeach
                
        </div>
        <div class="d-flex justify-content-center" >
            {!! $services->links('site._layouts._partials.custom-pagination') !!}
        </div>
    </section>
</x-site-master-layout>