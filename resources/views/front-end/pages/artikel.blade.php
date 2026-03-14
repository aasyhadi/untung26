@extends('front-end.layouts.app')

@section('title', 'Artikel')

@section('content')
<style>
    .article-list-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .article-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .article-card {
        background: #fff;
        border-radius: 22px;
        padding: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
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

    .article-date {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 13px;
    }

    .article-card h3 {
        margin: 0 0 10px;
        font-size: 22px;
        line-height: 1.45;
        color: #0f172a;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 64px;
    }

    .article-card p {
        color: #475569;
        line-height: 1.8;
        margin: 0 0 18px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 86px;
    }

    .article-card-footer {
        margin-top: auto;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 10px 18px;
        border-radius: 12px;
        background: #4f46e5;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: .2s ease;
    }

    .read-more-btn:hover {
        background: #3730a3;
        color: #fff;
        text-decoration: none;
    }

    .empty-state {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        color: #475569;
    }

    .article-pagination {
        margin-top: 32px;
        display: flex;
        justify-content: center;
    }

    .article-pagination nav {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .article-pagination .pagination {
        gap: 8px;
        flex-wrap: wrap;
        margin: 0;
    }

    .article-pagination .page-item .page-link {
        min-width: 44px;
        height: 44px;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #0f172a;
        font-weight: 600;
        background: #fff;
        box-shadow: none;
    }

    .article-pagination .page-item.active .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    .article-pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    .article-pagination .page-link:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #4338ca;
    }

    @media (max-width: 768px) {
        .article-card h3 {
            font-size: 20px;
            min-height: auto;
        }

        .article-card p {
            min-height: auto;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>ARTIKEL</h1>
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
                    >

                    <div class="article-card-body">
                        <div class="article-date">
                            {{ optional($artikel->published_at)->translatedFormat('d F Y') ?: '-' }}
                        </div>

                        <h3>{{ $artikel->judul }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit($artikel->ringkasan ?: strip_tags($artikel->isi_artikel), 140) }}
                        </p>

                        <div class="article-card-footer">
                            <a href="{{ url('/artikel/' . $artikel->slug) }}" class="read-more-btn">
                                Baca selengkapnya
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="article-pagination">
            {{ $artikels->onEachSide(1)->links() }}
        </div>
    @else
        <div class="empty-state">
            Belum ada artikel yang dipublikasikan.
        </div>
    @endif
</div>
@endsection
