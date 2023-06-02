<x-app-layout>
    <x-slot name="header">
        <h1>Цвета</h1>
        <a href="{{ route('pr_cvets.create') }}">Создать новый цвет</a>
    </x-slot>
    <div class="py-4">
        @php
        $prCollectionId = request()->input('filter.pr_collection_id');
        $colorId = request()->input('filter.color_id');
        $publicStatus = request()->input('filter.publicStatus');
        $hasImages = request()->input('filter.has_images');
        $category = request()->input('filter.category');
        $composition = request()->input('filter.composition');
        @endphp
        <form action="{{ route('pr_cvets.index')}}">
            <x-select name="filter[category]">
                <option value="">Категория</option>
                <option value="carpets" {{ $category == 'carpets' ? 'selected' : '' }}>Ковровые покрытия</option>
                <option value="cinovki" {{ $category == 'cinovki' ? 'selected' : '' }}>Циновки</option>
            </x-select>
            <x-select name="filter[pr_collection_id]">
                <option value="">Коллекция</option>
                @foreach($prCollections as $collection)
                <option value="{{ $collection->id }}" {{ $prCollectionId == $collection->id ? 'selected' : '' }}>{{ $collection->name }}</option>
                @endforeach
            </x-select>
            <x-select name="filter[color_id]">
                <option value="">Цвет</option>
                @foreach($colors as $color)
                <option value="{{ $color->id }}" {{ $colorId == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                @endforeach
            </x-select>
            <x-select name="filter[publicStatus]">
                <option value="">Статус публикации</option>
                <option value="true" {{ $publicStatus == 'true' ? 'selected' : '' }}>true</option>
                <option value="false" {{ $publicStatus == 'false' ? 'selected' : '' }}>false</option>
            </x-select>
            <x-select name="filter[has_images]">
                <option value="">Наличие картинки</option>
                <option value="true" {{ $hasImages == 'true' ? 'selected' : '' }}>true</option>
                <option value="false" {{ $hasImages == 'false' ? 'selected' : '' }}>false</option>
            </x-select>
            <x-select name="filter[composition]">
                <option value="">Материал</option>
                <option value="Нейлон" {{ $composition == 'Нейлон' ? 'selected' : '' }}>Нейлон</option>
                <option value="Полиэстер" {{ $composition == 'Полиэстер' ? 'selected' : '' }}>Полиэстер</option>
            </x-select>
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
                <th>Статус публикации</th>
                <th>Изображение</th>
                <th>Вес</th>
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