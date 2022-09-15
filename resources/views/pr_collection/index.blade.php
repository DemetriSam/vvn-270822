<x-guest-layout>

<h1>Коллекции</h1>

@foreach ($collections as $collection )
<h2>{{ $collection->title }}</h2>
<p>Цена: {{ $collection->price }}</p>
<p>Id: {{ $collection->id }}</p>
<p>&nbsp</p>
@endforeach

</x-guest-layout>