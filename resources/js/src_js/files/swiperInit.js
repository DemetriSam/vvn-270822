function initThumbs() {//здесь мы инициализируем миниютюры свайпера
    var thumbs = document.querySelector('.product-card__items .gallery-thumbs');
    thumbs.removeAttribute("style");//по умолчанию элемент с миниатюрами имеет атрибут style="display: none;", отключаем его
    var gallery = document.querySelector('.product-card__items .swiper-main');
    var images = gallery.querySelectorAll('img');
    var imgLinks = [];
    var regex = new RegExp('svg$');
    images.forEach(element => {//получаем ссылки на изображения
        if (!regex.test(element.src)) {
            imgLinks.push(element.src)
        }
    });
    imgLinks.forEach(element => {//создаем миниаютюры
        thumbs.querySelector('.swiper-wrapper').innerHTML += `
        <div class="swiper-slide" style="background-image:url(${element})"></div>`
    });


}

function initNoThumbs() {//блок с миниаютюрами идет в шаблоне twig галереи рядом с каждым свайпером, что вызывает ошибку. исправим это, удалив класс gallery-thumbs из рекомендательного блока
    var recSwipers = document.querySelectorAll('.nodes__item .swiper-main');
    recSwipers.forEach(element => {
        element.classList.remove("swiper-main");
        element.classList.add("swiper-rec");
    });

    var noThumbs = document.querySelectorAll('.nodes__item .gallery-thumbs');
    noThumbs.forEach(element => {
        element.classList.remove("gallery-thumbs");
    });
}

function initSwipers() {
    var thumbs = new Swiper('.gallery-thumbs', {
        direction: 'vertical',
        spaceBetween: 12,
        // Количество слайдов для показа
        slidesPerView: 3,

        // Отключение функционала
        // если слайдов меньше чем нужно
        watchOverflow: true,
        navigation: {
            nextEl: '._icon-up',
            prevEl: '._icon-down',
        },

    })

    var swiperMain = new Swiper('.swiper-main', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        autoHeight: true,

        thumbs: {
            swiper: thumbs
        }

    });

    var swiperRec = new Swiper('.swiper-rec', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        autoHeight: true,

    });

}

if (document.readyState === 'loading') {  // Loading hasn't finished yet
    document.addEventListener('DOMContentLoaded', initNoThumbs);
    document.addEventListener('DOMContentLoaded', initThumbs);
    document.addEventListener('DOMContentLoaded', initSwipers);
} else {  // `DOMContentLoaded` has already fired
    initNoThumbs();
    initThumbs();
    initSwipers();
}


