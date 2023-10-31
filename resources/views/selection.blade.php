<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $h1 }}</h1>
    <div class="decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
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
        <article>{!! $text_content !!}</article>
    @endif

</x-layout>