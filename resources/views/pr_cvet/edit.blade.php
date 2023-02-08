<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('pr_cvets.update', ['pr_cvet' => $prCvet]) }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            <div>
                <x-label for="name_in_folder" value="Название товара" />
                <x-input id="name_in_folder" class="block mt-1 w-full" type="text" name="name_in_folder" :value="old('name_in_folder') ?? $prCvet->name_in_folder" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="description" value="Описание товара" />
                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description') ?? $prCvet->description" autofocus />
            </div>

            <div>
                <x-label for="pr_collection_id" value="Коллекция" />
                <select name="pr_collection_id" id="pr_collection_id">
                    @foreach ($prCollections as $collection)
                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Specs -->



            <!-- Image -->

            <div>
                <x-label for="images" value="Изображение" />

                <x-input id="images" class="block mt-1 w-full" type="file" name="images[]" :value="old('image')" multiple autofocus />
            </div>

            @php
            $mediaItems = $prCvet->getMedia('images');
            @endphp
            @foreach ($mediaItems as $mediaItem)
            <div>
                <x-input id=images_for_remove type="checkbox" name="images_for_remove[]" value="{{ $mediaItem->name }}" />
                <x-label class="inline-block" for="images_for_remove" value="Удалить картинкy {{ $mediaItem->getUrl() }}?" />
            </div>
            @endforeach


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>Submit</p>
                </x-button>
            </div>
        </form>
    </x-form-card>
    <style>
        .wide {
            display: none;
        }

        .narrow {
            display: block;
        }

        @media (min-width: 981.98px) {
            .narrow {
                display: none;
            }

            .wide {
                display: block;
            }
        }
    </style>
    <div class="narrow">
        @if($prCvet->getFirstMedia('images'))
        {{$prCvet->getFirstMedia('images')('product_narrow')}}
        @endif
    </div>
    <div class="wide"> @if($prCvet->getFirstMedia('images'))
        {{$prCvet->getFirstMedia('images')('product_wide')}}
        @endif
    </div>


</x-app-layout>