<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex w-full gap-1 justify-between">
                    {{ $header }}
                </div>
            </div>
        </header>
        @if(session()->has('success'))
        {{ session()->get('success') }}
        @endif
        @if(session()->has('errors'))
        {{ session()->get('errors') }}
        @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif
        @endif
        <!-- Page Content -->
        <main>
            <x-container>
                {{ $slot }}
            </x-container>
        </main>
    </div>
</body>

</html>