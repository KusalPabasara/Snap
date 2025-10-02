@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Mobile pagination -->
        <div class="sm:hidden w-full">
            <div class="join w-full">
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-disabled flex-1">« Previous</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn flex-1">« Previous</a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn flex-1">Next »</a>
                @else
                    <button class="join-item btn btn-disabled flex-1">Next »</button>
                @endif
            </div>
            <p class="text-sm text-center mt-2 opacity-70">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </p>
        </div>

        <!-- Desktop pagination -->
        <div class="hidden sm:flex items-center gap-4 w-full">
            <!-- Results info -->
            <div class="text-sm opacity-70">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </div>

            <!-- Page numbers -->
            <div class="join ml-auto">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-disabled">«</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn">«</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <button class="join-item btn btn-disabled">{{ $element }}</button>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="join-item btn btn-active">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="join-item btn">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn">»</a>
                @else
                    <button class="join-item btn btn-disabled">»</button>
                @endif
            </div>
        </div>
    </div>
@endif
