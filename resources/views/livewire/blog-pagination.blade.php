<x-new-site-master-layout>
<main class="main">
        <div class="page-header mt-30 mb-75">
            <div class="container">
                <div class="archive-header archive-blog-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3 blog-banner">
                            <h1 class="mb-15">Blog & News</h1>
                            <div class="breadcrumb blog-breadcrumb">
                                <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Blog & News
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="page-content mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="shop-product-fillter mb-50">
                            <h2 class=" text-align-center">
                                <!-- <img class="w-36px mr-10" src="assets\imgs\theme\bakes-img-assets\blog-11.jpg" alt=""> -->
                                Our Regular Blogs
                            </h2>
                            <div class="totall-product">
                            </div>
                            <!-- <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">50</a></li>
                                            <li><a href="#">100</a></li>
                                            <li><a href="#">150</a></li>
                                            <li><a href="#">200</a></li>
                                            <li><a href="#">All</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span>Featured <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="active" href="#">Featured</a></li>
                                            <li><a href="#">Newest</a></li>
                                            <li><a href="#">Most comments</a></li>
                                            <li><a href="#">Release Date</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="loop-grid loop-big">
                            <div class="row">
                                @foreach ($blogs ?? '' as $blog)
                                    <article class="first-post mb-30 hover-up animated" style="visibility: visible">
                                        <div class="position-relative overflow-hidden">
                                            <span class="top-left-icon"><i class="fi-rs-headphones"></i></span>
                                            <div class="post-thumb border-radius-15">
                                                <a href="blog-post-right.html">
                                                    <img class="border-radius-15"
                                                        src="{{ $blog->getFirstOrDefaultMediaUrl('image', 'original') }}"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="   entry-content">
                                            <h2 class="post-title mb-20">
                                                <a href="#">{{ $blog->title }} </a>
                                            </h2>
                                            <p class="post-exerpt font-medium text-muted mb-30">
                                                {!! Str::limit($blog->description, '190', '...') !!}</p>
                                            <div class="mb-20 entry-meta meta-2">
                                                <div class="entry-meta meta-1 mb-30">
                                                    <div class="font-sm">

                                                        <span><span
                                                                class="mr-10 text-muted"></span>{{ $blog->created_at->isoFormat('LL') }}</span>

                                                    </div>
                                                </div>

                                                <a href="{{ route('site.page.singleblog', $blog->slug) }}"
                                                    class="cmn-btn">Read
                                                    more<i class="fi-rs-arrow-right ml-10"></i></a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach

                            </div>
                        </div>
                        <div class="pagination-links">
                    {{ $blogs->links() }}
                </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-new-site-master-layout>

