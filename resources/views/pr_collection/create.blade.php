<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <form method="POST"  action="{{ route('pr_collections.store') }}" enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            <div>
                <x-label for="title" value="Название коллекции" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>


            <!-- Description -->
            <div>
                <x-label for="description" value="Описание колллекции" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>
            <!-- Specs -->

            
            <!-- Price -->
            <div>
                <x-label for="price" value="Цена" />

                <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus />
            </div>

            <!-- Image -->
            <div>
                <x-label for="image" value="Изображение" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" autofocus />
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-auth-card>

</x-app-layout>