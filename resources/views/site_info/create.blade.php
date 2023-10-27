<x-app-layout>
    <x-slot name="header">
        <h1>Добавить параметр</h1>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('site_info.store') }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <div>
                <x-label for="key" value="Машинное имя" />
                <x-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" required autofocus />
            </div>
            <div>
                <x-label for="label" value="Человекочитаемое имя" />
                <x-input id="label" class="block mt-1 w-full" type="text" name="label" :value="old('label')" required autofocus />
            </div>
            <div>
                <x-label for="value" value="Значение" />
                <x-input id="value" class="block mt-1 w-full" type="text" name="value" :value="old('value')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Добавить</p>
                </x-button>
            </div>
            
        </form>
    </x-form-card>
</x-app-layout>


