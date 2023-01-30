<x-app-layout>
    <x-slot name="header">
        Категории
    </x-slot>
    <div class="px-96">
        <form method="POST" action="{{ route('categories.store') }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            <div>
                <x-label for="name" value="Название категории" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="category_id" value="Родительская категория" />

                <x-input id="category_id" class="block mt-1 w-full" type="text" name="category_id" :value="old('category_id')" autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>

        <ul>
            @foreach ($categories as $category)
                <li>{{ $category->id }} - <a href="{{ route('categories.show', $category->id)}}">{{ $category->name }}</a> 
                    <a href="{{ route('categories.edit', ['category' => $category]) }}">
                        <small>(редактировать)</small>
                    </a>
                </li>
                    <ul>
                    @foreach ($category->childrenCategories as $childCategory)
                        @include('category.child_category', ['child_category' => $childCategory])
                    @endforeach
                    </ul>
            @endforeach
        </ul>
    </div>
</x-app-layout>