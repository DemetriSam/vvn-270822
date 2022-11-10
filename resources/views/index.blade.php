<x-layout>
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
                <a href="#" class="call_designer button">Вызвать дизайнера на замер</a>
            </div>
            <div class="main-banner__form design-form">
                <a href="##" class="popup__close"><img src="img/Close.svg" alt=""></a>
                <div class="design-form__title">Заполните форму для вызова дизайнера</div>
                <div class="design-form__i-wrapper">
                    <span class="design-form__i-label">Ваше имя</span>
                    <input class="design-form__input" type="text"></input>
                </div>
                <div class="design-form__i-wrapper">
                    <span class="design-form__i-label">Ваш телефон</span>
                    <input class="design-form__input" type="tel"></input>
                </div>
                <div class="design-form__i-wrapper design-form__i-wrapper_address">
                    <span class="design-form__i-label">Адрес куда ехать</span>
                    <input class="design-form__input design-form__input_address" type="text"></input>
                </div>
                <div class="design-form__agree">

                    <p><input type="checkbox"></input> Даю свое согласие на обработку <a
                            src="#">персональных
                            данных</a></p>
                </div>
                <div class="design-form__button button">Отправить форму</div>
            </div>
        </div>
    </section>
    <div class="front-page-title">У нас всё в наличии</div>
    <div class="rec-block__decorline">
        <img class="front-page-decor-line" src="img/icons/DecorLine.svg" alt="">
    </div>
    <div>Здесь какой-то еще контент</div>
</x-layout>