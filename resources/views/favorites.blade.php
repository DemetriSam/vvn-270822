<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        Ваши избранные ковровые покрытия и циновки
    </x-slot:description>
    <x-public.nodes title="Избранное" :products="$products" />
</x-layout>