<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $h1 }}</h1>
    <div class="decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
    <style>
        div.decorline {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
        }
    </style>
    <section class="recomendations">
        <x-public.nodes :products="$products"/>
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </section>
    <br>
    <article>{!! $text_content !!}</article>
    <style>
        article {
            max-width: 574px;
            margin: 0 auto;

        }
        article ul {
            padding-left: 1em;
        }
        article p, ul {
            margin: 0 0 1em 0;
            line-height: 1.5;
        }

        article ul li {
            margin: 0 0 0.3em 0;
            list-style-type: circle;
        }
    </style>
</x-layout>