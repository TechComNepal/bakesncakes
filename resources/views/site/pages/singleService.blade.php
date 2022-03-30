<x-site-master-layout>

    <div class="container">
        <div class="product-title-item">
            <h2  style="color:#000;">Service</h2>
            <ul>
                <li>
                    <a style="color:#000;" href="{{  route('site.page')  }}">Home</a>
                </li>
                <li>
                    <i class='bx bx-chevron-right'  style="color:#000;"></i>
                </li>
                <li>
                   <a style="color:#000;" href="{{  route('site.page.service')  }}">Services</a>
                </li>
                <li>
                    <i class='bx bx-chevron-right'  style="color:#000;"></i>
                </li>
                <li>Service Details</li>
            </ul>
    </div>


    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="service-details-item">
                        <div class="service-details-more">
                            <h3>More Services</h3>
                            <ul>
                                @foreach ($services as $serv )
                                <li>
                                    <a href="{{ route('site.page.singleService', $serv->slug) }}">
                                        {{ $serv->title }}
                                        <i class='bx bx-plus'></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

{{-- 
                        <div class="service-details-order">
                            <h3>Order Your Food Now</h3>
                            <span>09:00am - 12:00am</span>
                            <img src="{{ asset('site/img/service-details/order.png') }}" alt="Service">
                                <div class="offer-off">
                                    <span>20%</span>
                                    <span>OFF</span>
                                </div>
                        </div> --}}
                    </div>
                </div>


                <div class="col-lg-9">
                    <div class="service-details-item">
                        <div class="service-details-fresh">

                            <h2><img alt="Collection" src="{{$service->getFirstOrDefaultMediaUrl('image','thumb') }}"
                                    style="height:50px; width:50px; margin-top:20px;" /> <u>{{
                                    $service->title
                                    }} </u>
                            </h2>
                            <p>{!! $service->description !!}</p>


                            


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-site-master-layout>