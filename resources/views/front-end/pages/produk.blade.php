@extends('front-end.layouts.app')

@section('title', 'Produk')

@section('content')
<style>
    .product-list-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .product-card {
        background: #fff;
        border-radius: 22px;
        padding: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .12);
    }

    .product-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 16px;
        display: block;
        background: #eef2f7;
    }

    .product-card-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        padding-top: 14px;
    }

    .product-status {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 13px;
    }

    .product-card h3 {
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

    .product-card p {
        color: #475569;
        line-height: 1.8;
        margin: 0 0 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 86px;
    }

    .product-price {
        font-size: 24px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 18px;
    }

    .product-card-footer {
        margin-top: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .product-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 10px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: .2s ease;
    }

    .product-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .product-btn-primary:hover {
        background: #3730a3;
        color: #fff;
        text-decoration: none;
    }

    .product-btn-outline {
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #c7d2fe;
    }

    .product-btn-outline:hover {
        background: #4338ca;
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

    .product-pagination {
        margin-top: 32px;
        display: flex;
        justify-content: center;
    }

    .product-pagination nav {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .product-pagination .pagination {
        gap: 8px;
        flex-wrap: wrap;
        margin: 0;
    }

    .product-pagination .page-item .page-link {
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

    .product-pagination .page-item.active .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    .product-pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    .product-pagination .page-link:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #4338ca;
    }

    @media (max-width: 768px) {
        .product-card h3 {
            font-size: 20px;
            min-height: auto;
        }

        .product-card p {
            min-height: auto;
        }

        .product-card-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .product-btn {
            width: 100%;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>PRODUK</h1>
    </div>
</div>

<div class="product-list-wrap">
    @if($produks->count())
        <div class="product-grid">
            @foreach($produks as $produk)
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $produk->order_wa ?: site_setting('whatsapp_number'));
                    $waText = rawurlencode('Halo, saya tertarik dengan produk: ' . $produk->judul);
                @endphp

                <article class="product-card">
                    <img
                        src="{{ media_url($produk->foto, 'images/og-image1.png') }}"
                        alt="{{ $produk->judul }}"
                        class="product-card-image"
                    >

                    <div class="product-card-body">
                        <div class="product-status">
                            {{ $produk->status === 'publish' ? 'Tersedia' : 'Draft' }}
                        </div>

                        <h3>{{ $produk->judul }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit($produk->ringkasan ?: strip_tags($produk->ulasan), 140) }}
                        </p>

                        <div class="product-price">
                            Rp {{ number_format((int) $produk->harga, 0, ',', '.') }}
                        </div>

                        <div class="product-card-footer">
                            <a href="{{ url('/produk/' . $produk->slug) }}" class="product-btn product-btn-outline">
                                Lihat detail
                            </a>

                            @if($waNumber)
                                <a
                                    href="https://wa.me/{{ $waNumber }}?text={{ $waText }}"
                                    target="_blank"
                                    class="product-btn product-btn-primary"
                                >
                                    Order via WA
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="product-pagination">
            {{ $produks->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="empty-state">
            Belum ada produk yang dipublikasikan.
        </div>
    @endif
</div>
@endsection
