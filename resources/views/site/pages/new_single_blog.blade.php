<x-new-site-master-layout>
    <main class="main">
        <div class="page-content mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 m-auto">
                        <div class="single-page pt-50 pr-30">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <h6 class="mb-10"><a href="#">Blog Article</a></h6>
                                        <h2 class="mb-10">Blog Details
                                        </h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                <a class="author-avatar" href="#">
                                                    <img class="img-circle" src="assets\imgs\blog\author-1.png"
                                                        alt="">
                                                </a>
                                                <span class="post-by">By <a
                                                        href="#">{{ $blog->user->name }}</a></span>
                                                <span
                                                    class="post-on has-dot">{{ $blog->created_at->diffForHumans() }}</span>

                                            </div>
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li class="mr-5"><a href="#"><img
                                                                src="assets\imgs\theme\icons\icon-bookmark.svg"
                                                                alt=""></a></li>
                                                    <li><a href="#"><img src="assets\imgs\theme\icons\icon-heart-2.svg"
                                                                alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <figure class="single-thumbnail">
                                <img src="{{ $blog->getFirstOrDefaultMediaUrl('image', 'original') }}" alt="">
                            </figure>
                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <p class="single-excerpt">{{ $blog->title }}</p>
                                        <p>{!! $blog->description !!}
                                        </p>

                                        <h5 class="mt-50">{{ $blog->created_at->isoFormat('LL') }}</h5>


                                        <div class="entry-bottom mt-50 mb-30">
                                            <h3>Tags</h3>
                                            <div class="tags w-50 w-sm-100">
                                                @if ($blog->tags != '')
                                                    @foreach (explode(',', $blog->tags) as $tag)
                                                        <a href="blog-category-big.html" rel="tag"
                                                            class="hover-up btn btn-sm btn-rounded mr-10">{{ $tag }}</a>
                                                    @endforeach
                                                @endif

                                            </div>

                                        </div>

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
