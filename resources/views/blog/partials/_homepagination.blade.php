@if ($posts->hasPages())
<div class="row pagination">
    <div class="column lg-12">
        <nav class="pgn">
            <ul>
                {{-- Previous Page Link --}}
                <li>
                    @if ($posts->onFirstPage())
                        <span class="pgn__prev" aria-disabled="true">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                            </svg>
                        </span>
                    @else
                        <a class="pgn__prev" href="{{ $posts->previousPageUrl() }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                            </svg>
                        </a>
                    @endif
                </li>

                {{-- Pagination Elements with Ellipsis --}}
                @php
                    $start = max(1, $posts->currentPage() - 2);
                    $end = min($posts->lastPage(), $posts->currentPage() + 2);
                @endphp

                @if($start > 1)
                    <li><a class="pgn__num" href="{{ $posts->url(1) }}">1</a></li>
                    @if($start > 2)
                        <li><span class="pgn__num dots">…</span></li>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $posts->currentPage())
                        <li><span class="pgn__num current">{{ $page }}</span></li>
                    @else
                        <li><a class="pgn__num" href="{{ $posts->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                @if($end < $posts->lastPage())
                    @if($end < $posts->lastPage() - 1)
                        <li><span class="pgn__num dots">…</span></li>
                    @endif
                    <li><a class="pgn__num" href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage() }}</a></li>
                @endif

                {{-- Next Page Link --}}
                <li>
                    @if ($posts->hasMorePages())
                        <a class="pgn__next" href="{{ $posts->nextPageUrl() }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 6.75L19.25 12L13.75 17.25"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H4.75"></path>
                            </svg>
                        </a>
                    @else
                        <span class="pgn__next" aria-disabled="true">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 6.75L19.25 12L13.75 17.25"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H4.75"></path>
                            </svg>
                        </span>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
</div>
@endif