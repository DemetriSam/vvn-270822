<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать новый оттенок
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <div>
                <x-label for="title" value="Заголовок (используется при формировании title и h1)" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>
            <div>
                <x-label for="name" value="Машинное имя" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div>
                <x-label for="slug" value="Slug" />

                <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" autofocus />
            </div>
            <div>
                <x-label for="description" value="Мета-тег description" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>

            <div class="hidden">
                <x-label for="type" value="Тип страницы" />

                <x-input id="type" class="block mt-1 w-full" type="text" name="type" value="selection" autofocus />
            </div>
            <div>
                <x-label for="filter" value="Фильтры" />
                @include('filters')
            </div>
            <div> <x-label for="text-content" value="Текст на странице" />
                <input id="text-content" type="hidden" name="text-content" value="">
                <trix-editor class="trix-content" input="text-content"></trix-editor>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-form-card>

</x-app-layout>