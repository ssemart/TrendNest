<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('frontend/css/auth.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="mb-8">
                <a href="/" class="transition-transform hover:scale-105">
                    <x-application-logo class="w-48 h-auto object-contain" />
                </a>
            </div>

            {{ $slot }}
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} TrendNest. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
