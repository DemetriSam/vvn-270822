<x-layout>
    <section class="recomendations">
        <x-public.nodes 
            :title="$color->name" 
            :products="$products" />
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>

    </section>
</x-layout>