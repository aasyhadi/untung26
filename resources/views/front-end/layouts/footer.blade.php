<!-- Footer -->
<div class="footer">
    <a href="{{ url('/') }}">Beranda</a>
    <a href="{{ url('/profil') }}">Profil</a>
    <a href="{{ url('/artikel') }}">Artikel</a>
    <a href="{{ url('/produk') }}">Produk</a>
    <a href="{{ url('/hubungi') }}">Hubungi</a>
</div>

<p class="copyright">&copy; {{ site_setting('site_domain_text', site_setting('brand_name')) }} - {{ date('Y') }}</p>
