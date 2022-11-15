<x-guest-layout>

<h1>Цвета</h1>

@foreach ($pr_cvets as $pr_cvet )
    <h2>{{ $pr_cvet->title }}</h2>
    <p>Коллекция: {{ $pr_cvet->pr_collection_id }}</p>
    <p>Id: {{ $pr_cvet->id }}</p>
    <a href="{{ route('pr_cvets.edit', compact('pr_cvet')) }}">
        <small>(редактировать)</small>
    </a>
    @php
        $image = $pr_cvet->getFirstMedia('images');
    @endphp
    {{ $image ? $image('preview') : null }}

    <p>&nbsp</p>
@endforeach

</x-guest-layout>