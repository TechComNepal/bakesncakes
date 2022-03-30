<div style="margin-top: 1ex">
    @if ($paginator->hasPages())
    <ul class="pagination justify-content-end">
    
        @if ($paginator->onFirstPage())
        <li class="page-item">
            <span class="page-link">← Previous</span>
        </li>
        @else
        <li class="page-item" aria-current="page">
            <a class="page-link" aria-disabled="true" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a>
        </li>
        @endif
    
        @foreach ($elements as $element)
    
        @if (is_string($element))
        <li class="page-item"><span class="page-link">{{ $element }}</span></li>
        @endif
    
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item " aria-current="page">
            <span class="page-link active">{{ $page }}</span>
        </li>
        @else
        <li class="page-item" aria-current="page">
            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach
    
    
    
        @if ($paginator->hasMorePages())
        <li>
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-disabled="true">Next →</a>
        </li>
        @else
        <li class="page-link"><span>Next →</span></li>
        @endif
    </ul>
    @endif
    </div>