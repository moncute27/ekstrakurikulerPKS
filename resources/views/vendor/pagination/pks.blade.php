@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Navigasi halaman">

        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="pager__item is-disabled">‹ Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pager__item" rel="prev">‹ Sebelumnya</a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pager__item is-disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pager__item is-active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pager__item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pager__item" rel="next">Berikutnya ›</a>
        @else
            <span class="pager__item is-disabled">Berikutnya ›</span>
        @endif

    </nav>
@endif
