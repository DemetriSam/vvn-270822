<x-guest-layout>

<h1>Цвета</h1>

@foreach ($cvets as $cvet )
<h2>{{ $cvet->title }}</h2>
<p>Коллекция: {{ $cvet->pr_collection_id }}</p>
<p>Id: {{ $cvet->id }}</p>

@if ($cvet->images)
@foreach ($cvet->images as $image )
    <span><img src="{{ $image->get_resize('325x325') }}" /></span>
@endforeach    
@endif

<p>&nbsp</p>
@endforeach

</x-guest-layout>