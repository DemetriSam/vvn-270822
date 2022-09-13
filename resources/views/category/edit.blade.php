<x-guest-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <input name="_method" type="hidden" value="PATCH">
            <!-- Title -->
            <div>
                <x-label for="name" value="Название категории" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $category->name" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="category_id" value="Родительская категория" />

                <x-input id="category_id" class="block mt-1 w-full" type="text" name="category_id" :value="old('category_id') ?? $category->category_id" autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
        <a  href="{{ route('category.delete', ['id' => $category->id]) }}" class="red">Удалить</a>
    </x-auth-card>
</x-guest-layout>