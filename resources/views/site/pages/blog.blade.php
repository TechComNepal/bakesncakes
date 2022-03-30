<x-site-master-layout>

    <div class="page-title-area page-title-img-three">
        <div class="container">
            <div class="page-title-item">
                <h2>Blogs</h2>
                <ul>
                    <li>
                        <a href="{{  route('site.page')  }}">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Our Regular Blogs</h2>
                <p>You can visit to our blogs by clicking on blogs that have been posted regularly in our website for
                    getting further information regarding bakery products.</p>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-sm-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-top">

                            <img alt="Collection" src="{{ $blog->getFirstOrDefaultMediaUrl('image', 'original') }}">


                            <span>{{ $blog->created_at->isoFormat('LL') }}</span>
                        </div>
                        <div class="blog-bottom">
                            <h3>
                                <a>{{ $blog->title }}</a>
                            </h3>
                            <p>{!! Str::limit($blog->description, '190', '...') !!}</p>
                    <div class="">
                        <br>
                        <br>
                    
                            <a class="cmn-btn" href="{{ route('site.page.singleblog', $blog->slug) }}">Read More</a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

                
        <div class="d-flex justify-content-center" >
            {!! $blogs->links('site._layouts._partials.custom-pagination') !!}
        </div>

    </section>


</x-site-master-layout>