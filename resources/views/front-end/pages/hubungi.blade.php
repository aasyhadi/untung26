@extends('front-end.layouts.app')
@section('title', 'Beranda - Hubungi Kami')

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>HUBUNGI KAMI</h1>
    </div>
</div>

<div class="container">
        <h2>Kami Siap Membantu Anda!</h2>
        <p>Apakah Anda membutuhkan konsultasi profesional di bidang konstruksi? Kami siap memberikan solusi terbaik untuk proyek Anda, mulai dari perencanaan hingga pengawasan. Hubungi kami untuk diskusi lebih lanjut!</p><br>
        <div class="info-container">
            <div class="info-box">
                <h2>Informasi Kontak</h2>
                <p>📍 Alamat: </p>
                <p style="margin-bottom: 10px;">Komplek Puri Mayang Cluster Cassablanca Blok A No. 50, Kelurahan Mayang Mangurai, Kecamatan Alam Barajo, Kota Jambi.</p>

                <p>⏰ Jam Operasional: </p>
                <p>Senin - Jumat: 08.00 - 17.00 WIB</p>
                <p style="margin-bottom: 10px;">Sabtu: 09.00 - 14.00 WIB</p>

                <p>Email: untunguy29@gmail.com</p>
                <p>Web: www.untungyasril.com</p>

            </div>
            <div class="info-box">
                <h2>Lokasi Kami</h2>
                <div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.092744058258!2d103.57628598840421!3d-1.639255555417649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2587dab7462311%3A0x2857cda3ebe2ce82!2sCluster%20Casablanca%2C%20Puri%20Mayang%20blok%20i%20no%2010!5e0!3m2!1sid!2sid!4v1741338764957!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div><br>
        <div class="contact-form">
            <p>Formulir Kontak</p>
            <form>
                <input type="text" placeholder="Nama">
                <input type="email" placeholder="Email">
                <input type="text" placeholder="Subjek">
                <textarea placeholder="Pesan"></textarea>
                <button type="submit">Kirim Pesan</button>
            </form>
        </div>
    </div>


@endsection
