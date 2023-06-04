<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать новый оттенок
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('colors.store') }}" enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <div>
                <x-label for="name" value="Название цвета" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div>
                <x-label for="slug" value="Машинное имя (вида red, violet, grey и т.д.)" />

                <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" autofocus />
            </div>

            <div>
                <x-label for="color_hash" value="Хэш" />

                <x-input id="color_hash" class="block mt-1 w-full" type="text" name="color_hash" :value="old('color_hash')" autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-form-card>

</x-app-layout>