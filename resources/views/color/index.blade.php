<x-app-layout>
    <x-slot name="header">
        <h1>Оттенки</h1>
        <a href="{{ route('colors.create') }}">Создать новый оттенок</a>
    </x-slot>
    
    <table class="w-full">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>Id</th>
                <th>Имя</th>
                <th>Машинное имя</th>
                <th>Хэш</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $color->id }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900"
                            href="{{ route('colors.show', ['color' => $color->id]) }}">
                            {{ $color->name }}
                        </a>
                    </td>
                    <td>{{ $color->slug }}</td>
                    <td>{{ $color->color_hash }}</td>
                    <td><a href="{{ route('colors.edit', ['color' => $color]) }}">Редактировать</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-app-layout>