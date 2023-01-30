<x-app-layout>
<x-slot name="header">
    <h1>Коллекции</h1>
    <a href="{{ route('pr_collections.create') }}">Создать новую коллекцию</a>
</x-slot>

<table class="w-full">
    <thead class="border-b-2 border-solid border-black text-left">
        <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>Псевдоним</th>
            <th>Статус публикации</th>
            <th>Валюта цены</th>
            <th>Цена по умолчанию</th>
            <th>Категория</th>
            <th>Вес при сортировке</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $collection)
            <tr class="border-b border-dashed text-left">
                <td>{{ $collection->id }}</td>
                <td>
                    <a class="text-blue-600 hover:text-blue-900"
                        href="{{ route('pr_collections.show', ['pr_collection' => $collection->id]) }}">
                        {{ $collection->name }}
                    </a>
                </td>
                <td>{{ $collection->nickname }}</td>
                <td>{{ $collection->published }}</td>
                <td>{{ $collection->currency_of_price }}</td>
                <td>{{ $collection->default_price }}</td>
                <td>{{ $collection->category?->name }}</td>
                <td>{{ $collection->sort }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>