<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать рулон
        </h2>
    </x-slot>
    <x-auth-card>
        <form method="POST" action="{{ route('pr_rolls.update', ['pr_roll' => $prRoll]) }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <x-slot name="logo">
            </x-slot>
            <div>
                <x-label for="vendor_code" value="Артикул" />
                <x-input id="vendor_code" class="block mt-1 w-full" type="text" name="vendor_code" :value="old('vendor_code') ?? $prRoll->vendor_code" required autofocus />
            </div>
            <div>
                <x-label for="slug" value="Slug" />
                <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug') ?? $prRoll->slug" autofocus />
            </div>
            <div>
                <x-label for="quantity_m2" value="Количество" />
                <x-input id="quantity_m2" class="block mt-1 w-full" type="text" name="quantity_m2" :value="old('quantity_m2') ?? $prRoll->quantity_m2" autofocus />
            </div>
            <div>
                <x-label for="pr_cvet_id" value="Цвет" />
                <select name="pr_cvet_id" id="pr_cvet_id">
                    @foreach ($prCvets as $cvet)
                    <option value="{{ $cvet->id }}" @if($prRoll->pr_cvet_id === $cvet->id) selected @endif>{{ $cvet->name_in_folder }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label for="supplier_id" value="Поставщик" />
                <select name="supplier_id" id="supplier_id">
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($prRoll->supplier_id === $supplier->id) selected @endif>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>