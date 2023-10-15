@php
    $has_cvet = $has_cvet ?? (
        request()->input('filter.has_cvet') ?
        request()->input('filter.has_cvet') : 
        old('filter.has_cvet')
    );
    
    $like = $like ?? (
        request()->input('filter.like') ?
        request()->input('filter.like') :
        old('filter.like')
    );
@endphp
<x-app-layout>
    <x-slot name="header">
        <h1>Рулоны</h1>
    </x-slot>
    <div class="py-4">
        <form action="{{ route('pr_rolls.index')}}">
        <div>
            <x-label for="like" va lue="Поиск по артикулу" />
            <x-input id="like" class="block mt-1 w-full" type="text" name="filter[like]" :value="$like" autofocus />
        </div>
        <x-select name="filter[has_cvet]">
            <option value="">Привязан к цвету</option>
            <option value="true" {{ $has_cvet == 'true' ? 'selected' : '' }}>true</option>
            <option value="false" {{ $has_cvet == 'false' ? 'selected' : '' }}>false</option>
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
                <th>Артикул</th>
                <th>Slug</th>
                <th>Количество (м2)</th>
                <th>Цвет</th>
                <th>Поставщик</th>
                <th>Изменено</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prRolls as $roll)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $roll->id }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900"
                            href="{{ route('pr_rolls.show', ['pr_roll' => $roll->id]) }}">
                            {{ $roll->vendor_code }}
                        </a>
                    </td>
                    <td>{{ $roll->slug }}</td>
                    <td>{{ $roll->quantity_m2 }}</td>
                    <td>{{ $roll->prCvet?->name_in_folder }}</td>
                    <td>{{ $roll->supplier->name }}</td>
                    <td>{{ $roll->toArray()['updated_at'] }}</td>
                    
                    <td>
                        <a
                            href="{{ route('pr_rolls.edit', ['pr_roll' => $roll->id]) }}">Редактировать</a>
                    </td>
                    

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $prRolls->links() }}

</x-app-layout>