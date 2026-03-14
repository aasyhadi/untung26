@extends('front-end.layouts.app')
@section('title', 'Beranda - Layanan Konsultasi Konstruksi')

@section('content')
<div class="container" style="margin-bottom: 200px; text-align:center">
    <div class="container text-center">
        <h2>Konsultasi Berhasil Dikirim!</h2>
        <p>Terima kasih, konsultasi Anda telah dikirim. Jawaban konsul akan segera dikirim ke nomor whatsapp.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection
