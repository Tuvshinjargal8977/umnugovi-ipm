<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $orgName = 'Өмнөговь аймгийн төслийн удирдлагын газар'; @endphp

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/images/emblem.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16.png">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">

    <title inertia>{{ config('app.name', $orgName) }}</title>
    <meta name="theme-color" content="#14315a">
    <meta property="og:site_name" content="{{ $orgName }}">
    {{-- Хуудас тус бүрийн description, og:title/description/image, canonical зэргийг
         resources/js/Components/Seo.tsx (Inertia <Head>) динамикаар удирдана. --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;500;700;800&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
    @inertiaHead
</head>
<body class="min-h-screen bg-white">
    @inertia
</body>
</html>
