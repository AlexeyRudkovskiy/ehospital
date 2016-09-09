<ul class="pagination">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">@lang('management.label.pagination.previous')</span></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('management.label.pagination.previous')</a></li>
    @endif

    @php($showedDots = false)
    @php($offset = config('eh.pagination.offset'))

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage() )
                    <li class="active"><span>{{ $page }}</span></li>
                    @php($showedDots = false)
                @elseif (($page - $offset <= $paginator->currentPage() && $page + $offset >= $paginator->currentPage()) || $page <= $offset || $page > 0)
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @php($showedDots = false)
                @else
                    @if(!$showedDots)
                        <li><span>...</span></li>
                        @php($showedDots = true)
                    @endif
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('management.label.pagination.next')</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">@lang('management.label.pagination.next')</span></li>
    @endif
</ul>