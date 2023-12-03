@php
    $title = optional(DB::table('site-info')->where('key', 'blog-title')->first())->value;   
    $description = optional(DB::table('site-info')->where('key', 'blog-description')->first())->value;   
    $h1 = optional(DB::table('site-info')->where('key', 'blog-h1')->first())->value;
@endphp
<x-layout>
    <x-slot:title>
        {{ $title ?? 'Профессиональный блог редакции — Всё-в-наличии.ру' }}
    </x-slot:title>
    <x-slot:description>
        {{ $description ?? 'Статьи об интерьере, предметах декора, текстиле и ковровых покрытиях' }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $h1 ?? 'Профессиональный блог редакции' }}</h1>
    <div class="decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
    {{-- <div class="tag-bar">
        <div class="article-tag tag-bar__tag ">Тэг</div>
        <div class="article-tag tag-bar__tag article-tag_op1">Уход</div>
        <div class="article-tag tag-bar__tag article-tag_op2">Уход</div>
        <div class="article-tag tag-bar__tag article-tag_op3">Интерьер</div>
        <div class="article-tag tag-bar__tag article-tag_op4">Лайф-хаки</div>
        <div class="article-tag tag-bar__tag article-tag_op5">Все</div>
        <div class="article-tag tag-bar__tag article-tag_op6">Все</div>
        <div class="article-tag tag-bar__tag article-tag_op7">Все</div>
    </div> --}}
    <div class="anns">
        @foreach ($posts as $post)
            <x-blog-article :post="$post" />
        @endforeach
    </div>
    <div class="recomendations__paginator">
        {{ $posts->links('vendor.pagination.default') }}
    </div>
</x-layout>