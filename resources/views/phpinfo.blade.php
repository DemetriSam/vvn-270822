<x-app-layout>
    <x-slot name="header">
        <h1>Php info</h1>
    </x-slot>
    @php

    phpinfo();
    @endphp
</x-app-layout>