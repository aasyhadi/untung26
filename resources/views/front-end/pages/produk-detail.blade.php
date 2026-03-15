@extends('front-end.layouts.app')

@section('title', $produk->judul)

@section('content')
@php
    $waLink = wa_link(
        $produk->nomor_wa_order ?: site_setting('whatsapp_number'),
        'Halo Pak Untung, saya ingin order produk: ' . $produk->judul
    );
@endphp

<style>
    .product-detail-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 30px;
    }

    .product-main,
    .product-sidebar-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
    }

    .product-main {
        padding: 28px;
    }

    .product-image-wrap {
        background: #f8fafc;
        border-radius: 18px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        max-height: 460px;
        object-fit: cover;
        display: block;
    }

    .product-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        margin-top: 20px;
        padding: 8px 14px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        font-size: 13px;
        font-weight: 700;
    }

    .product-price {
        font-size: 32px;
        font-weight: 800;
        line-height: 1.2;
        color: #0f172a;
        margin: 18px 0 16px;
    }

    .product-summary {
        font-size: 17px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 18px;
    }

    .product-content {
        line-height: 1.9;
        color: #334155;
        font-size: 16px;
    }

    .product-content p {
        margin-bottom: 1rem;
    }

    .product-actions {
        margin-top: 26px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn-wa-detail,
    .btn-back-product {
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

    .btn-wa-detail {
        background: #25D366;
        color: #fff;
    }

    .btn-wa-detail:hover {
        background: #1faa52;
        color: #fff;
        text-decoration: none;
    }

    .btn-back-product {
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #c7d2fe;
    }

    .btn-back-product:hover {
        background: #4338ca;
        color: #fff;
        text-decoration: none;
    }

    .product-sidebar {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .product-sidebar-card {
        padding: 22px;
    }

    .product-sidebar-card h3 {
        margin: 0 0 18px;
        color: #0f172a;
        font-size: 22px;
    }

    .product-other-item {
        display: grid;
        grid-template-columns: 78px 1fr;
        gap: 12px;
        align-items: start;
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
    }

    .product-other-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: 0;
    }

    .product-other-thumb {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        background: #eef2f7;
    }

    .product-other-title {
        display: block;
        color: #0f172a;
        font-weight: 700;
        line-height: 1.5;
        text-decoration: none;
        margin-bottom: 4px;
    }

    .product-other-title:hover {
        color: #4338ca;
        text-decoration: none;
    }

    .product-other-price {
        font-size: 14px;
        color: #64748b;
    }

    .product-empty {
        color: #475569;
        margin: 0;
    }

    @media (max-width: 992px) {
        .product-detail-wrap {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .product-main {
            padding: 20px;
        }

        .product-price {
            font-size: 28px;
        }

        .product-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-wa-detail,
        .btn-back-product {
            width: 100%;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>{{ $produk->judul }}</h1>
    </div>
</div>

<div class="product-detail-wrap">
    <article class="product-main">
        <div class="product-image-wrap">
            <img
                src="{{ media_url($produk->foto, 'images/og-image1.png') }}"
                alt="{{ $produk->judul }}"
                class="product-image"
            >
        </div>

        <div class="product-status">
            <i class="fas fa-check-circle"></i>
            {{ $produk->status === 'publish' ? 'Produk tersedia' : 'Produk draft' }}
        </div>

        <div class="product-price">
            Rp {{ number_format((float) $produk->harga, 0, ',', '.') }}
        </div>

        <div style="color:#64748b; font-size:14px; margin-bottom:14px;">
            <i class="far fa-eye"></i> {{ number_format($produk->view_count ?? 0) }} kali dilihat
        </div>

        <div class="product-content">
            {!! nl2br(e($produk->ulasan)) !!}
        </div>

        <div class="product-actions">
            <a href="{{ $waLink }}" target="_blank" class="btn-wa-detail">
                <i class="fab fa-whatsapp"></i>
                Order via WhatsApp
            </a>

            <a href="{{ url('/produk') }}" class="btn-back-product">
                <i class="fas fa-arrow-left"></i>
                Kembali ke produk
            </a>
        </div>
    </article>

    <aside class="product-sidebar">
        <div class="product-sidebar-card">
            <h3>Produk lain</h3>

            @forelse($produks as $item)
                <div class="product-other-item">
                    <img
                        src="{{ media_url($item->foto, 'images/og-image1.png') }}"
                        alt="{{ $item->judul }}"
                        class="product-other-thumb"
                    >

                    <div>
                        <a href="{{ url('/produk/' . $item->slug) }}" class="product-other-title">
                            {{ $item->judul }}
                        </a>
                        <div class="product-other-price">
                            Rp {{ number_format((float) $item->harga, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="product-empty">Tidak ada produk lain.</p>
            @endforelse
        </div>
    </aside>
</div>
@endsection
