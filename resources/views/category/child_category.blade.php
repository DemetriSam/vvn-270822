<li class="pl-10">
    {{ $child_category->id }} - {{ $child_category->name }}
    <a href="{{ route('categories.edit', ['category' => $child_category]) }}">
        <small>(редактировать)</small>
    </a>
</li>
@if ($child_category->categories)
    <ul class="pl-10">
        @foreach ($child_category->categories as $childCategory)
            @include('category.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif