<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $orgName = 'Өмнөговь аймгийн төслийн удирдлагын газар'; @endphp

    <link rel="icon" href="/images/emblem.svg" type="image/svg+xml">

    <title inertia>{{ config('app.name', $orgName) }}</title>
    <meta name="description" content="{{ $orgName }} — Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүдийн мэдээлэл.">
    <meta name="theme-color" content="#14315a">

    <meta property="og:site_name" content="{{ $orgName }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $orgName }}">
    <meta property="og:description" content="Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүд (IPM).">
    <meta property="og:image" content="{{ url('/images/emblem.svg') }}">
    <meta name="twitter:card" content="summary">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
    @inertiaHead
</head>
<body class="min-h-screen bg-white">
    @inertia
</body>
</html>
