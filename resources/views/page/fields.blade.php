@php
    if (old('title')) {
        $title = old('title');
    } elseif (isset($page)) {
        $title = $page->title;
    } else {
        $title = '';
    }
    
    if (old('name')) {
        $name = old('name');
    } elseif (isset($page)) {
        $name = $page->name;
    } else {
        $name = '';
    }
    
    if (old('slug')) {
        $slug = old('slug');
    } elseif (isset($page)) {
        $slug = $page->slug;
    } else {
        $slug = '';
    }
    
    if (old('description')) {
        $description = old('description');
    } elseif (isset($page)) {
        $description = $page->description;
    } else {
        $description = '';
    }
    
    if (old('text-content')) {
        $text_content = old('text-content');
    } elseif (isset($page)) {
        $field = 'text-content';
        $text_content = $page->$field;
    } else {
        $text_content = '';
    }

    if(isset($page)) {
        $params = json_decode($page->params);
        if (isset($params->filter)) {
            foreach ($params->filter as $key => $value) {
                $$key = $value;
            }
        }
    }

@endphp
<div>
    <x-label for="title" value="Заголовок (используется при формировании title и h1)" />

    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$title" required autofocus />
</div>
<div>
    <x-label for="name" value="Машинное имя" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$name" required autofocus />
</div>

<div>
    <x-label for="slug" value="Slug" />

    <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="$slug" autofocus />
</div>
<div>
    <x-label for="description" value="Мета-тег description" />

    <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$description" autofocus />
</div>

<div class="hidden">
    <x-label for="type" value="Тип страницы" />

    <x-input id="type" class="block mt-1 w-full" type="text" name="type" value="{{ $pageType }}" autofocus />
</div>
@if($pageType === 'selection')
    <div>
        <x-label for="filter" value="Фильтры" />
        @include('filters')
    </div>
@endif

@if(Route::currentRouteName() === 'pages.edit')
    <div>
        <x-label for="text-content" value="Текст на странице" />
        <textarea name="text-content" id="editor">{{ $text_content }}</textarea>
    </div>

    <script src="/ckeditor5/build/ckeditor.js"></script>
    <script src="/ckeditor5/sample/script.js"></script>
    <script>
        watchdog
            .create(document.querySelector('#editor'), {
                // Editor configuration.
                simpleUpload: {
                    uploadUrl: "{{ route('pictures.store', ['page' => $page->id]) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                }
            })
            .catch(handleSampleError);
    </script>

    <style>
        .ck-content ul {
            padding-left: 1em;
        }

        .ck-content p,
        .ck-content ul {
            margin: 0 0 1em 0;
            line-height: 1.5;
        }

        .ck-content ul li {
            margin: 0 0 0.3em 0;
            list-style-type: circle;
        }
    </style>

    <div>
        @php
            $isPublished = $page->published === 'true';
        @endphp
        <x-input id=published type="checkbox" name="published" value="true" :checked="$isPublished"/>
        <x-label class="inline-block" for="published" value="Опубликовать" />
    </div>
@endif