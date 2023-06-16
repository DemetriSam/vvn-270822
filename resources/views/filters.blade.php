@php
    $prCollectionId = $prCollectionId ?? (
        request()->input('filter.pr_collection_id') ?
        request()->input('filter.pr_collection_id') : 
        old('filter.pr_collection_id')
    );
    $color_id = $color_id ?? (
        request()->input('filter.color_id') ?
        request()->input('filter.color_id') :
        old('filter.color_id')
    );
    $publicStatus = $publicStatus ?? (
        request()->input('filter.publicStatus') ?
        request()->input('filter.publicStatus') :
        old('filter.publicStatus')
    );
    $has_images = $has_images ?? (
        request()->input('filter.has_images') ?
        request()->input('filter.has_images') : 
        old('filter.has_images')
    );
    $category = $category ?? (
        request()->input('filter.category') ?
        request()->input('filter.category') :
        old('filter.category')
    );
    $composition = $composition ?? (request()->input('filter.composition') ? request()->input('filter.composition') : old('filter.composition'));
    $width = $width ?? (request()->input('filter.width') ? request()->input('filter.width') : old('filter.width'));
@endphp
<x-select name="filter[category]">
    <option value="">Категория</option>
    <option value="carpets" {{ $category == 'carpets' ? 'selected' : '' }}>Ковровые покрытия</option>
    <option value="cinovki" {{ $category == 'cinovki' ? 'selected' : '' }}>Циновки</option>
</x-select>
<x-select name="filter[pr_collection_id]">
    <option value="">Коллекция</option>
    @foreach ($prCollections as $collection)
        <option value="{{ $collection->id }}" {{ $prCollectionId == $collection->id ? 'selected' : '' }}>
            {{ $collection->name }}</option>
    @endforeach
</x-select>
<x-select name="filter[color_id]">
    <option value="">Цвет</option>
    @foreach ($colors as $color)
        <option value="{{ $color->id }}" {{ $color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
    @endforeach
</x-select>
<x-select name="filter[publicStatus]">
    <option value="">Статус публикации</option>
    <option value="true" {{ $publicStatus == 'true' ? 'selected' : '' }}>true</option>
    <option value="false" {{ $publicStatus == 'false' ? 'selected' : '' }}>false</option>
</x-select>
<x-select name="filter[has_images]">
    <option value="">Наличие картинки</option>
    <option value="true" {{ $has_images == 'true' ? 'selected' : '' }}>true</option>
    <option value="false" {{ $has_images == 'false' ? 'selected' : '' }}>false</option>
</x-select>

@foreach ($propFilters as $filter)
    <x-select name="filter[{{ $filter->property->machine_name }}]">
        <option value="">{{ $filter->property->name }}</option>
        @foreach ($filter->options as $option)
            @php 
                $key = $filter->property->machine_name;
                $value = $option->value;
            @endphp
            <option :value="$value"
                {{ isset($$key) && $$key == $value || request()->input('filter.' . $key) == $value || old('filter.' . $key) == $value ? 'selected' : '' }}>
                {{ $value }}</option>
        @endforeach
    </x-select>
@endforeach
