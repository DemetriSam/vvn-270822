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