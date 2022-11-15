<x-guest-layout>

<h1>Коллекции</h1>

@foreach ($collections as $collection )
    <a href={{ route('pr_collections.show', $collection) }}><h2>{{ $collection->name }}</h2></a>
    <p>Цена: {{ $collection->default_price }}</p>
    <p>Id: {{ $collection->id }}</p>
    <a href="{{ route('pr_collections.edit', ['pr_collection' => $collection])}}"><small>редактировать</small></a>
    <p>&nbsp</p>
@endforeach

</x-guest-layout>