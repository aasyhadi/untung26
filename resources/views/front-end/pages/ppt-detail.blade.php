@extends('front-end.layouts.app')
@section('title', 'Beranda - Modul PPT Detail')

@php
    use App\ModulPpt;
    $uuid = request()->route('uuid');
    $modul = ModulPpt::where('uuid', $uuid)->firstOrFail(); // Jika tidak ditemukan, tampilkan 404
    $modulrandom = ModulPpt::inRandomOrder()->limit(3)->get();
@endphp

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>MODUL PPT DETAIL</h1>
        <a href="{{ url('/layanan/karya-tulis/ppt/') }}" class="btn-back">Back</a>
    </div>
</div>


<!-- Container Utama -->
<div class="container">
    <h2>{{ $modul->nama_modul }}</h2>
    <div class="book-detail">
        <img style="width: 400px;" src="{{ media_url($modul->cover, 'images/cover.png') }}" alt="{{ $modul->judul }}"
            onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
        <div class="book-info">
            <p><strong>Type File:</strong> {{$modul->type_file}}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($modul->harga, 0, ',', '.') }} </p>
            <div class="btn-container">
                <a href="{{ $modul->landing_page_link }}" class="btn beli" target="_blank">Beli Modul PPT</a>
            </div>
        </div>
    </div><br>

    <h3>Deskripsi:</h3>
    <p>{{ $modul->deskripsi }}</p>

    <!-- Produk Karya Tulis Lainnya -->
    <div class="product-section">
        <h3>Produk Karya Tulis Lainnya</h3>
        <div class="product-list">
            @forelse($modulrandom as $item)
            <div class="product-item">
                <a href="/layanan/karya-tulis/ppt-detail/{{$item->uuid}}"><img src="{{ media_url($item->cover, 'images/cover.png') }}" alt="{{ $item->judul }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
                <p style="margin-top: 10px;">{{ $item->nama_modul }}</p></a>
            </div>
            @empty
            <p>Tidak ada Modul tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
