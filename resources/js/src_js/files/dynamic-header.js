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