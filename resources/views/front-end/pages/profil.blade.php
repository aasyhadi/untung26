@extends('front-end.layouts.app')
@section('title', 'Beranda - Profil Profesional')

@section('content')
<!-- Sub Hero Section -->
<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>PROFIL PROFESIONAL</h1>
    </div>
</div>

<div class="container">
    <img style="width: 350px;" src="/images/pak-untung.jpg" alt="Foto Profil">
    <h2 style="margin-top: -15px">Ir. H. Untung Yasril, S.T., M.T. CPSp, CCMS</h2>
    <p style="text-align: center; margin-top: -10px">Ahli Pengadaan Jasa Konstruksi</p><br>
    <h2>II. Pengalaman Kerja</h2>
    <table>
        <tr>
            <th style="text-align: center;">No.</th>
            <th>Uraian</th>
            <th>Keterangan</th>
        </tr>
        <tr><td style="text-align: center;">1</td><td>Staf Teknik</td><td>1997 - 2001</td></tr>
        <tr><td style="text-align: center;">2</td><td>Panitia Lelang/Pokja</td><td>2001 - 2017</td></tr>
        <tr><td style="text-align: center;">3</td><td>Pengawas Lapangan</td><td>1998 - 2000</td></tr>
        <tr><td style="text-align: center;">4</td><td>Asisten Teknik</td><td>2000 - 2001</td></tr>
        <tr><td style="text-align: center;">5</td><td>Pemimpin Proyek</td><td>2001 - 2004</td></tr>
        <tr><td style="text-align: center;">6</td><td>Kepala Seksi</td><td>2001 - 2010</td></tr>
        <tr><td style="text-align: center;">7</td><td>Sekretaris Dinas</td><td>2010 - 2012</td></tr>
        <tr><td style="text-align: center;">8</td><td>Kepala Dinas PU Kabupaten</td><td>2012 - 2014</td></tr>
        <tr><td style="text-align: center;">9</td><td>Kepala Balai P2JK</td><td>2019 - 2020</td></tr>
        <tr><td style="text-align: center;">10</td><td>Instruktur/Narasumber</td><td>2013 - Sekarang</td></tr>
        <tr><td style="text-align: center;">11</td><td>Asesor</td><td>2023 - Sekarang</td></tr>
        <tr><td style="text-align: center;">12</td><td>Penilai Ahli/Saksi Ahli Konstruksi</td><td>2008 - Sekarang</td></tr>
        <tr><td style="text-align: center;">13</td><td>Fasilitator PBJ LKPP</td><td>2018 - 2023</td></tr>
        <tr><td style="text-align: center;">14</td><td>Advisor PBJ LKPP</td><td>2020 - Sekarang</td></tr>
    </table>

    <h2>III. Sertifikat Kompetensi Kerja</h2>
    <table>
        <tr>
            <th style="text-align: center;">No.</th>
            <th>Uraian</th>
            <th>Keterangan</th>
            <th>Sertifikat</th>
        </tr>
        <tr><td style="text-align: center;">1</td><td>Ahli Utama K3 Konstruksi</td><td>2023 - 2028</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat1.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">2</td><td>Ahli Utama Teknik Bangunan Gedung</td><td>2023 - 2028</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat2.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">3</td><td>Ahli Utama Teknik Jalan</td><td>2023 - 2028</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat3.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">4</td><td>Ahli Utama Sumber Daya Air</td><td>2024 - 2029</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat4.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">5</td><td>Ahli Utama Jembatan</td><td>2025 - 2020</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat5.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">6</td><td>Ahli Procurement Specialist</td><td>2022 - 2025</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat6.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">7</td><td>Ahli Contract Management Specialist</td><td>2022 - 2025</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat7.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">8</td><td>Master Instruktur</td><td>2023 - 2026</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat8.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">9</td><td>Asesor Kompetensi</td><td>2023 - 2026</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat9.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">10</td><td>Penilai Ahli Kegagalan Bangunan</td><td>2022 - 2027</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat10.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">11</td><td>Fasilitator PBJ LKPP</td><td>2018 - 2023</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat11.png">Lihat Dok</a></td></tr>
        <tr><td style="text-align: center;">12</td><td>Sertifikat Tanda Registrasi Insinyur</td><td>2022 - 2025</td>
            <td><a href="#" class="lihat-dok" data-img="sertifikat12.png">Lihat Dok</a></td></tr>
    </table>
</div>

<section id="portofolio" class="content">
<h2 class="section-title">IV. PORTOFOLIO</h2>
    <div class="portofolio-container">
        <div class="portofolio-item portofolio-main">
            <img src="{{ asset('images/portofolio/main.jpeg') }}" alt="Portofolio Konsultasi">
        </div>
        <div class="portofolio-item portofolio-side">
            <img src="{{ asset('images/portofolio/side1.jpeg') }}" alt="Portofolio Pendampingan">
            <img src="{{ asset('images/portofolio/side2.jpeg') }}" alt="Portofolio Saksi">
        </div>
        <div class="portofolio-item">
            <p>(1) Bimbingan Teknis Pengadaan Jasa Konstruksi Bagi Karyawan BUMN WIKA di Bogor Tahun 2024. (2) Melayani Konsultasi Dgn Kunjungan ke Lapangan. (3) Sebagai Saksi Ahli Untuk Kejaksaan Memeriksa Bangunan Gedung pada Tahun 2023. </p>
        </div>

        <div class="portofolio-item portofolio-side">
            <img src="{{ asset('images/portofolio/side3.jpeg') }}" alt="Portofolio Sertifikasi">
            <img src="{{ asset('images/portofolio/side4.jpeg') }}" alt="Portofolio Sertifikasi">
        </div>
        <div class="portofolio-item portofolio-main">
            <img src="{{ asset('images/portofolio/main2.jpg') }}" alt="Portofolio Sertifikasi">
        </div>
        <div class="portofolio-item">
            <p>Acara Sertifikasi Tenaga Kerja Konstruksi di Dinas PUPR Muaro Jambi Tahun 2023.</p>
        </div>

        <div class="portofolio-item portofolio-main">
            <img src="{{ asset('images/portofolio/main3.jpg') }}" alt="Portofolio narasumber">
        </div>
        <div class="portofolio-item portofolio-side">
            <img src="{{ asset('images/portofolio/side5.jpg') }}" alt="Portofolio narasumber">
            <img src="{{ asset('images/portofolio/side6.jpg') }}" alt="Portofolio narasumber">
        </div>
        <div class="portofolio-item">
            <p>Bimtek Pengendalian Kontrak di Palangkaraya Tahun 2024. Sebagai Narasumber di acara Bimtek.</p>
        </div>
    </div>
</section>

@endsection

@section('modal')
<!-- Modal untuk menampilkan sertifikat -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" style="top: -35px; right: -25px; font-size: 40px; color: red">&times;</span>
        <img id="sertifikatImage" src="" alt="Sertifikat">
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    let modal = document.getElementById("modal");
    let modalImg = document.getElementById("sertifikatImage");
    let closeModal = document.querySelector(".close");

    document.querySelectorAll(".lihat-dok").forEach(button => {
        button.addEventListener("click", function() {
            let imgSrc = this.getAttribute("data-img");
            modalImg.src = "img/" + imgSrc; // Sesuaikan folder gambar
            modal.style.display = "flex";
        });
    });

    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>
@endsection
