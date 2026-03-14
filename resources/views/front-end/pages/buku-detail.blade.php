@extends('front-end.layouts.app')
@section('title', 'Detail Buku - Buku Teknik dan Manajemen Konstruksi')

@php
    use App\Buku;
    $uuid = request()->route('uuid');
    $buku = Buku::where('uuid', $uuid)->firstOrFail(); // Jika tidak ditemukan, tampilkan 404
    $bukurandom = Buku::inRandomOrder()->limit(3)->get();
@endphp

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>DETAIL BUKU</h1>
        <a href="{{ url('/layanan/karya-tulis/buku/') }}" class="btn-back">Back</a>
    </div>
</div>

<!-- Container Utama -->
<div class="container">
    <h2>{{ $buku->judul }}</h2>
    <div class="book-detail">
        <img style="width: 400px;" src="{{ media_url($buku->cover, 'images/cover.png') }}" alt="{{ $buku->judul }}"
            onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
        <div class="book-info">
            <p><strong>Penulis:</strong> {{ $buku->penulis }} </p>
            <p><strong>Penerbit:</strong> {{ $buku->penerbit }} </p>
            <p><strong>ISBN:</strong> {{ $buku->isbn }} </p>
            <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }} </p>
            <div class="btn-container" style="display: flex; gap: 15px; text-align:center; margin-top:10px">
                <a href="{{ $buku->landing_page_link }}" class="btn beli" target="_blank" hover="color: #ffcc00;">Beli eBook <br> Rp {{ number_format($buku->harga_ebook, 0, ',', '.') }}</a>
                <a href="#" class="btn beli" target="_blank">Beli Buku <br> Rp {{ number_format($buku->harga, 0, ',', '.') }}</a>
            </div>
        </div>
    </div><br>

    <h3>Deskripsi:</h3>
    <p>{{ $buku->deskripsi }}</p>

    <!-- Produk Karya Tulis Lainnya -->
    <div class="product-section">
        <h3>Produk Karya Tulis Lainnya</h3>
        <div class="product-list">
            @forelse($bukurandom as $item)
            <div class="product-item">
                <a href="/layanan/karya-tulis/buku-detail/{{$item->uuid}}"><img src="{{ media_url($item->cover, 'images/cover.png') }}" alt="{{ $item->judul }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
                <p style="margin-top: 10px;">{{ $item->judul }}</p></a>
            </div>
            @empty
            <p>Tidak ada buku tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
