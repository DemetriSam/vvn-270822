<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Категория "{{ $category->name }}"
        </h2>
        <p><a href="{{ route('categories.edit', ['category' => $category])}}"><small>редактировать</small></a></p>
    </x-slot>

    <div class="flex justify-around	items-start">
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Добавить параметр в категорию</h3>
            <form method="POST" action="{{ route('properties.store') }} " enctype="multipart/form-data">
                @csrf
                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>
                <div>
                    <x-label for="name" value="Новое свойство" />
    
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <div class="hidden">
                    <x-label for="category_id" value="Новое свойство" />
    
                    <x-input id="category_id" class="block mt-1 w-full" type="text" name="category_id" :value="$category->id" required />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        <p>Submit</p>
                    </x-button>
                </div>
            </form>
        </x-form-card>
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Свойства категории</h3>

            @foreach ($properties as $property )
                <h2>{{ $property->name }}</h2>
                <a href="{{ route('properties.edit', ['property' => $property]) }}">
                    <small>(редактировать)</small>
                </a>
                <p>&nbsp</p>
            @endforeach
        </x-form-card>
    </div>


</x-app-layout>