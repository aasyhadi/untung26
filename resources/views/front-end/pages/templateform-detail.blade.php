@extends('front-end.layouts.app')
@section('title', 'Beranda - Form Template Detail')

@php
    use App\Template;
    $uuid = request()->route('uuid');
    $template = Template::where('uuid', $uuid)->firstOrFail(); // Jika tidak ditemukan, tampilkan 404
    $templaterandom = Template::inRandomOrder()->limit(3)->get();
@endphp

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>DETAIL FORM</h1>
        <a href="{{ url('/layanan/karya-tulis/form/') }}" class="btn-back">Back</a>
    </div>
</div>

<!-- Container Utama -->
<div class="container">
    <h2>{{ $template->nama_template }}</h2>
    <div class="book-detail">
        <img style="width: 400px;" src="{{ media_url($template->cover, 'images/cover.png') }}" alt="{{ $template->judul }}"
            onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
        <div class="book-info">
            <p><strong>Type File:</strong> {{$template->type_file}}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($template->harga, 0, ',', '.') }} </p>
            <div class="btn-container">
                <a href="{{ $template->landing_page_link }}" class="btn beli" target="_blank">Beli Form Template</a>
            </div>
        </div>
    </div><br>

    <h3>Deskripsi:</h3>
    <p>{{ $template->deskripsi }}</p>

    <!-- Produk Karya Tulis Lainnya -->
    <div class="product-section">
        <h3>Produk Karya Tulis Lainnya</h3>
        <div class="product-list">
            @forelse($templaterandom as $item)
            <div class="product-item">
                <a href="/layanan/karya-tulis/form-detail/{{$item->uuid}}"><img src="{{ media_url($item->cover, 'images/cover.png') }}" alt="{{ $item->judul }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
                <p style="margin-top: 10px;">{{ $item->nama_template }}</p></a>
            </div>
            @empty
            <p>Tidak ada Template tersedia saat ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
