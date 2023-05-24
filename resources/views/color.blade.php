<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <section class="recomendations">
        <x-public.nodes :title="$h1" :products="$products" />
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>

    </section>
</x-layout>