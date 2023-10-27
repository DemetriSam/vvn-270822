<x-app-layout>
    <x-slot name="header">
        <h1>Удалить параметр</h1>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('site_info.destroy') }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <div>
                <x-label for="key" value="Машинное имя" />
                <x-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Удалить</p>
                </x-button>
            </div>
            
        </form>
    </x-form-card>
</x-app-layout>


