<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Pengaduan Siswa') }}</title>
    {{-- <title>Dashboard</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('src/css/main.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-900 bg-white dark:bg-darker dark:text-light">
            <!-- Loading screen -->
            <div class="inset-0 bg-gray-800 fixed flex w-full h-full items-center justify-center duration-300 transition-opacity"style="z-index: 6000"
                x-ref="loading">
                <!-- Include your loading component content here -->
                @include('layouts.components.loading')
            </div>

            {{-- loading function --}}
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                @include('layouts.navigation')


                <!-- Main content -->
                <main class="">
                    {{ $slot }}
                </main>

            </div>
            <!-- Panels -->

            <!-- Settings Panel -->
            @include('layouts.setting-panel')

            <!-- Notification panel -->
            @include('layouts.notification-panel')

            <!-- Search panel -->
            @include('layouts.search-panel')
        </div>
    </div>

    <script src="{{ asset('src/js/alpine.js') }}"></script>
</body>

{{-- <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script> --}}

</html>
