<x-site-master-layout>

<div class="page-title-area page-title-img-three" style="background-image: url({{ $termsAndCondition->getFirstOrDefaultMediaUrl('image','original') }})">
    <div class="container">
        <div class="page-title-item ">
            <h2 >Terms And Condition</h2>
            <ul>
                <li>
                    <a href="{{ route('site.page') }}">Home</a>
                </li>
                <li>
                    <i class='bx bx-chevron-right'></i>
                </li>
                <li>Terms And Condition</li>
            </ul>
        </div>
    </div>
</div>


<div class="contact-location-area pt-100 pb-100">
    <div class="col-sm-11 col-lg-12">
        <div class="location-item">
            
        <h1 style="text-align: center;">Terms And Condition</h1>
            <p  style="padding-left:2%"  >{!! $termsAndCondition->description !!}<//p>
        </div>
    </div>
</div>
</x-site-master-layout>