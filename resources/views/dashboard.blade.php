<x-app-layout>
привет
    <x-slot name="header">
        <h1>Глобальные настройки</h1>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('site_info.update') }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            @foreach ($records as $record)
                <div>
                    <x-label for="key" :value="$record->label ?? $record->key" />
                    <x-input :id="$record->key" class="block mt-2 w-full" type="text" :name="$record->key" :value="old($record->key) ?? $record->value" required autofocus />
                </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <div class="mr-5"><a href="{{route('site_info.delete')}}"><small>Удалить параметр</small></a></div>
                <div><a href="{{route('site_info.create')}}"><small>Добавить новый параметр</small></a></div>
                <x-button class="ml-3">
                    <p>Обновить</p>
                </x-button>
            </div>
            
        </form>
    </x-form-card>
</x-app-layout>


