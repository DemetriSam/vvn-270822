<x-guest-layout>

<h1>Цвета</h1>

@foreach ($pr_cvets as $pr_cvet )
    <h2>{{ $pr_cvet->title }}</h2>
    <p>Коллекция: {{ $pr_cvet->pr_collection_id }}</p>
    <p>Id: {{ $pr_cvet->id }}</p>
    <a href="{{ route('pr_cvets.edit', compact('pr_cvet')) }}">
        <small>(редактировать)</small>
    </a>

    {{ $pr_cvet->getFirstMedia() }}

    <!--
    @if ($pr_cvet->images)
        @foreach ($pr_cvet->images as $image )
            <span>
                <img src="{{ $image->getResize('325x325') }}" />
                
            </span>
        @endforeach    
    @endif
    -->

    <p>&nbsp</p>
@endforeach

</x-guest-layout>