@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav>
            <div class="pagination flex flex-row items-center w-fit m-auto">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link m-auto text-3xl text-black text-center relative bottom-1 select-none" aria-hidden="true">&lsaquo;</span>
                    </span>
                @else
                    <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center cursor-pointer mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">
                        <span class="page-link m-auto text-3xl text-black text-center relative bottom-1 select-none" aria-hidden="true">&lsaquo;</span>
                    </span>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                    <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link m-auto text-3xl text-black text-center relative bottom-1 select-none" aria-hidden="true">{{$element}}</span>
                    </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" >
                                    <span class="page-link m-auto text-xl text-black text-center select-none font-bold" aria-hidden="true">{{$page}}</span>
                                </span>
                            @else
                                <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center cursor-pointer mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')" class="page-link" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" ire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                    <span class="page-link m-auto text-xl text-black text-center select-none" aria-hidden="true">{{$page}}</span>
                                </span>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center cursor-pointer mx-1" aria-disabled="true" aria-label="@lang('pagination.next')" class="page-link"                wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">
                        <span class="page-link m-auto text-3xl text-black text-center relative bottom-1 select-none" aria-hidden="true">&rsaquo;</span>
                    </span>
                @else
                    <span class="page-item disabled w-8 h-8 rounded bg-white shadow-md inline-flex flex-row items-center mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link m-auto text-3xl text-black text-center relative bottom-1 select-none" aria-hidden="true">&rsaquo;</span>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>
