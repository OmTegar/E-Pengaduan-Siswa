<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pengaduan Siswa - Selamat Datang</title>

    <!-- Meta SEO -->
    <meta name="title" content="E-Pengaduan Siswa - Selamat Datang">
    <meta name="description" content="Aplikasi laporan pengaduan keluhan siswa">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="mokletdev">

    <!-- Social media share -->
    <meta property="og:title" content="E-Pengaduan Siswa - Selamat Datang">
    <meta property="og:site_name" content="E-Pengaduan Siswa">
    <meta property="og:description" content="Aplikasi laporan pengaduan keluhan siswa">
    <meta property="og:type" content="">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@mokletdev" />
    <meta name="twitter:creator" content="@mokletdev" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('src/css/page.css') }}" rel="stylesheet">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" :class="{ 'dark': isDark }">
        @include('landing-page.layouts.navbar')

        {{-- start --}}
        {{ $slot }}
        {{-- end --}}

        @include('landing-page.layouts.footer')
    </div>
</body>

<script src="{{ asset('src/js/alpine.js') }}"></script>
<script src="{{ asset('src/js/landing.js') }}"></script>

</html>
