<x-layout>

    <section class="product-card">
        <div class="product-card__items the-product" data-nid="59">
            <div class="product-card__item product-card__item_h1 h1 nodes__label">
                <h1>{{ $pr_cvet->title }}</h1>
            </div>
            <div class="product-card__item product-card__item_gallery gallery nodes__img">
                <div class="gallery-thumbs" id="gallery-thumbs">
                    <div class="_icon-up"></div>
                    <div class="swiper-wrapper">

                    </div>
                    <div class="_icon-down"></div>
                </div>
                <div class="swiper-grid">
                    <div class="swiper swiper-main" id="swiper-main">
                        <div class="swiper-wrapper">
                            @if($pr_cvet->images)
                            @foreach ($pr_cvet->images as $image)
                            <div class="slides swiper-slide gallery__slide">
                                <div class="gallery__header">
                                    <div class="indicator">
                                        <div class="indicator__item indicator__item_first"></div>
                                        <div class="indicator__item indicator__item_middle"></div>
                                        <div class="indicator__item indicator__item_last"></div>
                                    </div>
                                    <div class="stock-status">Много на складе</div>
                                </div>

                                <picture>
                                    <source 
                                        srcset="
                                            {{ $image->get_resize('574x574') }} 1x,
                                            {{ $image->get_resize('689x689') }} 1.2x,
                                            {{ $image->get_resize('861x861') }} 1.5x
                                        " 
                                        media="all and (min-width: 574px)" 
                                        type="image/jpeg" 
                                    />
                                    <source 
                                        srcset="
                                            {{ $image->get_resize('414x700') }} 1x,
                                            {{ $image->get_resize('621x1050') }} 1.5x,
                                            {{ $image->get_resize('828x1400') }} 2x
                                        " 
                                        type="image/jpeg" 
                                    />                 
                                    <img src="{{ $image->get_resize('325x325') }}" class="the-node-image" />
                                </picture>
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
                                            <div class="sharing__pic sharing__pic_share"><img
                                                    src="http://localhost/../../img/icons/share.svg" alt=""></div>
                                            <div class="sharing__label">Поделиться</div>

                                        </div>
                                        <div class="sharing__button sharing__button_copylink">
                                            <div class="sharing__label sharing__label_copylink">
                                                <span class="span_mobile">Копировать ссылку</span>
                                                <span class="span_desktop">Копировать</span>
                                            </div>
                                            <div class="sharing__pic sharing__pic_copylink"><img
                                                    src="http://localhost/../../img/icons/link.svg" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>


            </div>


            <div class="specs__item product-card__item product-card__item_spec composition">
                <div class="specs__subitem specs__subitem_name">Состав:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">Нейлон</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec width">
                <div class="specs__subitem specs__subitem_name">Ширина рулона:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">3,66 м</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec height">
                <div class="specs__subitem specs__subitem_name">Высота ворса:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">10 мм</div>
            </div>
            <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                <div class="specs__subitem specs__subitem_name">Цена квадратного метра:</div>
                <div class="specs__subitem specs__subitem_wtf">?</div>
                <div class="specs__subitem specs__subitem_filler"></div>
                <div class="specs__subitem specs__subitem_value">€81</div>
            </div>

            <div class="product-card__item product-card__item_pc-buttons pc-buttons">
                <div class="pc-buttons__item pc-buttons__item_item1"><a
                        class="button _icon-heart add-to-cart">Отложить</a></div>
                <div class="pc-buttons__item pc-buttons__item_item2"><a
                        class="button_light _icon-wa">Обсудить в WhatsApp</a></div>
                <div class="pc-buttons__item_item3">Вы можете вернуться к отложенному позже или пригласить
                    нашего
                    дизайнера, который привезет образцы отобранных материалов</div>
            </div>
            <div class="product-card__item product-card__item_description description">
                <p class="block-description">Описание</p>
                <p>{{ $pr_cvet->description }}</p>
            </div>
        </div>
    </section>
                <section class="recomendations">
                    <div class="rec-block">
                        <div class="rec-block__title">
                            <div class="rec-block__label">Еще в том же цвете</div>
                            <div class="rec-block__decorline"><img src="../../img/icons/DecorLine.svg" alt=""></div>
                        </div>
                        <div class="rec-block__nodes nodes">
                            <div class="nodes__item nodes__cell the-product" data-nid="66">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img">
                                    <div class="swiper-grid">
                                        <div class="swiper swiper-rec ">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide"><img class="the-node-image"
                                                        src="../../../img/recs/Shycloud-15-060820_1.jpg" alt=""></div>
                                                <div class="swiper-slide"><img class="the-node-image"
                                                        src="../../../img/recs/Shycloud-02-060820.jpg" alt=""></div>

                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>

                                        </div>
                                    </div>

                                </div>
                                <div class="product-card__item product-card__item_h1 h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img">
                                    <div class="swiper-grid">
                                        <div class="swiper swiper-rec ">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide"><img src="../../../img/recs/Shycloud-02-060820.jpg"
                                                        alt=""></div>
                                                <div class="swiper-slide"><img src="../../../img/recs/Shycloud-15-060820_1.jpg"
                                                        alt=""></div>
                                                <div class="swiper-slide"><img src="../../../img/recs/Shycloud-02-060820.jpg"
                                                        alt=""></div>

                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>

                                        </div>
                                    </div>

                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-21-060820.jpg" alt=""></div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="rec-block">
                        <div class="rec-block__title">
                            <div class="rec-block__label">В той же коллекции</div>
                            <div class="rec-block__decorline"><img src="../../img/icons/DecorLine.svg" alt=""></div>
                        </div>
                        <div class="rec-block__nodes nodes">
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-01-060820 (1).jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-01-060820 (1).jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-02-060820.jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-15-060820_1_1.jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-21-060820.jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                            <div class="nodes__item nodes__cell">
                                <div class="product-card__item product-card__item_gallery gallery nodes__img"><img
                                        src="../../../img/recs/Shycloud-rakurs-01-060820 (1).jpg" alt="">
                                </div>
                                <div class="product-card__item product-card__item_h1 nodes__label">07 Shycloud</div>
                                <div class="specs__item product-card__item product-card__item_spec price nodes__price">
                                    €81 (м2)</div>
                                <div class="nodes__heart"><img class="add-to-cart" src="../../img/icons/Like.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

</x-layout>