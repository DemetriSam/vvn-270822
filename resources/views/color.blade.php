<x-layout>
    <x-slot:title>
        {{ __('public.colors.' . $category->slug . '.' . $color->slug . '.title') }}
    </x-slot:title>
    <x-slot:description>
        {{ __('public.colors.' . $category->slug . '.' . $color->slug . '.description') }}
    </x-slot:description>
    <section class="recomendations">
        <x-public.nodes :title="__('public.colors.' . $category->slug . '.' . $color->slug . '.h1')" :products="$products" />
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>

    </section>
</x-layout>