<x-app-layout>
    <x-slot name="header">
        <h1>Страницы</h1>
        <a href="{{ route('pages.create', ['type' => 'selection']) }}">Создать новую выборку</a>
        <a href="{{ route('pages.create', ['type' => 'article']) }}">Создать новую статью</a>
    </x-slot>
    
    <table class="w-full">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>Id</th>
                <th>Slug</th>
                <th>Тип страницы</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $page->id }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900"
                            href="{{ route('page', ['page' => $page->slug]) }}">
                            {{ $page->slug }}
                        </a>
                    </td>
                    <td>{{ $page->type }}</td>
                    <td>
                        <a href="{{ route('pages.edit', ['page' => $page]) }}">Редактировать</a>
                        @if ($page->isPublished())
                            <a href="{{ route('pages.retract', ['page' => $page->id]) }}">Снять с публикации</a>
                        @else
                            <a href="{{ route('pages.publish', ['page' => $page->id]) }}">Опубликовать</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </x-app-layout>