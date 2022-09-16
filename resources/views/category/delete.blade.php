<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        
        <p>
            Я уверен, что хочу удалить категорию {{ $category->id }} - {{ $category->name }}. При нажатии на эту ссылку категория будет удалена безвозвратно
        </p>

        <form method="POST" action="{{ route('category.destroy', ['id' => $category->id]) }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <input name="_method" type="hidden" value="DELETE">
            <x-button class="ml-3">
                <p>УДАЛИТЬ БЕЗВОЗВРАТНО</p>
            </x-button>
            </div>
        </form>
        <a  href="{{ route('category.edit', ['id' => $category->id]) }}" class="red bold">
            Вернуться назад
        </a>
    </x-auth-card>

</x-app-layout>