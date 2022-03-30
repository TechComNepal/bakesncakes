<x-site-master-layout>


<div class="page-title-area page-title-img-two" style="background-image: url({{ $privacyAndPolicy->getFirstOrDefaultMediaUrl('image','original') }})">

    <div class="container">
        <div class="page-title-item ">
            <h2 >Privacy And Policy</h2>
            <ul>
                <li>
                    <a href="{{ route('site.page') }}">Home</a>
                </li>
                <li>
                    <i class='bx bx-chevron-right'></i>
                </li>
                <li>Privacy And Policy</li>
            </ul>
        </div>
    </div>
</div>


<div class="contact-location-area pt-100 pb-100">
    <div class="col-sm-11 col-lg-12">
        <div class="location-item">
        <h1>Privacy And Policy</h1>
            <p  style="text-align:left; padding-left:2%"  >{{ $privacyAndPolicy->description }}</p>
        </div>
    </div>
</div>
</x-site-master-layout>