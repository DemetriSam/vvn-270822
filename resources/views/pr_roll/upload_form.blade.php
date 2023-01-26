<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-form-card>
        <h1>Загрузить файл остатков</h1>
        <form method="POST" action={{ route('upload.excel') }} enctype="multipart/form-data">
            <div>
                <x-label for="sulllier_id" value="Поставщик" />
                <select name="sulllier_id">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                <input name="excel_file" type="file">

            </div>
        </form>
    </x-form-card>
</x-app-layout>
