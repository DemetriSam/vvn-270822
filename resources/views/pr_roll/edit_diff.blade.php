<x-app-layout>
    <x-slot name="header">Править апдейт</x-slot>
    @if ($diff)
    <form action="{{ route('upload.check') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>Status</th>
                <th>Slug</th>
                <th>Vendor Code</th>
                <th>Количество</th>
                <th>Удалить</th>
            </tr>
            @foreach ($diff as $node)
                @if($node['type'] !== 'unchanged')
                    <tr>
                        <th>{{ $node['type'] }}</th>
                        <td><input type="text" name="slug[]" value="{{ $node['slug'] }}"></td>
                        <td><input type="text" name="vendor_code[]" value="{{ $node['value']->vendor_code }}"></td>
                        <td><input type="text" name="quantity_m2[]" value="{{ $node['value']->quantity_m2 }}"></td>
                        <td><input type="checkbox" name="delete[{{ $node['slug'] }}]"></td>
                    </tr>
                @endif
            @endforeach

            @foreach ($diff as $node)
                @if($node['type'] === 'unchanged')
                    <tr>
                        <th>{{ $node['type'] }}</th>
                        <td><input type="text" name="slug[]" value="{{ $node['slug'] }}"></td>
                        <td><input type="text" name="vendor_code[]" value="{{ $node['value']->vendor_code }}"></td>
                        <td><input type="text" name="quantity_m2[]" value="{{ $node['value']->quantity_m2 }}"></td>
                        <td><input type="checkbox" name="delete[{{ $node['slug'] }}]"></td>
                    </tr>
                @endif
            @endforeach
        </table>
        <input type="hidden" name="supplier_id" value="{{ session('supplier_id') }}">
        <x-button>Сохранить</x-button>
    </form>
    @endif

</x-app-layout>