<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Главная</title>
        <meta charset="UTF-8">
        <meta name="format-detection" content="telephone=no">
        <link rel="shortcut icon" href="favicon.ico">
        <!-- <meta name="robots" content="noindex, nofollow"> -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="module" src="http://vvn.local/swiper-bundle.min.js"></script>
        @vite([
            'resources/scss/style.scss',
            'resources/js/app.js',
        ])
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
    </body>


</html>