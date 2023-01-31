<x-app-layout>
    <x-slot name="header">Проверка загруженных остатков</x-slot>
    @if(session()->has('success'))
    {{ session()->get('success') }}
    @endif
    @if ($diff)
    <table>
        <thead>
            <td>Slug</td>
            <td>Status</td>
            <td>Vendor Code</td>
            <td>Quantity(m2)</td>
        </thead>
        @foreach ($diff as $node)
        @if($node['type'] !== 'unchanged')
        <tr>
            <td>{{ $node['slug'] }}</td>
            <td>{{ $node['type'] }}</td>
            <td>{{ $node['value']->vendor_code }}</td>
            <td>{{ $node['value']->quantity_m2 }}</td>
        </tr>
        @endif
        @endforeach
    </table>
    @endif
    <div class="flex gap-3">
        <form action="{{ route('upload.edit', ['supplier_id' => session('supplier_id')]) }}">
            @csrf
            <x-button>Править</x-button>
        </form>
        <form action="{{ route('upload.update.db') }}" method="POST">
            @csrf
            <input type="text" class="hidden" name="supplier_id" value="{{ session('supplier_id') }}">
            <x-button>Подтвердить</x-button>
        </form>
    </div>
</x-app-layout>