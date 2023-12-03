@php
    $media = $post->getFirstMedia('blog');
@endphp
<div class="artann anns__ann">
    <a href="{{ route('page', ['page' => $post->slug]) }}"><div class="artann__pic">
        @if(isset($media))
            {{ $media('tile') }}
        @else
            <img src="/img/gallery/DG 8002 hor.jpg" />
        @endif
    </div></a>
    {{-- <div class="artann__tag article-tag">Ремонт</div> --}}
    <div class="artann__label"><a href="{{ route('page', ['page' => $post->slug]) }}">{{$post->title}}</a></div>
    <div class="artann__text">{{ $post->ann }}</div>
    {{-- <div class="artann__author author">
        <img src="/img/mock/author.jpg" class="author__pic" />
        <div class="author__name-role">
            <div class="author__name">Маргарита Лисицина</div>
            <div class="author__role">Дизайнер интерьеров</div>
        </div>
    </div> --}}
</div>