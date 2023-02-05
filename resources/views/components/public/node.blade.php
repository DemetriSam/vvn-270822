<div class="nodes__item nodes__cell the-product" data-nid="{{ $product->id }}">
    <x-public.gallery>
        <div class="swiper-grid">
            <div class="swiper swiper-rec ">
                <div class="swiper-wrapper">
                    @foreach ($product->getMedia('images') as $image)
                        <div class="swiper-slide">
                            {{ $image('rec') }}
                        </div>                        
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
    
            </div>
        </div>
    </x-public.gallery>
    <div class="product-card__item product-card__item_h1 h1 nodes__label">
        {{ $product->title }}
    </div>
    <div class="specs__item product-card__item product-card__item_spec price nodes__price">
        {{ $product->price }}    
    </div>
    <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
    </div>
</div>