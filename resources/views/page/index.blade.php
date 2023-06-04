<x-app-layout>
    <x-slot name="header">
        <h1>Выборки</h1>
        <a href="{{ route('pages.create') }}">Создать новую выборку</a>
    </x-slot>
    
    <table class="w-full">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>Id</th>
                <th>Машинное имя</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $page->id }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900"
                            href="{{ route('pages.show', ['page' => $page->id]) }}">
                            {{ $page->slug }}
                        </a>
                    </td>
                    <td><a href="{{ route('pages.edit', ['page' => $page]) }}">Редактировать</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-app-layout>