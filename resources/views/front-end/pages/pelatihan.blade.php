@extends('front-end.layouts.app')
@section('title', 'Beranda - Pelatihan Konstruksi')

@php
    use App\JadwalPelatihan;
    $jadwalPelatihan = JadwalPelatihan::orderBy('id', 'desc')->limit(2)->get();
@endphp

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>PELATIHAN KONSTRUKSI</h1>
    </div>
</div>

<div class="container">
    <h2>Tingkatkan Keahlian Anda di Bidang Konstruksi!</h2>
        <p style="margin-bottom: 10px;">Industri konstruksi terus berkembang dengan teknologi dan regulasi baru. Untuk tetap kompetitif, tenaga kerja dan profesional konstruksi perlu meningkatkan sumber daya manusia meliputi keterampilan, keahlian dan pengetahuan melalui pelatihan yang tepat.</p>
        <p>Kami menyediakan program pelatihan konstruksi yang dirancang untuk memenuhi kebutuhan industri dan standar nasional antara lain: pendidikan dan pelatihan (5 - 7 hari), bimbingan teknis (1 - 4 hari), seminar / webinar (1-2 hari).</p>

    <h2>Mengapa Mengikuti Pelatihan Kami?</h2>
        <div class="sertifikasi-container">
            <div class="sertifikasi-box3">
                <p style="text-align: left;">Narasumber / Instruktur Berpengalaman & Bersertifikat Kompetensi Kerja BNSP, Praktisi dan Akademisi.</p>
            </div>
            <div class="sertifikasi-box3">
                <p style="text-align: left;">Kurikulum Berstandar Nasional (SKKNI) – Materi pelatihan disusun sesuai dengan regulasi Kementerian PUPR dan kebutuhan industri.</p>
            </div>
            <div class="sertifikasi-box3">
                <p style="text-align: left;">Metode Pembelajaran Praktis – Kombinasi teori dan praktik langsung di lapangan untuk meningkatkan pemahaman, keahlian dan keterampilan baik online dan offline.</p>
            </div>
            <div class="sertifikasi-box3">
                <p style="text-align: left;">Sertifikat Resmi – Peserta akan mendapatkan sertifikat pelatihan sebagai bukti kompetensi yang diakui oleh industri.</p>
            </div>
            <div class="sertifikasi-box3">
                <p style="text-align: left;">Peserta akan mendapatkan sertifikat sebagai bukti kompetensi yang diakui oleh pemerintah dan menambah angka Pengembangan Keprofesioanl Berkelanjutan (PKB) LPJK-PU.</p>
            </div>
        </div><br>

    <h2>Pelatihan On Progres</h2>
    <div class="jadwal-container">
        @forelse($jadwalPelatihan as $jadwal)
        <div class="jadwal-item">
            <div class="jadwal-header">{{ $jadwal->nama_pelatihan }}</div>
            <div class="jadwal-body">
                @if($jadwal->tanggal >= today())
                    <p class="highlight-buka"><strong>BUKA</strong></p>
                @else
                    <p class="highlight-tutup"><strong>TUTUP</strong></p>
                @endif
                <table class="jadwal-table">
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>
                            {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Durasi</strong></td>
                        <td>{{ $jadwal->durasi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Narasumber</strong></td>
                        <td>{{ $jadwal->narasumber ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Biaya Rp.</strong></td>
                        <td>{{ number_format($jadwal->biaya, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>{{ $jadwal->lokasi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Metode</strong></td>
                        @if($jadwal->metode == 4)
                            <td>Online</td>
                        @elseif($jadwal->metode == 5)
                            <td>Offline</td>
                        @elseif($jadwal->metode == 6)
                            <td>Hybrid</td>
                        @endif
                    </tr>
                </table>
            </div>
        </div><br>
        @empty
        <p>Tidak ada jadwal pelatihan tersedia saat ini.</p>
        @endforelse
    </div><br>

    <h2>Program Pelatihan yang Tersedia</h2>
        <p>✅ Manajemen Proyek Konstruksi</p>
        <p>✅ Keselamatan dan Kesehatan Kerja (K3) Konstruksi</p>
        <p>✅ Manajemen Mutu Konstruksi</p>
        <p>✅ Penggunaan Teknologi BIM (Building Information Modeling)</p>
        <p>✅ Perhitungan Struktur dan Estimasi Biaya</p>
        <p>✅ Manajemen Kontrak Konstruksi</p>
        <p>✅ Konstruksi Bangunan Gedung </p>
        <p>✅ Konstruksi Jalan dan Jembatan</p>
        <p>✅ Konstruksi Sumber Daya Air (Sungai, Bendungan, Rawa, Irigasi, dan Air Tanah)</p>
        <p>✅ Konstruksi Sistem Pengolahan Air Minum (SPAM)</p>
        <p>✅ Konstruksi IPAL (Instalasi Pengolahan Air Limbah)</p>
        <p>✅ Perencanaan Jasa Konstruksi</p>
        <p>✅ Pelaksanaan Jasa Konstruksi</p>
        <p>✅ Pemilihan Penyedia Jasa Konstruksi</p>
        <p>✅ Prosedur Serah Terima Pekerjaan Jasa Konstruksi</p>
        <p style="margin-bottom: 10px;">✅ Kegagalan Bangunan</p>
        <p>Kami juga menyediakan pelatihan yang dapat disesuaikan dengan kebutuhan perusahaan atau proyek tertentu.</p>

    <h2>Daftar Sekarang!</h2>
        <p style="margin-bottom: 10px;">Jangan lewatkan kesempatan untuk meningkatkan keterampilan dan sertifikasi resmi.</p>
        <p>untunguy29@gmail.com</p>
        <p style="margin-bottom: 10px;">www.untungyasril.com</p>
        <p>Siap menjadi tenaga konstruksi profesional yang lebih kompeten? Ikuti pelatihannya sekarang!</p>

</div>
@endsection
