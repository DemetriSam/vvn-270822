<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать свойство
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('properties.update', ['property' => $property]) }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <!-- Name -->
            <div>
                <x-label for="name" value="Название товара" />
                <x-input 
                    id="name" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="name" 
                    :value="old('name') ?? $property->name" 
                    required 
                    autofocus 
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
            <div><small><a href="{{ route('properties.delete', ['id' => $property->id]) }}">Удалить</a></small></div>
        </form>
    </x-form-card>
</x-app-layout>