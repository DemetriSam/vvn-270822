@php
$prCollectionId = request()->input('filter.pr_collection_id');
$colorId = request()->input('filter.color_id');
$publicStatus = request()->input('filter.publicStatus');
$hasImages = request()->input('filter.has_images');
$category = request()->input('filter.category');
$composition = request()->input('filter.composition');
@endphp

<x-select name="filter[category]">
    <option value="">Категория</option>
    <option value="carpets" {{ $category == 'carpets' ? 'selected' : '' }}>Ковровые покрытия</option>
    <option value="cinovki" {{ $category == 'cinovki' ? 'selected' : '' }}>Циновки</option>
</x-select>
<x-select name="filter[pr_collection_id]">
    <option value="">Коллекция</option>
    @foreach($prCollections as $collection)
    <option value="{{ $collection->id }}" {{ $prCollectionId == $collection->id ? 'selected' : '' }}>{{ $collection->name }}</option>
    @endforeach
</x-select>
<x-select name="filter[color_id]">
    <option value="">Цвет</option>
    @foreach($colors as $color)
    <option value="{{ $color->id }}" {{ $colorId == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
    @endforeach
</x-select>
<x-select name="filter[publicStatus]">
    <option value="">Статус публикации</option>
    <option value="true" {{ $publicStatus == 'true' ? 'selected' : '' }}>true</option>
    <option value="false" {{ $publicStatus == 'false' ? 'selected' : '' }}>false</option>
</x-select>
<x-select name="filter[has_images]">
    <option value="">Наличие картинки</option>
    <option value="true" {{ $hasImages == 'true' ? 'selected' : '' }}>true</option>
    <option value="false" {{ $hasImages == 'false' ? 'selected' : '' }}>false</option>
</x-select>

@foreach($propFilters as $filter)
<x-select name="filter[{{ $filter->property->machine_name }}]">
    <option value="">{{ $filter->property->name }}</option>
    @foreach($filter->options as $option)
    <option :value="$option->value" {{ request()->input('filter.' . $filter->property->machine_name) == $option->value ? 'selected' : '' }}>{{$option->value}}</option>
    @endforeach
</x-select>
@endforeach