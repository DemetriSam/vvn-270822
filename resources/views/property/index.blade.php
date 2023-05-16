<x-app-layout>
    <x-slot name="header">
        <h1>Характеристики</h1>
    </x-slot>
    <div class="px-96">
        <ul>
            @foreach($props as $prop)
            <li>{{ $prop->id }} - {{ $prop->name }}
                <ul>
                    @foreach ($prop->values as $value)
                    <li class="pl-10">{{ $value->value }}</li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>