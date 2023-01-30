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
                @auth
                    <th>{{ __('views.actions.column_name') }}</th>
                @endauth
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
                    <td>{{ $roll->created_at }}</td>
                    @auth
                        <td>
                            <a data-confirm="Вы уверены?" data-method="delete"
                                class="text-red-600 hover:text-red-900"
                                href="{{ route('pr_rolls.destroy', $roll->id) }}">
                                {{ __('views.actions.delete') }} </a>
                            <a
                                href="{{ route('pr_rolls.edit', ['pr_roll' => $roll->id]) }}">{{ __('views.actions.edit') }}</a>
                        </td>
                    @endauth

                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>