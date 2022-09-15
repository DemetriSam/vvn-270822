var slideIndex = 1;
showSlides(slideIndex);
createSmallDots();

var thumbsParent = document.getElementById("block-views-block-thumbnails-for-gallery-block-1");

thumbsParent.onclick = function (event) {
    console.log('click');

    var thumbs = this.getElementsByTagName("img");

    for (var i = 0; i < thumbs.length; i++) {
        if (thumbs[i] == event.target) {
            console.log(i);
            currentSlide(i + 1);

        }

    }

}

var dotsParent = document.getElementById("dots");

dotsParent.onclick = function (event) {
    console.log('clickDot');

    var dots = this.getElementsByClassName("dots__item");

    for (var i = 0; i < dots.length; i++) {
        if (dots[i] == event.target) {
            m = i + 1;
            console.log('Кликнули точку: ' + m);
            currentSlide(i + 1);

        }

    }

}

function plusSlides(n) {
    showSlides(slideIndex += n);
}


function currentSlide(n) {
    showSlides(slideIndex = n);
}

function createSmallDots() {
    let smallDot;
    var slides = document.getElementsByClassName("slides");

    for (let i = 0; i < slides.length; i++) {
        smallDot = document.createElement('div');
        smallDot.setAttribute('class', 'dots__item');
        m = i + 1;
        smallDot.innerText = 'точка' + m;
        document.getElementById('dots').append(smallDot);
    }
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("slides");
    //var dots = document.getElementsByClassName("slide-thumbnail");
    var dots = document.getElementById("block-views-block-thumbnails-for-gallery-block-1").getElementsByTagName("img");
    console.log('Слайдов: ' + slides.length);
    var smallDots = document.getElementsByClassName('dots__item');

    var captionText = document.getElementById("caption");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    console.log('Текущй слайд: ' + slideIndex);

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        // slides[i].style.display = "inline";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    for (i = 0; i < smallDots.length; i++) {
        smallDots[i].className = smallDots[i].className.replace(" dots__item_active", "");
    }

    slides[slideIndex - 1].style.display = "block";
    // slides[slideIndex-1].style.display = "inline";
    dots[slideIndex - 1].className += " active";
    if (smallDots.length) {
        smallDots[slideIndex - 1].className += " dots__item_active";
    }

    //captionText.innerHTML = dots[slideIndex - 1].alt;
}

