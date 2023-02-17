<div class="product-card__item product-card__item_gallery gallery nodes__img">
    {{-- <div class="gallery-thumbs" id="gallery-thumbs">
        <div class="_icon-up"></div>
        <div class="swiper-wrapper">

        </div>
        <div class="_icon-down"></div>
    </div> --}}
    <div class="swiper-grid">
        <div class="swiper swiper-main" id="swiper-main">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                <div class="slides swiper-slide gallery__slide">
                    <div class="gallery__header">
                        <div class="indicator">
                            <div class="indicator__item indicator__item_first"></div>
                            <div class="indicator__item indicator__item_middle"></div>
                            <div class="indicator__item indicator__item_last"></div>
                        </div>
                        <div class="stock-status">Много на складе</div>
                    </div>
                    <style>
                        .wide {
                            display: none;
                        }

                        .narrow {
                            display: block;
                        }

                        @media (min-width: 981.98px) {
                            .narrow {
                                display: none;
                            }

                            .wide {
                                display: block;
                            }
                        }
                    </style>
                    <div class="narrow">
                        {{ $image('product_narrow')}}
                    </div>
                    <div class="wide"> 
                        {{ $image('product_wide')}}
                    </div>
                    <div class="gallery__sharing sharing">
                        <div class="sharing__wrapper">
                            <div class="sharing__icons">
                                <div class="sharing__icon _icon-wa"></div>
                                <div class="sharing__icon _icon-telegram"></div>
                                <div class="sharing__icon _icon-email"></div>
                                <div class="sharing__icon _icon-fb"></div>
                                <div class="sharing__icon _icon-insta"></div>
                                <div class="sharing__icon _icon-viber"></div>
                            </div>
                            <div class="sharing__button sharing__button_share">
                                <div class="sharing__pic sharing__pic_share"><img src="/img/icons/share.svg" alt=""></div>
                                <div class="sharing__label">Поделиться</div>

                            </div>
                            <div class="sharing__button sharing__button_copylink">
                                <div class="sharing__label sharing__label_copylink">
                                    <span class="span_mobile">Копировать ссылку</span>
                                    <span class="span_desktop">Копировать</span>
                                </div>
                                <div class="sharing__pic sharing__pic_copylink"><img src="/img/icons/link.svg" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>


</div>