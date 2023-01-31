<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-form-card>
        <h1>Загрузить файл остатков</h1>
        <form method="POST" action={{ route('upload.excel') }} enctype="multipart/form-data">
            @csrf
            <div>
                <x-label for="supplier_id" value="Поставщик" />
                <select name="supplier_id">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('supplier_id')" class="" />
            </div>
            <div>                
                <input name="excel_file" type="file">
                <x-input-error :messages="$errors->get('excel_file')" class="" />
            </div>
            <div><input type="submit"></div>
        </form>
    </x-form-card>
</x-app-layout>
