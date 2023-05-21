<x-layout>
    <x-slot:title>
        {{ __('public.colors.' . $color->slug . '.title') }}
    </x-slot:title>
    <x-slot:description>
        {{ __('public.colors.' . $color->slug . '.description') }}
    </x-slot:description>
    <section class="recomendations">
        <x-public.nodes :title="__('public.colors.' . $color->slug . '.title')" :products="$products" />
        <div class="recomendations__paginator">
            {{ $products->links('vendor.pagination.default') }}
        </div>

    </section>
</x-layout>