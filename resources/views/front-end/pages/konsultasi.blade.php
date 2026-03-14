@extends('front-end.layouts.app')
@section('title', 'Layanan Konsultasi Konstruksi')

@section('content')
<div class="sub-hero"><div class="sub-hero-container"><h1>LAYANAN KONSULTASI</h1></div></div>
<div class="container">
    <h2>Mengapa Memilih Konsultasi Kepada Kami?</h2>
    <p style="margin-bottom: 10px;">Kami adalah ahli yang profesional dan terpercaya, berpengalaman selama 27 tahun di bidang konstruksi dan bersertifikat kompetensi BNSP. Kami menawarkan pelayanan konsultasi untuk memastikan proyek Anda berjalan dengan lancar, efisien, dan sesuai prosedur.</p>
    <p>Kami siap membantu Anda dalam berbagai aspek tahapan pengadaan jasa konstruksi meliputi:</p>
    <img src="/images/tahapanoke.jpg" alt="Tahapan Pengadaan Jasa Konstruksi" class="consult-image">
    <br><br>

    <h2>Keuntungan Menggunakan Layanan Kami</h2>
    <div class="benefits">
        <ul>
            <li><i class="fas fa-check-circle"></i> Konsultasi langsung dengan tenaga ahli berpengalaman dan bersertifikat kompetensi BNSP.</li>
            <li><i class="fas fa-check-circle"></i> Solusi yang disesuaikan dengan kebutuhan.</li>
            <li><i class="fas fa-check-circle"></i> Efisiensi biaya dan waktu pengerjaan.</li>
            <li><i class="fas fa-check-circle"></i> Solusi berdasarkan referensi hukum pemerintah di bidang jasa konstruksi.</li>
        </ul>
    </div>

    <h2>Metode Konsultasi</h2>
    <div class="consult-methods">
        <p>✅ &nbsp;Konsultasi via Zoom dan Tatap Muka (atur waktu melalui email: <b>untunguy29@gmail.com</b>)</p>
        <p>✅ &nbsp;Konsultasi langsung via WhatsApp (klik tombol di bawah)</p>
    </div>

    <a href="{{ wa_link(site_setting('whatsapp_number'), site_setting('whatsapp_default_message')) }}"
            target="_blank"
            class="btn-whatsapp">
            <i class="fab fa-whatsapp" style="margin-right:8px;"></i> Konsultasi Sekarang
    </a>
</div>
@endsection
