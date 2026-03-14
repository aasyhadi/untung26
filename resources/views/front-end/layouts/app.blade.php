<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ site_setting('hero_subtitle', 'Layanan profesional dalam konsultasi, pelatihan, sertifikasi, dan bimbingan teknis konstruksi.') }}">
    <meta name="keywords" content="konsultasi konstruksi, pelatihan konstruksi, sertifikasi konstruksi, bimbingan teknis konstruksi, jasa konstruksi, manajemen proyek">
    <meta name="author" content="{{ site_setting('site_name', 'Untung Yasril') }}">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="@yield('title', site_setting('site_domain_text', 'untungyasril.com'))">
    <meta property="og:description" content="{{ site_setting('hero_subtitle', 'Layanan profesional dalam konsultasi, pelatihan, sertifikasi, dan bimbingan teknis konstruksi.') }}">
    <meta property="og:image" content="{{ asset('images/og-image1.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <title>@yield('title', site_setting('site_domain_text', 'untungyasril.com'))</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    @include('front-end.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('front-end.layouts.footer')

    @section('modal')
    @show

    <script>
        function toggleMenu() {
            document.querySelector('.nav-links').classList.toggle('active');
        }
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RYLG2VJ3C5"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);} 
    gtag('js', new Date());
    gtag('config', 'G-RYLG2VJ3C5');
    </script>

    @section('js')
    @show
</body>
</html>
