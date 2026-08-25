@extends('front-end.layouts.app')

@section('title', 'Artikel')

@section('content')
<style>
    /* =========================================================
       ARTICLE LIST
       ========================================================= */

    .article-list-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 20px 50px;
    }

    .article-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    /* =========================================================
       ARTICLE CARD
       ========================================================= */

    .article-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);

        display: flex;
        flex-direction: column;

        height: 100%;

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .12);
    }

    .article-card-image {
        width: 100%;
        height: 220px;

        object-fit: cover;

        border-radius: 16px;

        display: block;

        background: #eef2f7;
    }

    .article-card-body {
        display: flex;
        flex-direction: column;

        flex: 1;

        padding-top: 14px;
    }

    /* =========================================================
       ARTICLE META
       ========================================================= */

    .article-date {
        display: flex;
        align-items: center;
        gap: 6px;

        margin-bottom: 8px;

        color: #64748b;

        font-size: 13px;
        line-height: 1.5;
    }

    .article-date i {
        color: #64748b;
    }

    /* =========================================================
       ARTICLE TITLE
       ========================================================= */

    .article-card h3 {
        margin: 0 0 10px;

        font-size: 22px;
        line-height: 1.45;
        font-weight: 700;

        color: #0f172a;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

        overflow: hidden;

        min-height: 64px;
    }

    /* =========================================================
       ARTICLE SUMMARY
       ========================================================= */

    .article-card p {
        margin: 0 0 18px;

        color: #475569;

        font-size: 15px;
        line-height: 1.8;

        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;

        overflow: hidden;

        min-height: 81px;
    }

    /* =========================================================
       ARTICLE BUTTON
       ========================================================= */

    .article-card-footer {
        margin-top: auto;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 44px;

        padding: 10px 18px;

        border-radius: 12px;

        background: #4f46e5;
        color: #ffffff;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .read-more-btn:hover {
        background: #3730a3;

        color: #ffffff;

        text-decoration: none;

        transform: translateY(-1px);
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .empty-state {
        background: #ffffff;

        border-radius: 20px;

        padding: 24px;

        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);

        color: #475569;

        font-size: 15px;
    }

    /* =========================================================
       PAGINATION
       ========================================================= */

    .article-pagination {
        width: 100%;

        margin-top: 38px;
        margin-bottom: 10px;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .article-pagination nav {
        width: auto !important;

        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    /*
     * Override CSS global template
     * supaya UL pagination tidak menjadi list vertikal
     */
    .article-pagination ul,
    .article-pagination .pagination {
        display: flex !important;

        flex-direction: row !important;

        align-items: center !important;
        justify-content: center !important;

        flex-wrap: wrap !important;

        gap: 8px !important;

        list-style: none !important;
        list-style-type: none !important;

        margin: 0 !important;
        padding: 0 !important;
    }

    /*
     * Hilangkan bullet pada LI
     */
    .article-pagination ul li,
    .article-pagination .page-item {
        display: block !important;

        float: none !important;

        list-style: none !important;
        list-style-type: none !important;

        margin: 0 !important;
        padding: 0 !important;
    }

    /*
     * Antisipasi theme global yang membuat bullet melalui pseudo-element
     */
    .article-pagination ul li::before,
    .article-pagination ul li::after,
    .article-pagination .page-item::before,
    .article-pagination .page-item::after {
        content: none !important;
        display: none !important;
    }

    /*
     * Button pagination
     */
    .article-pagination .page-link {
        display: inline-flex !important;

        align-items: center !important;
        justify-content: center !important;

        min-width: 42px;
        height: 42px;

        padding: 0 12px !important;

        border: 1px solid #e2e8f0 !important;
        border-radius: 11px !important;

        background: #ffffff !important;
        color: #334155 !important;

        font-size: 14px;
        font-weight: 600;

        line-height: 1 !important;

        text-decoration: none !important;

        box-shadow: 0 3px 10px rgba(15, 23, 42, .05);

        transition:
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }

    /*
     * Hover
     */
    .article-pagination
    .page-item:not(.active):not(.disabled)
    .page-link:hover {
        background: #eef2ff !important;

        border-color: #c7d2fe !important;

        color: #4338ca !important;

        transform: translateY(-1px);
    }

    /*
     * Halaman aktif
     */
    .article-pagination
    .page-item.active
    .page-link {
        background: #4f46e5 !important;

        border-color: #4f46e5 !important;

        color: #ffffff !important;

        box-shadow: 0 6px 16px rgba(79, 70, 229, .22);
    }

    /*
     * Previous / Next disabled
     */
    .article-pagination
    .page-item.disabled
    .page-link {
        background: #f8fafc !important;

        border-color: #e2e8f0 !important;

        color: #cbd5e1 !important;

        cursor: default;

        box-shadow: none;
    }

    /*
     * Focus
     */
    .article-pagination
    .page-link:focus {
        outline: none;

        box-shadow: 0 0 0 3px rgba(79, 70, 229, .12);
    }

    /* =========================================================
       TABLET
       ========================================================= */

    @media (max-width: 992px) {
        .article-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 768px) {
        .article-list-wrap {
            padding: 30px 16px 40px;
        }

        .article-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .article-card {
            border-radius: 20px;
            padding: 16px;
        }

        .article-card-image {
            height: 220px;
        }

        .article-card h3 {
            font-size: 20px;
            min-height: auto;
        }

        .article-card p {
            min-height: auto;
        }
    }

    /* =========================================================
       SMALL MOBILE PAGINATION
       ========================================================= */

    @media (max-width: 576px) {
        .article-pagination {
            margin-top: 28px;
        }

        .article-pagination ul,
        .article-pagination .pagination {
            gap: 6px !important;
        }

        .article-pagination .page-link {
            min-width: 38px;
            height: 38px;

            padding: 0 9px !important;

            font-size: 13px;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>ARTIKEL KONSTRUKSI</h1>
    </div>
</div>

<div class="article-list-wrap">

    @if($artikels->count())

        <div class="article-grid">

            @foreach($artikels as $artikel)

                <article class="article-card">

                    <img
                        src="{{ media_url($artikel->foto, 'images/og-image1.png') }}"
                        alt="{{ $artikel->judul }}"
                        class="article-card-image"
                        loading="lazy"
                    >

                    <div class="article-card-body">

                        <div class="article-date">
                            <i class="far fa-calendar-alt"></i>

                            <span>
                                {{ optional($artikel->published_at)->translatedFormat('d F Y') ?: '-' }}
                            </span>
                        </div>

                        <h3>
                            {{ $artikel->judul }}
                        </h3>

                        <p>
                            {{
                                \Illuminate\Support\Str::limit(
                                    $artikel->ringkasan
                                        ?: strip_tags($artikel->isi_artikel),
                                    140
                                )
                            }}
                        </p>

                        <div class="article-card-footer">

                            <a
                                href="{{ url('/artikel-konstruksi/' . $artikel->slug) }}"
                                class="read-more-btn"
                            >
                                <i class="fas fa-book-reader"></i>

                                Baca selengkapnya
                            </a>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

        {{-- Pagination --}}
        @if($artikels->hasPages())

            <div class="article-pagination">

                {{
                    $artikels
                        ->onEachSide(1)
                        ->links('pagination::bootstrap-4')
                }}

            </div>

        @endif

    @else

        <div class="empty-state">
            Belum ada artikel yang dipublikasikan.
        </div>

    @endif

</div>
@endsection
