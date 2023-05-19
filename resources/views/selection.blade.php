<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $title }}</h1>
    <br>
    <section class="recomendations">
        <x-public.nodes :products="$products"/>
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </section>
    <br>
    <article><p>{{ $description }}</p></article>
</x-layout>