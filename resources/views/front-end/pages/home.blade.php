@extends('front-end.layouts.app')

@section('title', 'Beranda - Jasa Konsultasi Konstruksi')

@section('content')
@php
    $metodeLabels = [
        4 => 'Online',
        5 => 'Offline',
        6 => 'Hybrid',
    ];

    $artikelItems = collect($artikels);
    $headlineArtikel = $artikelItems->first();
    $artikelLain = $artikelItems->slice(1, 5);
@endphp

<style>
    .home-wrap {
        background: #f7f8fc;
    }

    .section-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 28px 20px 64px;
    }

    .section-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 28px;
    }

    .section-head h2 {
        margin: 0 0 10px;
        font-size: 40px;
        line-height: 1.2;
        font-weight: 700;
        color: #0f172a;
    }

    .section-head p {
        margin: 0;
        font-size: 17px;
        line-height: 1.7;
        color: #64748b;
        max-width: 760px;
    }

    .section-head a {
        font-size: 15px;
        font-weight: 700;
        color: #4338ca;
        text-decoration: none;
        white-space: nowrap;
        margin-top: 8px;
    }

    .section-head a:hover {
        text-decoration: underline;
    }

    .hero-modern {
        padding: 48px 20px 24px;
        background: linear-gradient(135deg, #eef4ff 0%, #ffffff 60%, #f9f1df 100%);
    }

    .hero-grid {
        max-width: 1180px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 32px;
        align-items: center;
    }

    .hero-card {
        background: #fff;
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .hero-kicker {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        background: #fff4d6;
        color: #7a5a00;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 14px;
    }

    .hero-modern h1 {
        font-size: 44px;
        line-height: 1.15;
        margin: 0 0 16px;
        color: #102447;
    }

    .hero-modern p {
        color: #475569;
        font-size: 16px;
        line-height: 1.8;
    }

    .hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .hero-profile {
        background: #102447;
        color: #fff;
        text-align: center;
        padding: 24px;
        border-radius: 24px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
    }

    .hero-profile img {
        width: 100%;
        max-width: 320px;
        border-radius: 20px;
        object-fit: cover;
    }

    .hero-profile h3 {
        margin: 18px 0 6px;
        font-size: 24px;
    }

    .hero-profile p {
        color: #dbe6ff;
    }

    .btn-solid,
    .btn-soft,
    .btn-wa,
    .btn-dark {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 46px;
        padding: 12px 18px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s ease;
    }

    .btn-solid {
        background: #4f46e5;
        color: #fff;
    }

    .btn-solid:hover {
        background: #3730a3;
        color: #fff;
        text-decoration: none;
    }

    .btn-soft {
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #c7d2fe;
    }

    .btn-soft:hover {
        background: #4338ca;
        color: #fff;
        text-decoration: none;
    }

    .btn-wa {
        background: #25D366;
        color: #fff;
    }

    .btn-wa:hover {
        background: #1faa52;
        color: #fff;
        text-decoration: none;
    }

    .btn-dark {
        background: #0f172a;
        color: #fff;
    }

    .btn-dark:hover {
        background: #020617;
        color: #fff;
        text-decoration: none;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
    }

    .service-card {
        background: #fff;
        border-radius: 20px;
        padding: 22px;
        text-align: center;
        text-decoration: none;
        color: #102447;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.1);
        color: #102447;
        text-decoration: none;
    }

    .service-card i {
        display: block;
        font-size: 34px;
        color: #d4a017;
        margin-bottom: 12px;
    }

    .service-card div {
        font-weight: 700;
        line-height: 1.5;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .content-card {
        background: #fff;
        border-radius: 24px;
        padding: 18px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .content-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
    }

    .content-card-thumb {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-radius: 18px;
        display: block;
        background: #eef2f7;
    }

    .content-card-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        padding-top: 18px;
    }

    .content-meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #64748b;
        margin-bottom: 12px;
    }

    .content-card h3 {
        margin: 0 0 12px;
        font-size: 24px;
        line-height: 1.45;
        font-weight: 700;
        color: #0f172a;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 104px;
    }

    .content-card p {
        margin: 0 0 18px;
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 86px;
    }

    .content-card-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .product-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
        padding: 6px 12px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .product-price {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .product-action-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .schedule-card {
        background: #fff;
        border-radius: 24px;
        padding: 18px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        display: grid;
        grid-template-columns: 190px minmax(0, 1fr);
        gap: 20px;
        align-items: start;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .schedule-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
    }

    .schedule-thumb-wrap {
        width: 100%;
        height: 280px;
        background: #f8fafc;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .schedule-thumb {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .schedule-body {
        display: flex;
        flex-direction: column;
        min-width: 0;
        height: 100%;
    }

    .schedule-badges {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        flex-wrap: wrap;
    }

    .badge-state {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        width: fit-content;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-open {
        background: #dcfce7;
        color: #166534;
    }

    .badge-close {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-method {
        background: #eef2ff;
        color: #4338ca;
    }

    .schedule-title {
        margin: 0 0 14px;
        font-size: 24px;
        line-height: 1.45;
        font-weight: 700;
        color: #0f172a;
    }

    .schedule-info {
        display: grid;
        gap: 10px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .schedule-info li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #475569;
        line-height: 1.7;
        font-size: 15px;
    }

    .schedule-info i {
        width: 18px;
        margin-top: 4px;
        color: #6366f1;
        flex: 0 0 18px;
    }

    .schedule-info strong {
        color: #0f172a;
        font-weight: 700;
    }

    .schedule-link {
        margin-top: auto;
        padding-top: 18px;
    }

    .schedule-empty {
        background: #fff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        color: #475569;
    }

    .article-featured-layout {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 24px;
    }

    .headline-article-card {
        background: #fff;
        border-radius: 24px;
        padding: 18px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .headline-article-card:hover,
    .headline-side-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.10);
    }

    .headline-article-thumb {
        width: 100%;
        height: 360px;
        object-fit: cover;
        border-radius: 18px;
        display: block;
        background: #eef2f7;
    }

    .headline-article-body {
        padding-top: 18px;
    }

    .headline-article-body h3 {
        margin: 0 0 14px;
        font-size: 32px;
        line-height: 1.3;
        color: #0f172a;
        font-weight: 700;
    }

    .headline-article-body p {
        margin: 0 0 20px;
        font-size: 17px;
        line-height: 1.8;
        color: #475569;
    }

    .headline-side-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .headline-side-card {
        background: #fff;
        border-radius: 22px;
        padding: 14px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 14px;
        align-items: start;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .headline-side-thumb {
        width: 100%;
        height: 110px;
        object-fit: cover;
        border-radius: 14px;
        background: #eef2f7;
    }

    .headline-side-body h4 {
        margin: 0 0 8px;
        font-size: 18px;
        line-height: 1.45;
        color: #0f172a;
        font-weight: 700;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .headline-side-link {
        font-weight: 600;
        color: #4338ca;
        text-decoration: none;
    }

    .headline-side-link:hover {
        text-decoration: underline;
    }

    .headline-empty {
        background: #fff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        color: #475569;
    }

    .cta-strip {
        margin-top: 36px;
        background: #102447;
        border-radius: 24px;
        padding: 30px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .cta-strip h3 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .cta-strip p {
        margin: 0;
        color: #dbe6ff;
    }

    @media (max-width: 1024px) {
        .card-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .section-head h2 {
            font-size: 34px;
        }
    }

    @media (max-width: 992px) {
        .hero-grid,
        .service-grid,
        .schedule-grid,
        .article-featured-layout {
            grid-template-columns: 1fr;
        }

        .hero-modern h1 {
            font-size: 34px;
        }
    }

    @media (max-width: 768px) {
        .section-head {
            flex-direction: column;
        }

        .card-grid,
        .schedule-card,
        .headline-side-card {
            grid-template-columns: 1fr;
        }

        .content-card h3,
        .content-card p {
            min-height: auto;
        }

        .content-card h3,
        .schedule-title,
        .headline-article-body h3 {
            font-size: 22px;
        }

        .schedule-thumb-wrap {
            height: 260px;
        }

        .headline-article-thumb {
            height: 100%;
            min-height: 520px;
        }

        .headline-side-thumb {
            height: 180px;
        }

        .content-card-footer,
        .product-action-group,
        .hero-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .content-card-footer .btn-soft,
        .content-card-footer .btn-solid,
        .content-card-footer .btn-wa,
        .product-action-group .btn-soft,
        .product-action-group .btn-wa,
        .hero-actions .btn-wa,
        .hero-actions .btn-dark {
            width: 100%;
        }

        .cta-strip {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="home-wrap">
    <section class="hero-modern">
        <div class="hero-grid">
            <div class="hero-card">
                <span class="hero-kicker">
                    {{ site_setting('site_name', 'Untung Yasril') }}
                </span>

                <h1>
                    {{ site_setting('hero_title', 'Solusi jasa konstruksi yang lebih rapi, aman, dan menguntungkan.') }}
                </h1>

                <p>
                    {{ site_setting('hero_subtitle', 'Mendampingi pelaku jasa konstruksi, instansi, mahasiswa, dan umum melalui konsultasi, pelatihan, sertifikasi, serta materi pendukung yang aplikatif.') }}
                </p>

                <div class="hero-actions">
                    <a
                        href="{{ wa_link(site_setting('whatsapp_number'), 'Halo Pak Untung, saya ingin konsultasi online.') }}"
                        target="_blank"
                        class="btn-wa"
                    >
                        <i class="fab fa-whatsapp"></i>
                        Konsultasi via WhatsApp
                    </a>

                    <a href="{{ url('/produk') }}" class="btn-dark">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Lihat Produk
                    </a>
                </div>
            </div>

            <div class="hero-profile">
                <img
                    src="{{ media_url(site_setting('hero_image'), 'img/ir-untung-yasril.png') }}"
                    alt="{{ site_setting('site_name', 'Untung Yasril') }}"
                >

                <h3>Ir. H. Untung Yasril, S.T., M.T. CPSp, CCMS</h3>

                <p>
                    {{ site_setting('profil_ringkas', 'Construction Specialist • Trainer • Konsultan • Narasumber') }}
                </p>
            </div>
        </div>
    </section>

    <section class="section-wrap">
        <div class="section-head">
            <div>
                <h2>Layanan utama</h2>
                <p>Layanan profesional untuk pendampingan teknis, edukasi, dan penguatan kompetensi.</p>
            </div>
        </div>

        <div class="service-grid">
            <a class="service-card" href="{{ url('/layanan/konsultasi') }}">
                <i class="fas fa-comments"></i>
                <div>Konsultasi</div>
            </a>

            <a class="service-card" href="{{ url('/layanan/pelatihan') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <div>Pelatihan</div>
            </a>

            <a class="service-card" href="{{ url('/layanan/sertifikasi') }}">
                <i class="fas fa-certificate"></i>
                <div>Sertifikasi</div>
            </a>

            <a class="service-card" href="{{ url('/layanan/narasumber') }}">
                <i class="fas fa-microphone"></i>
                <div>Narasumber</div>
            </a>

            <a class="service-card" href="{{ url('/produk') }}">
                <i class="fas fa-box-open"></i>
                <div>Produk</div>
            </a>
        </div>
    </section>

    <section class="section-wrap">
        <div class="section-head">
            <div>
                <h2>Jadwal layanan & pelatihan</h2>
                <p>Agenda pelatihan terbaru dan informasi seminar online (webinar).</p>
            </div>
        </div>

        <div class="schedule-grid">
            @forelse($jadwalPelatihan as $jadwal)
                <article class="schedule-card">
                    <div class="schedule-thumb-wrap">
                        <img
                            src="{{ media_url($jadwal->cover, 'images/og-image1.png') }}"
                            alt="{{ $jadwal->nama_pelatihan }}"
                            class="schedule-thumb"
                        >
                    </div>

                    <div class="schedule-body">
                        <div class="schedule-badges">
                            @if($jadwal->tanggal && $jadwal->tanggal >= now()->format('Y-m-d'))
                                <span class="badge-state badge-open">
                                    <i class="fas fa-check-circle"></i> BUKA
                                </span>
                            @else
                                <span class="badge-state badge-close">
                                    <i class="fas fa-clock"></i> TUTUP
                                </span>
                            @endif

                            <span class="badge-state badge-method">
                                <i class="fas fa-laptop-house"></i>
                                {{ $metodeLabels[$jadwal->metode] ?? '-' }}
                            </span>
                        </div>

                        <h3 class="schedule-title">{{ $jadwal->nama_pelatihan }}</h3>

                        <ul class="schedule-info">
                            <li>
                                <i class="fas fa-book-open"></i>
                                <span><strong>Tema:</strong> {{ $jadwal->deskripsi ?: '-' }}</span>
                            </li>
                            <li>
                                <i class="fas fa-calendar-alt"></i>
                                <span><strong>Tanggal:</strong> {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}</span>
                            </li>
                            <li>
                                <i class="fas fa-user-tie"></i>
                                <span><strong>Narasumber:</strong> {{ $jadwal->narasumber ?: '-' }}</span>
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span><strong>Lokasi:</strong> {{ $jadwal->lokasi ?: '-' }}</span>
                            </li>
                        </ul>

                        @if($jadwal->link_pendaftaran)
                            <div class="schedule-link">
                                <a
                                    href="{{ $jadwal->link_pendaftaran }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn-solid"
                                >
                                    <i class="fas fa-arrow-right"></i>
                                    Daftar sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <div class="schedule-empty">
                    Belum ada jadwal terbaru.
                </div>
            @endforelse
        </div>
    </section>

    <section class="section-wrap">
        <div class="section-head">
            <div>
                <h2>Artikel terbaru</h2>
                <p>Insight, catatan lapangan, dan referensi praktis seputar jasa konstruksi.</p>
            </div>
            <a href="{{ url('/artikel') }}">Lihat semua</a>
        </div>

        @if($headlineArtikel)
            <div class="article-featured-layout">
                <article class="headline-article-card">
                    <img
                        src="{{ media_url($headlineArtikel->foto, 'images/og-image1.png') }}"
                        alt="{{ $headlineArtikel->judul }}"
                        class="headline-article-thumb"
                    >

                    <div class="headline-article-body">
                        <div class="content-meta">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ optional($headlineArtikel->published_at)->translatedFormat('d F Y') ?: '-' }}</span>
                        </div>

                        <h3>{{ $headlineArtikel->judul }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit($headlineArtikel->ringkasan ?: strip_tags($headlineArtikel->isi_artikel), 220) }}
                        </p>

                        <a class="btn-solid" href="{{ url('/artikel/' . $headlineArtikel->slug) }}">
                            <i class="fas fa-book-reader"></i>
                            Baca artikel utama
                        </a>
                    </div>
                </article>

                <div class="headline-side-list">
                    @foreach($artikelLain as $artikel)
                        <article class="headline-side-card">
                            <img
                                src="{{ media_url($artikel->foto, 'images/og-image1.png') }}"
                                alt="{{ $artikel->judul }}"
                                class="headline-side-thumb"
                            >

                            <div class="headline-side-body">
                                <div class="content-meta">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ optional($artikel->published_at)->translatedFormat('d F Y') ?: '-' }}</span>
                                </div>

                                <h4>{{ $artikel->judul }}</h4>

                                <a href="{{ url('/artikel/' . $artikel->slug) }}" class="headline-side-link">
                                    Baca artikel
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @else
            <div class="headline-empty">
                Belum ada artikel yang dipublikasikan.
            </div>
        @endif
    </section>

    <section class="section-wrap">
        <div class="section-head">
            <div>
                <h2>Produk unggulan</h2>
                <p>Produk pilihan siap diorder.</p>
            </div>
            <a href="{{ url('/produk') }}">Lihat semua</a>
        </div>

        <div class="card-grid">
            @forelse($produks as $produk)
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $produk->order_wa ?: site_setting('whatsapp_number'));
                    $waText = rawurlencode('Halo, saya tertarik dengan produk: ' . $produk->judul);
                @endphp

                <article class="content-card">
                    <img
                        src="{{ media_url($produk->foto, 'images/og-image1.png') }}"
                        alt="{{ $produk->judul }}"
                        class="content-card-thumb"
                    >

                    <div class="content-card-body">
                        <div class="product-status-badge">
                            <i class="fas fa-check-circle"></i>
                            {{ $produk->status === 'publish' ? 'Tersedia' : 'Draft' }}
                        </div>

                        <h3>{{ $produk->judul }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit($produk->ringkasan ?: strip_tags($produk->ulasan), 120) }}
                        </p>

                        <div class="content-card-footer">
                            <div class="product-price">
                                Rp {{ number_format((int) $produk->harga, 0, ',', '.') }}
                            </div>

                            <div class="product-action-group">
                                <a class="btn-soft" href="{{ url('/produk/' . $produk->slug) }}">
                                    <i class="fas fa-eye"></i>
                                    Lihat produk
                                </a>

                                @if($waNumber)
                                    <a
                                        class="btn-wa"
                                        href="https://wa.me/{{ $waNumber }}?text={{ $waText }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <i class="fab fa-whatsapp"></i>
                                        Order WA
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="content-card">
                    <div class="content-card-body">
                        <h3>Belum ada produk</h3>
                        <p>Produk akan tampil di sini setelah ditambahkan dari akun admin.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="cta-strip">
            <div>
                <h3>Butuh bantuan cepat?</h3>
                <p>Diskusikan kebutuhan proyek, dokumen, atau pelatihan langsung lewat WhatsApp.</p>
            </div>

            <a
                href="{{ wa_link(site_setting('whatsapp_number'), 'Halo Pak Untung, saya ingin berkonsultasi.') }}"
                target="_blank"
                class="btn-wa"
            >
                <i class="fab fa-whatsapp"></i>
                Hubungi sekarang
            </a>
        </div>
    </section>
</div>
@endsection
