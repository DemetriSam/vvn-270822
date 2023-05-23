<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description ?? 'Избранный товары' }}
    </x-slot:description>
    <x-public.nodes title="Избранное" :products="$products" />
</x-layout>