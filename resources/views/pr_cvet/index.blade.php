<x-app-layout>
    <x-slot name="header">
        <h1>Цвета</h1>
        <a href="{{ route('pr_cvets.create') }}">Создать новый цвет</a>
    </x-slot>
    <div class="py-4">
        <form action="{{ route('pr_cvets.index')}}">
            @include('filters')
            <x-button class="ml-3">
                <p>Фильтровать</p>
            </x-button>
        </form>
    </div>
    <table class="w-full">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>Id</th>
                <th>Коллекция</th>
                <th>Имя в каталоге</th>
                <th>Заголовок</th>
                <th>Оттенок</th>
                <th>Опубликовано</th>
                <th>Изображение</th>
                <th>Вес</th>
                <th>Кол-во(м2)</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prCvets as $cvet)
            <tr class="border-b border-dashed text-left">
                <td>{{ $cvet->id }}</td>
                <td>{{ $cvet->prCollection?->name }}</td>
                <td>
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('pr_cvets.show', ['pr_cvet' => $cvet->id]) }}">
                        {{ $cvet->name_in_folder }}
                    </a>
                </td>
                <td>{{ $cvet->title }}</td>
                <td>{{ $cvet->color?->name }}</td>
                <td>{{ $cvet->published }}</td>
                <td>{{ $cvet->getFirstMedia('images') ? 'yes' : 'no' }}</td>
                <td>{{ $cvet->sort }}</td>
                <td>{{ $quantities[$cvet->id] ?? 0 }}</td>
                <td>
                    <a href="{{ route('pr_cvets.edit', ['pr_cvet' => $cvet->id]) }}">Редактировать</a>
                    @if ($cvet->isPublished())
                    <a href="{{ route('pr_cvets.retract', ['pr_cvet' => $cvet->id]) }}">Снять с публикации</a>
                    @else
                    <a href="{{ route('pr_cvets.publish', ['pr_cvet' => $cvet->id]) }}">Опубликовать</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $prCvets->links() }}
</x-app-layout>