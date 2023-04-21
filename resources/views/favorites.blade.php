<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-public.nodes title="Избранное" :products="$products" />
</x-layout>