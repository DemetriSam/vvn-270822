<x-guest-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('pr_cvet.store') }} " enctype="multipart/form-data">
            @csrf
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            <div>
                <x-label for="title" value="Название товара" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="description" value="Описание товара" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>
                        <!-- Description -->
            <div>
                <x-label for="pr_collection_id" value="Коллекция" />

                <x-input id="pr_collection_id" class="block mt-1 w-full" type="text" name="pr_collection_id" :value="old('pr_collection_id')" autofocus />
            </div>
            <!-- Specs -->



            <!-- Image -->
            
            <div>
                <x-label for="images" value="Изображение" />

                <x-input id="images" class="block mt-1 w-full" type="file" name="images[]" :value="old('image')" required multiple autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>