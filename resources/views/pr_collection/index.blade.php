<x-app-layout>
    <x-slot name="header">
        <h1>Коллекции</h1>
        <p>Текущий курс евро: {{ $rate->rate }} Обновлен: {{$rate->updated_at}}</p>
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
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $collection)
            <tr class="border-b border-dashed text-left">
                <td>{{ $collection->id }}</td>
                <td>
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('pr_collections.show', ['pr_collection' => $collection->id]) }}">
                        {{ $collection->name }}
                    </a>
                </td>
                <td>{{ $collection->nickname }}</td>
                <td>{{ $collection->published }}</td>
                <td>{{ $collection->currency_of_price }}</td>
                <td>{{ $collection->default_price }}</td>
                <td>{{ $collection->category?->name }}</td>
                <td>{{ $collection->sort }}</td>
                <td><a href="{{ route('pr_collections.edit', ['pr_collection' => $collection]) }}">Редактировать</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>