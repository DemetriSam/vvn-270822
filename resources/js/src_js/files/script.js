//=======<ВКЛЮЧЕНИЕ ВЫКЛЮЧЕНИЕ ХЭДЕРА>==============

var headerClone;
var header = document.querySelector('header.header');
headerClone = header.cloneNode(true);
let width = document.documentElement.clientWidth;
headerClone.setAttribute('class', 'header header-clone fixed hidden');
headerClone.style.cssText =
	`
        top: 0px;
        width: ${width}px;
    `;

let breadcrumb = headerClone.querySelector('.breadcrumb');
if (breadcrumb) {
	headerClone.removeChild(breadcrumb);
}


document.body.append(headerClone);

function turnHeaderCloneON() {
	if (headerClone.classList.contains('hidden')) {
		headerClone.classList.toggle('hidden');
	}
}

function turnHeaderCloneOff() {
	if (!headerClone.classList.contains('hidden')) {
		headerClone.classList.toggle('hidden');
	}
}

let previousY = scrollY;
window.addEventListener('scroll', toggleTheClone);
function toggleTheClone() {
	let src_value = scrollY;
	let currentScroll = scrollY;

	if (header !== null) {

		if (currentScroll > 1) {
			header.classList.add('scrolled');
		} else {
			header.classList.remove('scrolled');
		}

		if ((currentScroll < previousY) && (currentScroll > 1)) {
			turnHeaderCloneON();

		} else {
			turnHeaderCloneOff();

		}
		previousY = scrollY;
	}


}

window.addEventListener('resize', checkWidth);
function checkWidth() {
	if (document.documentElement.clientWidth == headerClone.clientWidth) {
		return;
	} else {
		let width = document.documentElement.clientWidth;
		headerClone.style.cssText =
			`
                top: 0px;
                width: ${width}px;
            `;
		checkToolbar();
	}
}

//нормальное отображение хэдера для залогиненнового пользователя друпала

function checkToolbar() {
	if (document.body.classList.contains('toolbar-horizontal')) {
		headerClone.style.top = '79px';
	}
}
checkToolbar();

//=======</ВКЛЮЧЕНИЕ ВЫКЛЮЧЕНИЕ ХЭДЕРА>==============


var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");
var isMobile = { Android: function () { return navigator.userAgent.match(/Android/i); }, BlackBerry: function () { return navigator.userAgent.match(/BlackBerry/i); }, iOS: function () { return navigator.userAgent.match(/iPhone|iPad|iPod/i); }, Opera: function () { return navigator.userAgent.match(/Opera Mini/i); }, Windows: function () { return navigator.userAgent.match(/IEMobile/i); }, any: function () { return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()); } };
function isIE() {
	ua = navigator.userAgent;
	var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
	return is_ie;
}
if (isIE()) {
	document.querySelector('html').classList.add('ie');
}
if (isMobile.any()) {
	document.querySelector('html').classList.add('_touch');
}

// Получить цифры из строки
//parseInt(itemContactpagePhone.replace(/[^\d]/g, ''))

function testWebP(callback) {
	var webP = new Image();
	webP.onload = webP.onerror = function () {
		callback(webP.height == 2);
	};
	webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
}
testWebP(function (support) {
	if (support === true) {
		document.querySelector('html').classList.add('_webp');
	} else {
		document.querySelector('html').classList.add('_no-webp');
	}
});

function ibg() {
	if (isIE()) {
		let ibg = document.querySelectorAll(".ibg");
		for (var i = 0; i < ibg.length; i++) {
			if (ibg[i].querySelector('img') && ibg[i].querySelector('img').getAttribute('src') != null) {
				ibg[i].style.backgroundImage = 'url(' + ibg[i].querySelector('img').getAttribute('src') + ')';
			}
		}
	}
}
ibg();

window.addEventListener("load", function () {
	if (document.querySelector('.wrapper')) {
		setTimeout(function () {
			document.querySelector('.wrapper').classList.add('_loaded');
		}, 0);
	}
});

let unlock = true;

//=================
//ActionsOnHash
if (location.hash) {
	const hsh = location.hash.replace('#', '');
	if (document.querySelector('.popup_' + hsh)) {
		popup_open(hsh);
	} else if (document.querySelector('div.' + hsh)) {
		_goto(document.querySelector('.' + hsh), 500, '');
	}
}
//=================
//Menu
let iconMenu = document.querySelector(".icon-menu");
let iconMenuClone = document.querySelector(".header-clone .icon-menu");
if (iconMenu != null) {
	let delay = 500;
	let menuBody = document.querySelector(".menu__body");
	iconMenu.addEventListener("click", function (e) {
		if (unlock) {
			body_lock(delay);
			iconMenu.classList.toggle("_active");
			menuBody.classList.toggle("_active");
			menuBody.style = `top: 0px`;
		}
	});
	if (iconMenuClone) {
		iconMenuClone.addEventListener("click", function (e) {
			if (unlock) {
				body_lock(delay);
				iconMenuClone.classList.toggle("_active");
				menuBody.classList.toggle("_active");
				if (scrollY > 1) { menuBody.style = `top: ${scrollY}px`; }
			}
		});
	}
};
function menu_close() {
	let iconMenu = document.querySelector(".icon-menu");
	let menuBody = document.querySelector(".menu__body");
	iconMenu.classList.remove("_active");
	menuBody.classList.remove("_active");
}
//=================
//BodyLock
function body_lock(delay) {
	let body = document.querySelector("body");
	if (body.classList.contains('_lock')) {
		body_lock_remove(delay);
	} else {
		body_lock_add(delay);
	}
}
function body_lock_remove(delay) {
	let body = document.querySelector("body");
	if (unlock) {
		let lock_padding = document.querySelectorAll("._lp");
		setTimeout(() => {
			for (let index = 0; index < lock_padding.length; index++) {
				const el = lock_padding[index];
				el.style.paddingRight = '0px';
			}
			body.style.paddingRight = '0px';
			body.classList.remove("_lock");
		}, delay);

		unlock = false;
		setTimeout(function () {
			unlock = true;
		}, delay);
	}
}
function body_lock_add(delay) {
	let body = document.querySelector("body");
	if (unlock) {
		let lock_padding = document.querySelectorAll("._lp");
		for (let index = 0; index < lock_padding.length; index++) {
			const el = lock_padding[index];
			el.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
		}
		body.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
		body.classList.add("_lock");

		unlock = false;
		setTimeout(function () {
			unlock = true;
		}, delay);
	}
}
//=================
// LettersAnimation
let title = document.querySelectorAll('._letter-animation');
if (title) {
	for (let index = 0; index < title.length; index++) {
		let el = title[index];
		let txt = el.innerHTML;
		let txt_words = txt.replace('  ', ' ').split(' ');
		let new_title = '';
		for (let index = 0; index < txt_words.length; index++) {
			let txt_word = txt_words[index];
			let len = txt_word.length;
			new_title = new_title + '<p>';
			for (let index = 0; index < len; index++) {
				let it = txt_word.substr(index, 1);
				if (it == ' ') {
					it = '&nbsp;';
				}
				new_title = new_title + '<span>' + it + '</span>';
			}
			el.innerHTML = new_title;
			new_title = new_title + '&nbsp;</p>';
		}
	}
}
//=================
//Tabs
let tabs = document.querySelectorAll("._tabs");
for (let index = 0; index < tabs.length; index++) {
	let tab = tabs[index];
	let tabs_items = tab.querySelectorAll("._tabs-item");
	let tabs_blocks = tab.querySelectorAll("._tabs-block");
	for (let index = 0; index < tabs_items.length; index++) {
		let tabs_item = tabs_items[index];
		tabs_item.addEventListener("click", function (e) {
			for (let index = 0; index < tabs_items.length; index++) {
				let tabs_item = tabs_items[index];
				tabs_item.classList.remove('_active');
				tabs_blocks[index].classList.remove('_active');
			}
			tabs_item.classList.add('_active');
			tabs_blocks[index].classList.add('_active');
			e.preventDefault();
		});
	}
}
//=================
/*
Для родителя слойлеров пишем атрибут data-spollers
Для заголовков слойлеров пишем атрибут data-spoller
Если нужно включать\выключать работу спойлеров на разных размерах экранов
пишем параметры ширины и типа брейкпоинта.
Например: 
data-spollers="992,max" - спойлеры будут работать только на экранах меньше или равно 992px
data-spollers="768,min" - спойлеры будут работать только на экранах больше или равно 768px

Если нужно что бы в блоке открывался болько один слойлер добавляем атрибут data-one-spoller
*/

// SPOLLERS
const spollersArray = document.querySelectorAll('[data-spollers]');
if (spollersArray.length > 0) {
	// Получение обычных слойлеров
	const spollersRegular = Array.from(spollersArray).filter(function (item, index, self) {
		return !item.dataset.spollers.split(",")[0];
	});
	// Инициализация обычных слойлеров
	if (spollersRegular.length > 0) {
		initSpollers(spollersRegular);
	}

	// Получение слойлеров с медиа запросами
	const spollersMedia = Array.from(spollersArray).filter(function (item, index, self) {
		return item.dataset.spollers.split(",")[0];
	});

	// Инициализация слойлеров с медиа запросами
	if (spollersMedia.length > 0) {
		const breakpointsArray = [];
		spollersMedia.forEach(item => {
			const params = item.dataset.spollers;
			const breakpoint = {};
			const paramsArray = params.split(",");
			breakpoint.value = paramsArray[0];
			breakpoint.type = paramsArray[1] ? paramsArray[1].trim() : "max";
			breakpoint.item = item;
			breakpointsArray.push(breakpoint);
		});

		// Получаем уникальные брейкпоинты
		let mediaQueries = breakpointsArray.map(function (item) {
			return '(' + item.type + "-width: " + item.value + "px)," + item.value + ',' + item.type;
		});
		mediaQueries = mediaQueries.filter(function (item, index, self) {
			return self.indexOf(item) === index;
		});

		// Работаем с каждым брейкпоинтом
		mediaQueries.forEach(breakpoint => {
			const paramsArray = breakpoint.split(",");
			const mediaBreakpoint = paramsArray[1];
			const mediaType = paramsArray[2];
			const matchMedia = window.matchMedia(paramsArray[0]);

			// Объекты с нужными условиями
			const spollersArray = breakpointsArray.filter(function (item) {
				if (item.value === mediaBreakpoint && item.type === mediaType) {
					return true;
				}
			});
			// Событие
			matchMedia.addListener(function () {
				initSpollers(spollersArray, matchMedia);
			});
			initSpollers(spollersArray, matchMedia);
		});
	}
	// Инициализация
	function initSpollers(spollersArray, matchMedia = false) {
		spollersArray.forEach(spollersBlock => {
			spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
			if (matchMedia.matches || !matchMedia) {
				spollersBlock.classList.add('_init');
				initSpollerBody(spollersBlock);
				spollersBlock.addEventListener("click", setSpollerAction);
			} else {
				spollersBlock.classList.remove('_init');
				initSpollerBody(spollersBlock, false);
				spollersBlock.removeEventListener("click", setSpollerAction);
			}
		});
	}
	// Работа с контентом
	function initSpollerBody(spollersBlock, hideSpollerBody = true) {
		const spollerTitles = spollersBlock.querySelectorAll('[data-spoller]');
		if (spollerTitles.length > 0) {
			spollerTitles.forEach(spollerTitle => {
				if (hideSpollerBody) {
					spollerTitle.removeAttribute('tabindex');
					if (!spollerTitle.classList.contains('_active')) {
						spollerTitle.nextElementSibling.hidden = true;
					}
				} else {
					spollerTitle.setAttribute('tabindex', '-1');
					spollerTitle.nextElementSibling.hidden = false;
				}
			});
		}
	}
	function setSpollerAction(e) {
		const el = e.target;
		if (el.hasAttribute('data-spoller') || el.closest('[data-spoller]')) {
			const spollerTitle = el.hasAttribute('data-spoller') ? el : el.closest('[data-spoller]');
			const spollersBlock = spollerTitle.closest('[data-spollers]');
			const oneSpoller = spollersBlock.hasAttribute('data-one-spoller') ? true : false;
			if (!spollersBlock.querySelectorAll('._slide').length) {
				if (oneSpoller && !spollerTitle.classList.contains('_active')) {
					hideSpollersBody(spollersBlock);
				}
				spollerTitle.classList.toggle('_active');
				_slideToggle(spollerTitle.nextElementSibling, 500);
			}
			e.preventDefault();
		}
	}
	function hideSpollersBody(spollersBlock) {
		const spollerActiveTitle = spollersBlock.querySelector('[data-spoller]._active');
		if (spollerActiveTitle) {
			spollerActiveTitle.classList.remove('_active');
			_slideUp(spollerActiveTitle.nextElementSibling, 500);
		}
	}
}
//=================
//Gallery
let gallery = document.querySelectorAll('._gallery');
if (gallery) {
	gallery_init();
}
function gallery_init() {
	for (let index = 0; index < gallery.length; index++) {
		const el = gallery[index];
		lightGallery(el, {
			counter: false,
			selector: 'a',
			download: false
		});
	}
}
//=================
//SearchInList
function search_in_list(input) {
	let ul = input.parentNode.querySelector('ul')
	let li = ul.querySelectorAll('li');
	let filter = input.value.toUpperCase();

	for (i = 0; i < li.length; i++) {
		let el = li[i];
		let item = el;
		txtValue = item.textContent || item.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			el.style.display = "";
		} else {
			el.style.display = "none";
		}
	}
}
//=================
//DigiFormat
function digi(str) {
	var r = str.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 ");
	return r;
}
//=================
//DiGiAnimate
function digi_animate(digi_animate) {
	if (digi_animate.length > 0) {
		for (let index = 0; index < digi_animate.length; index++) {
			const el = digi_animate[index];
			const el_to = parseInt(el.innerHTML.replace(' ', ''));
			if (!el.classList.contains('_done')) {
				digi_animate_value(el, 0, el_to, 1500);
			}
		}
	}
}
function digi_animate_value(el, start, end, duration) {
	var obj = el;
	var range = end - start;
	// no timer shorter than 50ms (not really visible any way)
	var minTimer = 50;
	// calc step time to show all interediate values
	var stepTime = Math.abs(Math.floor(duration / range));

	// never go below minTimer
	stepTime = Math.max(stepTime, minTimer);

	// get current time and calculate desired end time
	var startTime = new Date().getTime();
	var endTime = startTime + duration;
	var timer;

	function run() {
		var now = new Date().getTime();
		var remaining = Math.max((endTime - now) / duration, 0);
		var value = Math.round(end - (remaining * range));
		obj.innerHTML = digi(value);
		if (value == end) {
			clearInterval(timer);
		}
	}

	timer = setInterval(run, stepTime);
	run();

	el.classList.add('_done');
}
//=================
//Popups
let popup_link = document.querySelectorAll('._popup-link');
let popups = document.querySelectorAll('.popup');
for (let index = 0; index < popup_link.length; index++) {
	const el = popup_link[index];
	el.addEventListener('click', function (e) {
		if (unlock) {
			let item = el.getAttribute('href').replace('#', '');
			let video = el.getAttribute('data-video');
			popup_open(item, video);
		}
		e.preventDefault();
	})
}
for (let index = 0; index < popups.length; index++) {
	const popup = popups[index];
	popup.addEventListener("click", function (e) {
		if (!e.target.closest('.popup__body')) {
			popup_close(e.target.closest('.popup'));
		}
	});
}
function popup_open(item, video = '') {
	let activePopup = document.querySelectorAll('.popup._active');
	if (activePopup.length > 0) {
		popup_close('', false);
	}
	let curent_popup = document.querySelector('.popup_' + item);
	if (curent_popup && unlock) {
		if (video != '' && video != null) {
			let popup_video = document.querySelector('.popup_video');
			popup_video.querySelector('.popup__video').innerHTML = '<iframe src="https://www.youtube.com/embed/' + video + '?autoplay=1"  allow="autoplay; encrypted-media" allowfullscreen></iframe>';
		}
		if (!document.querySelector('.menu__body._active')) {
			body_lock_add(500);
		}
		curent_popup.classList.add('_active');
		history.pushState('', '', '#' + item);
	}
}
function popup_close(item, bodyUnlock = true) {
	if (unlock) {
		if (!item) {
			for (let index = 0; index < popups.length; index++) {
				const popup = popups[index];
				let video = popup.querySelector('.popup__video');
				if (video) {
					video.innerHTML = '';
				}
				popup.classList.remove('_active');
			}
		} else {
			let video = item.querySelector('.popup__video');
			if (video) {
				video.innerHTML = '';
			}
			item.classList.remove('_active');
		}
		if (!document.querySelector('.menu__body._active') && bodyUnlock) {
			body_lock_remove(500);
		}
		history.pushState('', '', window.location.href.split('#')[0]);
	}
}
let popup_close_icon = document.querySelectorAll('.popup__close,._popup-close');
if (popup_close_icon) {
	for (let index = 0; index < popup_close_icon.length; index++) {
		const el = popup_close_icon[index];
		el.addEventListener('click', function () {
			popup_close(el.closest('.popup'));
		})
	}
}
document.addEventListener('keydown', function (e) {
	if (e.code === 'Escape') {
		popup_close();
	}
});

//=================
//SlideToggle
let _slideUp = (target, duration = 500) => {
	if (!target.classList.contains('_slide')) {
		target.classList.add('_slide');
		target.style.transitionProperty = 'height, margin, padding';
		target.style.transitionDuration = duration + 'ms';
		target.style.height = target.offsetHeight + 'px';
		target.offsetHeight;
		target.style.overflow = 'hidden';
		target.style.height = 0;
		target.style.paddingTop = 0;
		target.style.paddingBottom = 0;
		target.style.marginTop = 0;
		target.style.marginBottom = 0;
		window.setTimeout(() => {
			target.hidden = true;
			target.style.removeProperty('height');
			target.style.removeProperty('padding-top');
			target.style.removeProperty('padding-bottom');
			target.style.removeProperty('margin-top');
			target.style.removeProperty('margin-bottom');
			target.style.removeProperty('overflow');
			target.style.removeProperty('transition-duration');
			target.style.removeProperty('transition-property');
			target.classList.remove('_slide');
		}, duration);
	}
}
let _slideDown = (target, duration = 500) => {
	if (!target.classList.contains('_slide')) {
		target.classList.add('_slide');
		if (target.hidden) {
			target.hidden = false;
		}
		let height = target.offsetHeight;
		target.style.overflow = 'hidden';
		target.style.height = 0;
		target.style.paddingTop = 0;
		target.style.paddingBottom = 0;
		target.style.marginTop = 0;
		target.style.marginBottom = 0;
		target.offsetHeight;
		target.style.transitionProperty = "height, margin, padding";
		target.style.transitionDuration = duration + 'ms';
		target.style.height = height + 'px';
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');
		window.setTimeout(() => {
			target.style.removeProperty('height');
			target.style.removeProperty('overflow');
			target.style.removeProperty('transition-duration');
			target.style.removeProperty('transition-property');
			target.classList.remove('_slide');
		}, duration);
	}
}
let _slideToggle = (target, duration = 500) => {
	if (target.hidden) {
		return _slideDown(target, duration);
	} else {
		return _slideUp(target, duration);
	}
}
//========================================
//Wrap
function _wrap(el, wrapper) {
	el.parentNode.insertBefore(wrapper, el);
	wrapper.appendChild(el);
}
//========================================
//RemoveClasses
function _removeClasses(el, class_name) {
	for (var i = 0; i < el.length; i++) {
		el[i].classList.remove(class_name);
	}
}
//========================================
//IsHidden
function _is_hidden(el) {
	return (el.offsetParent === null)
}
// ShowMore Beta ========================
let moreBlocks = document.querySelectorAll('._more-block');
if (moreBlocks.length > 0) {
	let wrapper = document.querySelector('.wrapper');
	for (let index = 0; index < moreBlocks.length; index++) {
		const moreBlock = moreBlocks[index];
		let items = moreBlock.querySelectorAll('._more-item');
		if (items.length > 0) {
			let itemsMore = moreBlock.querySelector('._more-link');
			let itemsContent = moreBlock.querySelector('._more-content');
			let itemsView = itemsContent.getAttribute('data-view');
			if (getComputedStyle(itemsContent).getPropertyValue("transition-duration") === '0s') {
				itemsContent.style.cssText = "transition-duration: 1ms";
			}
			itemsMore.addEventListener("click", function (e) {
				if (itemsMore.classList.contains('_active')) {
					setSize();
				} else {
					setSize('start');
				}
				itemsMore.classList.toggle('_active');
				e.preventDefault();
			});

			let isScrollStart;
			function setSize(type) {
				let resultHeight;
				let itemsContentHeight = 0;
				let itemsContentStartHeight = 0;

				for (let index = 0; index < items.length; index++) {
					if (index < itemsView) {
						itemsContentHeight += items[index].offsetHeight;
					}
					itemsContentStartHeight += items[index].offsetHeight;
				}
				resultHeight = (type === 'start') ? itemsContentStartHeight : itemsContentHeight;
				isScrollStart = window.innerWidth - wrapper.offsetWidth;
				itemsContent.style.height = `${resultHeight}px`;
			}

			itemsContent.addEventListener("transitionend", updateSize, false);

			function updateSize() {
				let isScrollEnd = window.innerWidth - wrapper.offsetWidth;
				if (isScrollStart === 0 && isScrollEnd > 0 || isScrollStart > 0 && isScrollEnd === 0) {
					if (itemsMore.classList.contains('_active')) {
						setSize('start');
					} else {
						setSize();
					}
				}
			}
			window.addEventListener("resize", function (e) {
				if (!itemsMore.classList.contains('_active')) {
					setSize();
				} else {
					setSize('start');
				}
			});
			setSize();
		}
	}
}
//==RATING======================================
const ratings = document.querySelectorAll('.rating');
if (ratings.length > 0) {
	initRatings();
}
// Основная функция
function initRatings() {
	let ratingActive, ratingValue;
	// "Бегаем" по всем рейтингам на странице
	for (let index = 0; index < ratings.length; index++) {
		const rating = ratings[index];
		initRating(rating);
	}

	// Инициализируем конкретный рейтинг
	function initRating(rating) {
		initRatingVars(rating);

		setRatingActiveWidth();

		if (rating.classList.contains('rating_set')) {
			setRating(rating);
		}
	}

	// Инициализайция переменных
	function initRatingVars(rating) {
		ratingActive = rating.querySelector('.rating__active');
		ratingValue = rating.querySelector('.rating__value');
	}
	// Изменяем ширину активных звезд
	function setRatingActiveWidth(index = ratingValue.innerHTML) {
		const ratingActiveWidth = index / 0.05;
		ratingActive.style.width = `${ratingActiveWidth}%`;
	}
	// Возможность указать оценку 
	function setRating(rating) {
		const ratingItems = rating.querySelectorAll('.rating__item');
		for (let index = 0; index < ratingItems.length; index++) {
			const ratingItem = ratingItems[index];
			ratingItem.addEventListener("mouseenter", function (e) {
				// Обновление переменных
				initRatingVars(rating);
				// Обновление активных звезд
				setRatingActiveWidth(ratingItem.value);
			});
			ratingItem.addEventListener("mouseleave", function (e) {
				// Обновление активных звезд
				setRatingActiveWidth();
			});
			ratingItem.addEventListener("click", function (e) {
				// Обновление переменных
				initRatingVars(rating);

				if (rating.dataset.ajax) {
					// "Отправить" на сервер
					setRatingValue(ratingItem.value, rating);
				} else {
					// Отобразить указанную оцнку
					ratingValue.innerHTML = index + 1;
					setRatingActiveWidth();
				}
			});
		}
	}

	async function setRatingValue(value, rating) {
		if (!rating.classList.contains('rating_sending')) {
			rating.classList.add('rating_sending');

			// Отправика данных (value) на сервер
			let response = await fetch('rating.json', {
				method: 'GET',

				//body: JSON.stringify({
				//	userRating: value
				//}),
				//headers: {
				//	'content-type': 'application/json'
				//}

			});
			if (response.ok) {
				const result = await response.json();

				// Получаем новый рейтинг
				const newRating = result.newRating;

				// Вывод нового среднего результата
				ratingValue.innerHTML = newRating;

				// Обновление активных звезд
				setRatingActiveWidth();

				rating.classList.remove('rating_sending');
			} else {
				alert("Ошибка");

				rating.classList.remove('rating_sending');
			}
		}
	}
}
//========================================
//Animate
function animate({ timing, draw, duration }) {
	let start = performance.now();
	requestAnimationFrame(function animate(time) {
		// timeFraction изменяется от 0 до 1
		let timeFraction = (time - start) / duration;
		if (timeFraction > 1) timeFraction = 1;

		// вычисление текущего состояния анимации
		let progress = timing(timeFraction);

		draw(progress); // отрисовать её

		if (timeFraction < 1) {
			requestAnimationFrame(animate);
		}

	});
}
function makeEaseOut(timing) {
	return function (timeFraction) {
		return 1 - timing(1 - timeFraction);
	}
}
function makeEaseInOut(timing) {
	return function (timeFraction) {
		if (timeFraction < .5)
			return timing(2 * timeFraction) / 2;
		else
			return (2 - timing(2 * (1 - timeFraction))) / 2;
	}
}
function quad(timeFraction) {
	return Math.pow(timeFraction, 2)
}
function circ(timeFraction) {
	return 1 - Math.sin(Math.acos(timeFraction));
}
/*
animate({
	duration: 1000,
	timing: makeEaseOut(quad),
	draw(progress) {
		window.scroll(0, start_position + 400 * progress);
	}
});*/

//Полифилы
(function () {
	// проверяем поддержку
	if (!Element.prototype.closest) {
		// реализуем
		Element.prototype.closest = function (css) {
			var node = this;
			while (node) {
				if (node.matches(css)) return node;
				else node = node.parentElement;
			}
			return null;
		};
	}
})();
(function () {
	// проверяем поддержку
	if (!Element.prototype.matches) {
		// определяем свойство
		Element.prototype.matches = Element.prototype.matchesSelector ||
			Element.prototype.webkitMatchesSelector ||
			Element.prototype.mozMatchesSelector ||
			Element.prototype.msMatchesSelector;
	}
})();



function addToCart_old(productButton, productId) {
	const product = document.querySelector(`[data-nid="${productId}"]`);
	const cart = document.querySelector('.red_heart_notification span');
	const cloneCart = document.querySelector('.header-clone .red_heart_notification span');

	if (!productButton.classList.contains('hold')) {
		productButton.classList.add('hold');
		productButton.classList.add('fly');


		const productImage = product.querySelector('.swiper-slide-active .the-node-image');

		const productImageFly = productImage.cloneNode(true);

		const pif_width = productImage.offsetWidth;
		const pif_height = productImage.offsetHeight;
		const pif_top = productImage.getBoundingClientRect().top;
		const pif_left = productImage.getBoundingClientRect().left;

		productImageFly.setAttribute('class', 'flyImage ibg');
		productImageFly.style.cssText =
			`
			left: ${pif_left}px;
			top: ${pif_top}px;
			width: ${pif_width}px;
			height: ${pif_height}px;
		`;

		document.body.append(productImageFly);


		var header = document.querySelector('header.header');

		let cart_top;
		let cart_left;

		if (header.classList.contains('scrolled')) {
			turnHeaderCloneON();
			cart_top = cloneCart.getBoundingClientRect().top;
			cart_left = cloneCart.getBoundingClientRect().left;
		} else {
			cart_top = cart.getBoundingClientRect().top;
			cart_left = cart.getBoundingClientRect().left;
		}


		productImageFly.style.cssText =
			`
			left: ${cart_left}px;
			top: ${cart_top}px;
			width: 0px;
			height: 0px;
			opacity: 0;
		`;

		if (product.querySelector('._icon-heart')) {
			let heart = product.querySelector('._icon-heart');
			heart.classList.remove('_icon-heart');
			heart.classList.add('_icon-red_heart');

		} else {
			if (product.querySelector('img.add-to-cart')) {
				let heart = product.querySelector('img.add-to-cart');
				heart.src = '/themes/mytheme/img/icons/red_heart.svg';
			}

		}

		var added = cart.innerText;
		added = Number(added);
		added = added + 1;
		cart.innerText = added;
		cloneCart.innerText = added;
	} else {
		productButton.classList.remove('hold');

		if (product.querySelector('._icon-red_heart')) {
			let heart = product.querySelector('._icon-red_heart');
			heart.classList.add('_icon-heart');
			heart.classList.remove('_icon-red_heart');

		} else {
			if (product.querySelector('img.add-to-cart')) {
				let heart = product.querySelector('img.add-to-cart');
				heart.src = '/themes/mytheme/img/icons/Like.svg';
			}

		}

		var added = cart.innerText;
		added = Number(added);
		added = added - 1;
		cart.innerText = added;
		cloneCart.innerText = added;
	}
}

var projectContext = 'local';

function checkTheCart() {
	var value = getCookie('favorites_cookie');
	if (!value) { return; } //проверяем не пуста ли куки
	if (!document.querySelector('.red_heart_notification span')) { return; } //проверяем есть ли на странице корзина
	if (getProduct()) { //проверяем наличие продуктов на странице
		value.split(',').forEach(element => {
			if (getProduct(element)) {
				addToCart(element, 0);
			} else {
				incrementCartCount();
			}

		});
	} else {
		let quantity = value.split(',').length;
		setCartCountValue(quantity);
	}
}

function addToCart(productId, toFly = 1) {
	const product = getProduct(productId);
	const button = getButton(product); //button объект со свойством button.button

	changeButtonState(button);



	if (!button.button.classList.contains('hold')) {

		button.button.classList.add('hold');
		button.button.classList.add('fly');
		if (toFly) {
			flyImage(product);
		}

		incrementCartCount();
		addNodeToCart(productId);

	} else {
		button.button.classList.remove('hold');
		decrementCartCount();
		deleteNodeFromCart(productId);
	}
}

function addToCart_project(productButton, productId) {

	const product = getProduct(productId);
	const button = getButton(product);

	changeButtonState(button);

}

function addNodeToCart(productId) {

	if (!wasItAdded(productId)) {
		var value = getCookie('favorites_cookie');
		if (value) {
			value = value + ',' + productId;
		} else {
			value = productId;
		}

		setCookie('favorites_cookie', value);
	}
}

function deleteNodeFromCart(productId) {
	if (wasItAdded(productId)) {
		let value = getCookie('favorites_cookie');
		let dl;
		let arr = value.split(',');
		for (let i = 0; i < arr.length; i++) {
			const element = arr[i];
			if (element == productId) {
				dl = i;
			}

		}
		arr.splice(dl, 1);
		value = arr.join(',');
		setCookie('favorites_cookie', value);


	}
}

function wasItAdded(productId) {
	var currentValue = getCookie('favorites_cookie');
	let response = false;
	if (!currentValue) { return response };
	currentValue.split(',').forEach(element => {

		let isEqual = (element == productId);
		if (isEqual) {
			response = isEqual;
		}
	});

	return response;

}

function flyImage(product) {
	const cart = document.querySelector('.red_heart_notification span');
	const cloneCart = document.querySelector('.header-clone .red_heart_notification span');
	const productImage = product.querySelector('.swiper-slide .the-node-image');
	const productImageFly = productImage.cloneNode(true);
	const pif_width = productImage.offsetWidth;
	const pif_height = productImage.offsetHeight;
	const pif_top = productImage.getBoundingClientRect().top;
	const pif_left = productImage.getBoundingClientRect().left;

	productImageFly.setAttribute('class', 'flyImage ibg');
	productImageFly.style.cssText =
		`
		left: ${pif_left}px;
		top: ${pif_top}px;
		width: ${pif_width}px;
		height: ${pif_height}px;
	`;

	document.body.append(productImageFly);

	var header = document.querySelector('header.header');

	let cart_top;
	let cart_left;

	if (header.classList.contains('scrolled')) {
		turnHeaderCloneON();
		cart_top = cloneCart.getBoundingClientRect().top;
		cart_left = cloneCart.getBoundingClientRect().left;
	} else {
		cart_top = cart.getBoundingClientRect().top;
		cart_left = cart.getBoundingClientRect().left;
	}


	productImageFly.style.cssText =
		`
		left: ${cart_left}px;
		top: ${cart_top}px;
		width: 0px;
		height: 0px;
		opacity: 0;
	`;
}

function setCartCountValue(quantity) {
	const cart = document.querySelector('.red_heart_notification span');
	const cloneCart = document.querySelector('.header-clone .red_heart_notification span');

	var added = quantity;
	added = Number(added);
	cart.innerText = added;
	cloneCart.innerText = added;
}

function incrementCartCount() {
	const cart = document.querySelector('.red_heart_notification span');
	const cloneCart = document.querySelector('.header-clone .red_heart_notification span');

	var added = cart.innerText;
	added = Number(added);
	added = added + 1;
	cart.innerText = added;
	cloneCart.innerText = added;
}

function decrementCartCount() {
	const cart = document.querySelector('.red_heart_notification span');
	const cloneCart = document.querySelector('.header-clone .red_heart_notification span');

	var added = cart.innerText;
	added = Number(added);
	added = added - 1;
	cart.innerText = added;
	cloneCart.innerText = added;

}

function changeButtonState(button, targetState) {
	switch (targetState) {
		case "active":
			pushButton(button);
			break;
		case "blank":
			unPushButton(button);
			break;
		default:
			if (isButtonActive(button)) {
				unPushButton(button);
			} else {
				pushButton(button);
			}
			break;
	}
}

function pushButton(button) {
	switch (button.type) {
		case "full":
			button.button.classList.remove('_icon-heart');
			button.button.classList.add('_icon-red_heart');
			break;
		case "teaser":
			button.button.src = getRedHeartSrc(projectContext);
			break;
	}
}

function unPushButton(button) {
	switch (button.type) {
		case "full":
			button.button.classList.remove('_icon-red_heart');
			button.button.classList.add('_icon-heart');
			break;
		case "teaser":
			button.button.src = getBlankHeartSrc(projectContext);
			break;
	}
}

function isButtonActive(button) {
	var response = false;

	switch (button.type) {
		case "full":
			if (button.button.classList.contains('_icon-red_heart')) {
				response = true;
			}
			break;
		case "teaser":
			if (button.button.src.includes(getRedHeartSrc(projectContext))) {

				response = true;
			}
			break;
	}
	return response;

}

function getProduct(productId) {
	if (!productId) {
		let product = document.querySelector(`[data-nid]`);
		if (product) {
			return true;
		}
	}
	var product = document.querySelector(`[data-nid="${productId}"]`);
	return product;

}

function getButton(product) {
	var response = {
		button: "element",
		type: "is it full node or teaser"
	};
	if (product.querySelector('._icon-heart') || product.querySelector('._icon-red_heart')) {

		if (product.querySelector('._icon-heart')) {
			response.button = product.querySelector('._icon-heart');
		}
		if (product.querySelector('._icon-red_heart')) {
			response.button = product.querySelector('._icon-red_heart');
		}
		response.type = "full";

	} else {
		if (product.querySelector('img.add-to-cart')) {
			response.button = product.querySelector('img.add-to-cart');
			response.type = "teaser";
		}
	}
	return response;
}

function getRedHeartSrc(projectContext) {
	var response = ' ';
	switch (projectContext) {
		case "production":
			response = '/themes/mytheme/img/icons/red_heart.svg';
			break;
		case "local":
			response = 'img/icons/red_heart.svg';
			break
		default:
			response = '/themes/mytheme/img/icons/red_heart.svg';
	}

	return response;
}

function getBlankHeartSrc(projectContext) {
	var response = ' ';
	switch (projectContext) {
		case "production":
			response = '/themes/mytheme/img/icons/Like.svg';
			break;
		case "local":
			response = 'img/icons/Like.svg';
			break
		default:
			response = '/themes/mytheme/img/icons/Like.svg';
	}

	return response;

}

// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

	options = {
		path: '/',
		'max-age': 36000000,
		// при необходимости добавьте другие значения по умолчанию
		...options
	};

	if (options.expires instanceof Date) {
		options.expires = options.expires.toUTCString();
	}

	let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

	for (let optionKey in options) {
		updatedCookie += "; " + optionKey;
		let optionValue = options[optionKey];
		if (optionValue !== true) {
			updatedCookie += "=" + optionValue;
		}
	}

	document.cookie = updatedCookie;
}

window.onload = function () {
	document.addEventListener("click", documentActions);
	checkTheCart();
	// Actions (делегирование события click)
	function documentActions(e) {
		const targetElement = e.target;
		if (targetElement.classList.contains('search-form__icon')) {
			document.querySelector('.search-form').classList.toggle('_active');
			setTimeout(function () {
				document.getElementById('search_input').focus();
				document.getElementById('search_input').select();
			}, 100);


		} else if (!targetElement.closest('.search-form') && document.querySelector('.search-form._active')) {
			document.querySelector('.search-form').classList.remove('_active');
		}

		if (targetElement.classList.contains('add-to-cart')) {
			const productId = targetElement.closest('.the-product').dataset.nid;
			addToCart(productId);
		}
	}
}


