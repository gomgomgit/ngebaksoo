@if ($paginator->hasPages())
<nav class="my-4">
    <ul class="flex justify-end gap-4">
        @if ($paginator->onFirstPage())
            <li class="cursor-not-allowed h-7 px-4 text-slate-100 transition-colors duration-150 bg-slate-400 rounded-full flex justify-center items-center">
                <span>Previous</span>
            </li>
        @else
            <li class="text-white transition-colors duration-150 bg-green-600 border border-transparent active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green h-7 px-4 rounded-full active flex justify-center items-center"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class=" disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="text-white transition-colors duration-150 bg-cyan-600 border border-transparent active:bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:shadow-outline-cyan w-7 h-7 rounded-full active flex justify-center items-center">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="text-white transition-colors duration-150 bg-green-600 border border-transparent active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green h-7 px-4 rounded-full active flex justify-center items-center"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
        @else
        <li class="cursor-not-allowed h-7 px-4 text-slate-100 transition-colors duration-150 bg-slate-400 rounded-full flex justify-center items-center"><span rel="next">Next</span></li>
        @endif
    </ul>
@endif
