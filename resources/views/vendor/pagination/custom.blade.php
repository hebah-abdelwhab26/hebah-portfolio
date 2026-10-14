
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination">
        <ul class="pagination">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">
                        @if (app()->getLocale() === 'ar')
                            <i class="fa-solid fa-chevron-right"></i>
                        @else
                            <i class="fa-solid fa-chevron-left"></i>
                        @endif
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->previousPageUrl() }}"
                       aria-label="Previous">
                        @if (app()->getLocale() === 'ar')
                            <i class="fa-solid fa-chevron-right"></i>
                        @else
                            <i class="fa-solid fa-chevron-left"></i>
                        @endif
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->nextPageUrl() }}"
                       aria-label="Next">
                        @if (app()->getLocale() === 'ar')
                            <i class="fa-solid fa-chevron-left"></i>
                        @else
                            <i class="fa-solid fa-chevron-right"></i>
                        @endif
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">
                        @if (app()->getLocale() === 'ar')
                            <i class="fa-solid fa-chevron-left"></i>
                        @else
                            <i class="fa-solid fa-chevron-right"></i>
                        @endif
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
