<x-site-master-layout>

    <div class="page-title-area" 
        style="background-image: url({{ $blog->getFirstOrDefaultMediaUrl('image','original') }}) ; 
        box-shadow: inset 300px 200px 9810px #514a4a66;
                ">
        
        <div class="container">
            <div class="page-title-item" style="box-shadow: inset 300px 200px 9810px #a7a7a732; width:31%; height:100px">
                <h2>Blog</h2>
                <ul>
                    <li>
                        <a href="{{  route('site.page')  }}">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        <a href="{{  route('site.page.blog')  }}">Blogs</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Blog Detais</li>
                </ul>
            </div>
        </div>
    </div>



    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="service-details-item">
                        <div class="service-details-more blog-details-more">
                            <h3>Recent Blog</h3>
                            <ul>
                                @foreach ($blogs as $row )

                                <li>

                                    <a href="{{ route('site.page.singleblog', $row->slug) }}">
                                        {{ $row->title }}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="service-details-more blog-details-more">
                            <h3>Categories</h3>

                            <ul>
                                @foreach ($categories as $category )

                                <li>
                                    <a href="#">
                                        {{ $category->name }}
                                        
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="blog-details-tags">
                            <h3>Tags</h3>
                            <ul>
                                @if ($blog->tags != "")
                                @foreach(explode(',', $blog->tags) as $tag)
                                <li>
                                    <a href="#">{{ $tag }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        {{-- {!! $blogs->links('pagination-links') !!} --}}

                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="service-details-item">
                        <div class="service-details-fresh">
                            <h2>{{ $blog->title }}</h2>
                            <p>{!! $blog->description !!}</p>

                            <div class="blog-details-nav">
                                <ul>
                                    <li>
                                        <a href="#">Previous</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.page.singleblog',$blog->slug) }}">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-site-master-layout>