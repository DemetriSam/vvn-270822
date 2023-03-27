<x-app-layout>
    <x-slot name="header">
        <h1>Рулоны</h1>
    </x-slot>

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