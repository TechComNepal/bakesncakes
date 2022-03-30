@if ($paginator->hasPages())
    <div class="blog-details-nav">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><a href="javascript:void(0);"><i class="fa fa-angle-double-left"></i></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
            @endif

            @if($paginator->currentPage() > 3)
                <li><a href="{{ $paginator->url(1) }}">1</a></li>
            @endif
            @if($paginator->currentPage() > 4)
                <li><a >...</a></li>
            @endif

            @foreach(range(1, $paginator->lastPage()) as $i)
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="active"><a>{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach

            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                <li ><a >...</a></li>
            @endif
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a>
                </li>
            @else
                <li class="disabled">
                    <a href="javascript:void();"><i class="fa fa-angle-double-right"></i></a>
                </li>
            @endif


        </ul>
    </div>
@endif
