<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <form method="POST" action="{{ route('categories.update', ['category' => $category]) }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <input name="_method" type="hidden" value="PATCH">
            @include('category.fields')
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
        <a href="{{ route('categories.delete', ['id' => $category->id]) }}" class="red">Удалить</a>
    </x-auth-card>
</x-app-layout>