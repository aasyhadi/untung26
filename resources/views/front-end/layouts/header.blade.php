<!-- Top Bar -->
<div class="top-bar">
    <div class="top-bar-container">
        <div><i class="fas fa-map-marker-alt"></i> {{ site_setting('lokasi', 'Kota Jambi, Indonesia') }}</div>
        <div><i class="fas fa-envelope"></i> {{ site_setting('email', 'untunguy29@gmail.com') }}</div>
    </div>
</div>

<!-- Navbar -->
<div class="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="logo">{{ site_setting('site_domain_text', site_setting('brand_name')) }}</a>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <nav class="nav-links">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/profil') }}">Profil</a>
            <a href="{{ url('/artikel-konstruksi') }}">Artikel</a>
            <a href="{{ url('/produk') }}">Produk</a>
            <a href="{{ url('/hubungi') }}">Hubungi</a>
        </nav>
    </div>
</div>
