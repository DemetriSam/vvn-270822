<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать новый цвет
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('pr_cvets.store') }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
            </x-slot>
            <!-- Title -->
            <div>
                <x-label for="title" value="Название товара" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="description" value="Описание товара" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>
                        <!-- Description -->
            <div>
                <x-label for="pr_collection_id" value="Коллекция" />
                <select name="pr_collection_id" id="pr_collection_id">
                    @foreach ($prCollections as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Specs -->



            <!-- Image -->
            
            <div>
                <x-label for="images" value="Изображение" />

                <x-input id="images" class="block mt-1 w-full" type="file" name="images[]" :value="old('image')" multiple autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>