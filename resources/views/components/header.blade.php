<header class="header">
	<nav class="navbar navbar-dark bg-secondary" id="navbar-top">
		<div class="header__container _container">
			<section class="row region region-top-header">

				<div class="contacts_in_header">
					<div id="header_phone_number" class="_icon-phone">+7 (495) 729 96 33</div>
					<div class="_icon-mail">info@dizanarium.ru</div>

					<div id="header_address" class="_icon-pin">г. Москва, Большая Черемушкинская, 34, офис 309.3</div>
				</div>
				<div class="header__search">
					<div class="search-form">
						<button type="button" class="search-form__icon _icon-Search"></button>
						<form action="#" class="search-form__item">
							<button type="submit" class="search-form__btn _icon-Search"></button>
							<input id="search_input" autocomplete="off" type="text" name="form[]" data-value=""
								class="search-form__input">
						</form>
					</div>
				</div>
				<div class="call_designer_div heart_div">
					<a href="#" class="call_designer button_light hide-mxw-md3">Избранное </a>
					<div class="red_heart_notification"><span>0</span></div>
				</div>

				<div id="designer_button_header" class="call_designer_div">
					<a href="#designer-form-region" class="call_designer button">Вызвать дизайнера на замер</a>
				</div>
			</section>
		</div>
	</nav>
	<nav class="navbar navbar-dark bg-primary navbar-expand-lg" id="navbar-main">
		<div class="header__container _container">
			<div class="site-branding">
				<a href="{{ route('index') }}" title="Главная" rel="home" class="navbar-brand">
					<img src="/img/icons/big_logo.png" alt="Главная" class="img-fluid d-inline-block align-top">
					<div class="d-inline-block align-top site-name-slogan">
						<p class="site-name">Всё в наличии</p>
						<p class="site-slogan">Ковровые покрытия на складе</p>
					</div>
				</a>
			</div>
			<div class="menu">
				<nav role="navigation" aria-labelledby="block-mytheme-main-menu" id="block-mytheme-main-menu"
					class="block block-menu navigation menu--main menu__body">

					<h2 class="sr-only" id="block-bootstrap-barrio-main-navigation-menu">Main navigation</h2>
					<ul block="block-bootstrap-barrio-main-navigation row" class="clearfix nav navbar-nav menu__list">

						<li class="nav-item menu__item _icon-Rectangle">
							<a href="{{ route('carpets') }}" title="carpets"
								class="nav-link nav-link--ru-carpets" data-drupal-link-system-path="carpets">
								Ковровые покрытия
							</a>
						</li>

						<li class="nav-item menu__item">
							<a href="{{ route('cinovki') }}"
								class="nav-link`menu__link nav-link--ru-cinovki" data-drupal-link-system-path="cinovki">
								Циновки из сизаля
							</a>
						</li>
						<li class="nav-item menu__item">
							<a href="http://vse-v-nalichii.samartu2.beget.tech/ru"
								class="nav-link`menu__link nav-link--ru" data-drupal-link-system-path="&lt;front&gt;">
								Замер
							</a>
						</li>
						<li class="nav-item menu__item">
							<a href="http://vse-v-nalichii.samartu2.beget.tech/ru"
								class="nav-link`menu__link nav-link--ru" data-drupal-link-system-path="&lt;front&gt;">
								Настил
							</a>
						</li>
						<li class="nav-item menu__item">
							<a href="http://vse-v-nalichii.samartu2.beget.tech/ru"
								class="nav-link`menu__link nav-link--ru" data-drupal-link-system-path="&lt;front&gt;">
								Ковер по индивидуальным размерам
							</a>
						</li>
					</ul>
					<div class="contacts_in_burger">
						<div id="header_phone_number" class="_icon-phone">+7 (495) 729 96 33</div>
						<div class="_icon-mail">info@dizanarium.ru</div>

						<div id="header_address" class="_icon-pin">г. Москва, Большая Черемушкинская, 34, офис 309.3
						</div>
					</div>
				</nav>
			</div>




			<button type="button" class="icon-menu">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</nav>
	@if(Route::currentRouteName() !== 'index')
		<div id="block-mytheme-breadcrumbs" class="contextual-region breadcrumb _container">
			<nav role="navigation" aria-labelledby="system-breadcrumb" class="breadcrumb__body">
				<!--<h2 id="system-breadcrumb" class="visually-hidden">Строка навигации</h2>-->
				<ol class="breadcrumb__list">
					<li class="breadcrumb__item">
						<a href="/ru">Главная</a>
					</li>
					<li class="breadcrumb__item">
						<a href="/ru">Ковровые покрытия</a>
					</li>
					<li class="breadcrumb__item">
						<a href="/ru">Shycloud 13</a>
					</li>
				</ol>
			</nav>
		</div>
	@else
		<style>
			.wrapper {
				margin-top: -50px;
			}
		</style>
	@endif
	<div id="designer_button_mobile" class="call_designer_div _container designer_button_mobile">
		<a href="#" class="call_designer button">Вызвать дизайнера на замер</a>
	</div>
</header>