<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <section class="screen1">
        <div class="main-banner">
            <picture>
                <source srcset="img/main-banner.jpg" media="(min-width: 982px)">
                <source srcset="img/375x576pic.jpg" media="(min-width: 375px) and (max-width: 424.98px)">
                <source srcset="img/425x611pic.jpg" media="(min-width: 425px) and (max-width: 767.98px)">
                <source srcset="img/768x720pic.jpg" media="(min-width: 768px) and (max-width: 981.98px)">
                <img src="img/main-banner-narrow.jpg" alt="" class="main-banner__img">
            </picture>
            <div class="main-banner__title">
                <p class="main-banner__maintitle">Каталог ковровых покрытий</p>
                <p class="main-banner__subtitle">от лучших производителей Европы и США</p>
            </div>
            <div class="main-banner__button call_designer_div">
                <a href="#designer-form-region" class="call_designer button">Вызвать дизайнера на замер</a>
            </div>
            <div class="main-banner__form">
                @if(Session::has('message'))
                <p class="">{{ Session::get('message') }}</p>
                @endif
                @include('designer-form')

            </div>
        </div>
    </section>
    @if($carpets)
    <x-public.nodes :title="$carpets['title']" :products="$carpets['products']" :route="$carpets['route']" />
    @endif
    @if($cinovki)
    <x-public.nodes :title="$cinovki['title']" :products="$cinovki['products']" :route="$cinovki['route']" />
    @endif
</x-layout>