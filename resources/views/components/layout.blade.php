<!DOCTYPE html>
<html lang="ru">

<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- <meta name="robots" content="noindex, nofollow"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description }}">
    <script type="module" src="/swiper-bundle.min.js"></script>
    @vite([
    'resources/scss/style.scss',
    'resources/js/src_js/app.js',
    'resources/js/app.js',
    ])
    @production
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7TXR23ZY9W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-7TXR23ZY9W');
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(88518198, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/88518198" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
    @endproduction
</head>

<body>
    <x-header />
    <div class="wrapper">
        <main class="page">
            <div class="_container">
                {{ $slot }}
            </div>
        </main>
        <x-footer />
    </div>
    <div class="popup" id="designer-form-region">
        <a href="##" class="popup__area"></a>
        <div class="popup__body">
            <div class="popup__content">
                @include('designer-form')
            </div>
        </div>
    </div>
</body>


</html>