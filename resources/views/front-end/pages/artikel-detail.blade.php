@extends('front-end.layouts.app')

@section('title', $artikel->judul)

@section('content')
@php
    $currentUrl = urlencode(request()->fullUrl());
    $shareTitle = urlencode($artikel->judul);
    $shareText = urlencode($artikel->judul . ' - ' . strip_tags($artikel->ringkasan ?: ''));
@endphp

<style>
    .article-detail-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 30px;
    }

    .article-main,
    .article-sidebar-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
    }

    .article-meta {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 14px;
    }

    .article-featured-image {
        width: 100%;
        max-height: 460px;
        object-fit: cover;
        border-radius: 16px;
        display: block;
    }

    .article-caption {
        color: #64748b;
        font-size: 13px;
        margin-top: 10px;
    }

    .article-share {
        margin-top: 22px;
        padding: 18px 0 0;
        border-top: 1px solid #e2e8f0;
    }

    .article-share-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .article-share-links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 14px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #0f172a;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .share-btn:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #312e81;
        text-decoration: none;
    }

    .share-btn.copy-btn {
        font: inherit;
    }

    .article-content {
        margin-top: 22px;
        line-height: 1.9;
        color: #334155;
    }

    .article-content h2,
    .article-content h3 {
        margin-top: 1.6rem;
        margin-bottom: .8rem;
        color: #0f172a;
    }

    .article-content p {
        margin-bottom: 1rem;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 1.4rem;
        margin-bottom: 1rem;
    }

    .article-content blockquote {
        border-left: 4px solid #cbd5e1;
        padding-left: 1rem;
        color: #475569;
        margin: 1rem 0;
    }

    .article-content a {
        color: #2563eb;
        text-decoration: underline;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .article-sidebar-card h3 {
        margin-top: 0;
        margin-bottom: 18px;
        color: #0f172a;
    }

    .article-other-item {
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
    }

    .article-other-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: 0;
    }

    .article-other-item a {
        color: #0f172a;
        text-decoration: none;
        font-weight: 700;
        line-height: 1.6;
    }

    .article-other-item a:hover {
        color: #4338ca;
    }

    .article-other-date {
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    @media (max-width: 992px) {
        .article-detail-wrap {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>{{ $artikel->judul }}</h1>
    </div>
</div>

<div class="article-detail-wrap">
    <article class="article-main">
        <div class="article-meta">
            {{ optional($artikel->published_at)->translatedFormat('d F Y') ?: '-' }}
            •
            {{ $artikel->penulis ?: 'Admin' }}
            •
            <i class="far fa-eye"></i> {{ number_format($artikel->view_count ?? 0) }} kali dilihat
        </div>

        <img
            src="{{ media_url($artikel->foto, 'images/og-image1.png') }}"
            alt="{{ $artikel->judul }}"
            class="article-featured-image"
        >

        @if($artikel->teks_foto)
            <div class="article-caption">{{ $artikel->teks_foto }}</div>
        @endif

        <div class="article-share">
            <div class="article-share-title">Bagikan artikel ini</div>

            <div class="article-share-links">
                <a
                    class="share-btn"
                    href="https://wa.me/?text={{ $shareTitle }}%20{{ $currentUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>

                <a
                    class="share-btn"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>

                <a
                    class="share-btn"
                    href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $currentUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-twitter"></i>
                    X / Twitter
                </a>

                <a
                    class="share-btn"
                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-linkedin-in"></i>
                    LinkedIn
                </a>

                <button type="button" class="share-btn copy-btn" onclick="copyArticleLink()">
                    <i class="fas fa-link"></i>
                    Copy link
                </button>
            </div>
        </div>

        <div class="article-content">
            {!! $artikel->isi_artikel !!}
        </div>
    </article>

    <aside>
        <div class="article-sidebar-card">
            <h3>Artikel lain</h3>

            @forelse($artikels as $item)
                <div class="article-other-item">
                    <a href="{{ url('/artikel-konstruksi/' . $item->slug) }}">
                        {{ $item->judul }}
                    </a>
                    <div class="article-other-date">
                        {{ optional($item->published_at)->translatedFormat('d F Y') ?: '-' }}
                    </div>
                </div>
            @empty
                <p>Tidak ada artikel lain.</p>
            @endforelse
        </div>
    </aside>
</div>

<script>
    function copyArticleLink() {
        const url = window.location.href;

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(function () {
                alert('Link artikel berhasil disalin.');
            }).catch(function () {
                fallbackCopyText(url);
            });
        } else {
            fallbackCopyText(url);
        }
    }

    function fallbackCopyText(text) {
        const input = document.createElement('textarea');
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Link artikel berhasil disalin.');
    }
</script>
@endsection
