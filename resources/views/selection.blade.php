<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $h1 }}</h1>
    <div class="decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
    <div id="filters" class="filters"><x-public.filters.up-down status="down" /></div>
    <div id="filters" class="filters"><x-public.filters.checkbox status="down" /></div>
    <section class="recomendations">
        <x-public.nodes :products="$products"/>
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </section>
    <br>
    @php
        $pageN = Request::input('pageN');
    @endphp
    @if (!isset($pageN))
        <section id="article-text">{!! $text_content !!}</section>
    @endif

</x-layout>