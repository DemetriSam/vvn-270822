@php
if(!isset($category)) {
$category = new App\Models\Category;
}
@endphp
<div>
    <x-label for="name" value="Название категории во множественном числе" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $category->name" required autofocus />
</div>
<div>
    <x-label for="name_single" value="Название категории в единственном числе" />

    <x-input id="name_single" class="block mt-1 w-full" type="text" name="name_single" :value="old('name_single') ?? $category->name_single" required autofocus />
</div>
<div>
    <x-label for="description" value="Описание" />

    <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description') ?? $category->description" required autofocus />
</div>

<div>
    <x-label for="slug" value="Slug" />

    <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug') ?? $category->slug" autofocus />
</div>
<div>
    <x-label for="category_id" value="Родительская категория (id)" />

    <x-input id="category_id" class="block mt-1 w-full" type="text" name="category_id" :value="old('category_id') ?? $category->category_id" autofocus />
</div>