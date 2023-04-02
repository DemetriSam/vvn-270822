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
            <div class="main-banner__form">
                @if(Session::has('message'))
                <p class="">{{ Session::get('message') }}</p>
                @endif
                <form class="design-form" action="{{ route('request.mesurement') }}" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="design-form__title">Заполните форму для вызова дизайнера</div>

                    <div class="design-form__i-wrapper">
                        <label for="name" class="design-form__i-label">Ваше имя <span style="color: red">{{$errors->first('name')}}</span></label>
                        <input class="design-form__input" type="text" name="name" value="{{old('name')}}"></input>
                    </div>
                    <div class="design-form__i-wrapper">
                        <label for="phone" class="design-form__i-label">Ваш телефон <span style="color: red">{{$errors->first('phone')}}</span></label>
                        <input class="design-form__input" type="tel" name="phone" value="{{old('phone')}}"></input>
                    </div>
                    <div class="design-form__i-wrapper design-form__i-wrapper_address">
                        <label for="address" class="design-form__i-label">Адрес куда ехать <span style="color: red">{{$errors->first('address')}}</span></label>
                        <input class="design-form__input design-form__input_address" type="text" name="address" value="{{old('address')}}"></input>
                    </div>
                    <div class="design-form__agree">

                        <p><input type="checkbox" name="personal_data_confirmed"></input> Даю свое согласие на обработку <a src="#">персональных
                                данных</a>
                        </p><span style="color: red">{{$errors->first('personal_data_confirmed')}}</span>
                    </div>
                    <div class="design-form__button"> <input class="button" type="submit" value="Отправить форму"> </div>
                </form>
            </div>
        </div>
    </section>
    <x-public.nodes :title="$carpets['title']" :products="$carpets['products']" :route="$carpets['route']" />
    <x-public.nodes :title="$cinovki['title']" :products="$cinovki['products']" :route="$cinovki['route']" />
</x-layout>