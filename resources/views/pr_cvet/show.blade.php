<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $prCvet->description }}
    </x-slot:description>
    <section class="product-card">
        <div class="product-card__items the-product" data-nid="{{ $prCvet->id }}">
            <div class="product-card__item product-card__item_h1 h1 nodes__label">
                <h1>{{ $title }}</h1>
            </div>
            <x-public.gallery :images="$prCvet->images" />


            <div class="specs__item product-card__item product-card__item_spec composition">
                <div class="specs__subitem specs__subitem_name">Состав:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">{{ $prCvet->composition }}</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec width">
                <div class="specs__subitem specs__subitem_name">Ширина рулона:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">{{ $prCvet->width }}</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec height">
                <div class="specs__subitem specs__subitem_name">Высота ворса:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">{{ $prCvet->height }} мм</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                <div class="specs__subitem specs__subitem_name">Цена:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">{{ $prCvet->price }}</div>
            </div>

            <div class="product-card__item product-card__item_pc-buttons pc-buttons">
                <div class="pc-buttons__item pc-buttons__item_item1"><a class="button _icon-heart add-to-cart">Отложить</a></div>
                <div class="pc-buttons__item pc-buttons__item_item2"><a class="button_light _icon-wa" href="{{route('whatsapp')}}">Обсудить в WhatsApp</a></div>
                <div class="pc-buttons__item_item3">Вы можете вернуться к отложенному позже или пригласить
                    нашего
                    дизайнера, который привезет образцы отобранных материалов</div>
            </div>
            @if ($prCvet->description)
            <div class="product-card__item product-card__item_description description">
                <p class="block-description">Описание</p>
                <p>{{ $prCvet->description }}</p>
            </div>
            @endif

        </div>
    </section>
    <section class="recomendations">
        <x-public.nodes title="Еще в том же цвете" :products="$sameColor" :route="['catalog.color', ['category' => $prCvet->category->slug, 'color' => $prCvet->color->slug]]" />
        <x-public.nodes title="В той же коллекции" :products="$sameCollection" />
    </section>
</x-layout>