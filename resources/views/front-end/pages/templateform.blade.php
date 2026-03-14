@extends('front-end.layouts.app')
@section('title', 'Beranda - Form Template')

@php
    use App\Template;
    $template = Template::all();
@endphp

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>FORM TEMPLATE</h1>
    </div>
</div>

<div class="container">
    @forelse($template as $item)
    <div class="book-item">
        <img src="{{ media_url($item->cover, 'images/cover.png') }}" alt="{{ $item->nama_template }}"
            onerror="this.onerror=null;this.src='{{ asset('images/cover.png') }}';">
        <div class="book-info">
            <h4>{{ $item->nama_template}}</h4>
            <p>Harga: Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
            <a href="/layanan/karya-tulis/form-detail/{{$item->uuid}}" >Lihat Detail</a>
        </div>
    </div>
    @empty
    <p>Tidak ada template tersedia saat ini.</p>
    @endforelse

    <div class="category-section">
        <h3>Jenis Produk Karya Tulis Lainnya</h3><br>
        <div class="sertifikasi-container">
            <div class="sertifikasi-box2">
            <a href="/layanan/karya-tulis/buku"><p>Buku Teknik & Manajemen Konstruksi</p></a>
            </div>
            <div class="sertifikasi-box2">
            <a href="/layanan/karya-tulis/form"><p>Form Pengadaan Jasa Konstruksi</p></a>
            </div>
            <div class="sertifikasi-box2">
            <a href="/layanan/karya-tulis/ppt"><p>Materi Presentasi & Modul Pelatihan Konstruksi</p></a>
            </div>
        </div><br>
    </div>
</div>
@endsection
