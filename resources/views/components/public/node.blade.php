<div class="nodes__item nodes__cell the-product" data-nid="{{ $product?->id }}">
    <div class="product-card__item product-card__item_gallery gallery nodes__img">

        <div class="swiper-grid">
            <div class="swiper swiper-rec ">
                <div class="swiper-wrapper">
                    @foreach ($product->images as $image)
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
    </div>
    <div class="product-card__item product-card__item_h1 h1 nodes__label">
        @php
        $routeName = $product->category->slug . '.product';
        try {
        $url = route($routeName, ['pr_cvet' => $product]);
        } catch (\Throwable $th) {
        $url = route('carpets.product', ['pr_cvet' => $product]);
        }
        @endphp
        <a id="title-link-{{$product->id}}" href="{{ $url }}" {{-- style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 16px;" --}}>{{ $product->title }}</a>
    </div>
    <div class="specs__item product-card__item product-card__item_spec price nodes__price">
        {{ $product->price }}
    </div>
    <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
    </div>
</div>

{{-- <script>
    let titleLink = document.getElementById("title-link-{{$product->id}}");
let title = titleLink.textContent;

let fontSize = window.getComputedStyle(titleLink).fontSize;
fontSize = parseFloat(fontSize);

while (titleLink.offsetWidth < titleLink.scrollWidth && fontSize> 0) {
    fontSize -= 1;
    titleLink.style.fontSize = fontSize + "px";
    }
    </script> --}}