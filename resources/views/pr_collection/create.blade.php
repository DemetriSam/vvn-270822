<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать коллекцию
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('pr_collections.store') }}" enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Name -->
            <div>
                <x-label for="name" value="Название коллекции" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Nickname -->
            <div>
                <x-label for="nickname" value="Псевдоним" />

                <x-input id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname')" autofocus />
            </div>


            <!-- Description -->
            <div>
                <x-label for="description" value="Описание колллекции" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>
            <!-- Specs -->

            <!-- Category -->
            <div>
                <x-label for="category" value="Принадлежит к категории" />
                <select name="category_id" id="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Specs -->

            <!-- Price -->
            <div>
                <x-label for="default_price" value="Цена" />

                <x-input id="default_price" class="block mt-1 w-full" type="text" name="default_price" :value="old('default_price')" required autofocus />
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
    </x-form-card>

</x-app-layout>