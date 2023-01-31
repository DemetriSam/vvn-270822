<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Коллекция {{ $prCollection->name }}
        </h2>
        <p>Псевдоним: {{ $prCollection->nickname }}</p>
        <p>Категория: {{ $prCollection->category->name }}</p>
        <p><a href="{{ route('pr_collections.edit', ['pr_collection' => $prCollection])}}"><small>редактировать</small></a></p>
    </x-slot>

    <div class="flex justify-around	items-start">
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Заполнить характеристики коллекции
            </h3>
            @if ($prCollection->category->properties)
            <form action="{{ route('pr_collections.update.properties') }}">
                @foreach ($prCollection->category->properties as $property)
                <div>
                    <x-label for="{{ $property->id }}" value="{{ $property->name }}" />
                    <select name="{{ $property->id }}" id="{{ $property->id }}">
                        @foreach ($property->values as $value)
                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach 
                <x-button class="">
                    <p>Submit</p>
                </x-button>
            </form>
            @endif            
        </x-form-card>
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                Характеристики коллекции
            </h3>
            @if ($prCollection->category->properties)
                @foreach ($prCollection->category->properties as $property)
                    <p>{{$property->name}}</p>
                @endforeach 
            @endif

        </x-form-card>
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Добавить товар в коллекцию {{ $prCollection->name }}</h3>
            <form method="POST" action="{{ route('pr_cvets.store') }} " enctype="multipart/form-data">
                @csrf
                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>
                <!-- Title -->
                <div>
                    <x-label for="name_in_folder" value="Название товара" />
    
                    <x-input id="name_in_folder" class="block mt-1 w-full" type="text" name="name_in_folder" :value="old('name_in_folder')" required autofocus />
                </div>
    
                <!-- Description -->
                <div>
                    <x-label for="description" value="Описание товара" />
    
                    <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
                </div>
                            <!-- Description -->
                <div class="hidden">
                    <x-label for="pr_collection_id" value="Коллекция" />
    
                    <x-input id="pr_collection_id" class="block mt-1 w-full" type="text" name="pr_collection_id" value="{{ $prCollection->id }}" autofocus />
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
        <x-form-card>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Товары коллекции</h3>

            @foreach ($prCvets as $prCvet )
                <h2>{{ $prCvet->title }}</h2>
                <a href="{{ route('pr_cvets.edit', ['pr_cvet' => $prCvet]) }}">
                    <small>(редактировать)</small>
                </a>
                @php
                    $image = $prCvet->getFirstMedia('images');
                @endphp
                {{ $image ? $image('preview') : null }}

                <p>&nbsp</p>
            @endforeach
        </x-form-card>
    </div>


</x-app-layout>