@if (!empty($products))
<div class="rec-block">
    @if(isset($title))
    <div class="rec-block__title">
        <div class="rec-block__label">
            @if (Route::currentRouteName() === 'catalog.color')
            <h1>{{ $title }}</h1>
            @else
            {{ $title }}
            @endif
        </div>
        <div class="rec-block__decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
    </div>
    @endif

    <div class="rec-block__nodes nodes">
        @foreach ($products as $product)
        <x-public.node :product="$product" />
        @endforeach
    </div>

    @if (!empty($route))
    <div class="rec-block__seemore">
        <x-public.seemore :route="$route">
            @if(!empty($linktext))
            {{ $linktext }}
            @else
            Смотреть всё
            @endif
        </x-public.seemore>
    </div>
    @endif
</div>
@endif