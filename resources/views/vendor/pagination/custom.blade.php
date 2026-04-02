@if ($paginator->hasPages())
<nav class="shop-pages d-flex justify-content-between mt-3" aria-label="Page navigation">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="btn-link d-inline-flex align-items-center disabled">
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn-link d-inline-flex align-items-center">
    @endif
        <svg class="me-1" width="7" height="11">
            <use href="#icon_prev_sm" />
        </svg>
        <span class="fw-medium">PREV</span>
    @if ($paginator->onFirstPage())
        </span>
    @else
        </a>
    @endif

    {{-- Pagination Elements --}}
    <ul class="pagination mb-0">
        @foreach ($elements as $element)

            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span class="px-2">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item">
                        <a href="{{ $url }}"
                           class="btn-link px-1 mx-2 {{ $page == $paginator->currentPage() ? 'btn-link_active' : '' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach
            @endif

        @endforeach
    </ul>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn-link d-inline-flex align-items-center">
    @else
        <span class="btn-link d-inline-flex align-items-center disabled">
    @endif
        <span class="fw-medium me-1">NEXT</span>
        <svg width="7" height="11">
            <use href="#icon_next_sm" />
        </svg>
    @if ($paginator->hasMorePages())
        </a>
    @else
        </span>
    @endif

</nav>
@endif