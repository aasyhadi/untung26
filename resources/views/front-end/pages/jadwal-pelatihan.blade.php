@extends('front-end.layouts.app')

@section('title', 'Jadwal Layanan & Pelatihan')

@section('content')
@php
    $metodeLabels = [
        4 => 'Online',
        5 => 'Offline',
        6 => 'Hybrid',
    ];
@endphp

<style>
    .schedule-page-wrap {
        max-width: 1180px;
        margin: 0 auto;
        padding: 40px 20px 60px;
    }

    .schedule-page-intro {
        margin-bottom: 28px;
    }

    .schedule-page-intro h2 {
        margin: 0 0 8px;
        font-size: 30px;
        line-height: 1.3;
        font-weight: 700;
        color: #0f172a;
    }

    .schedule-page-intro p {
        margin: 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.7;
        max-width: 760px;
    }

    .schedule-page-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .schedule-page-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 18px;

        display: grid;
        grid-template-columns: 180px minmax(0, 1fr);
        gap: 20px;

        box-shadow: 0 10px 30px rgba(15, 23, 42, .07);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .schedule-page-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .11);
    }

    .schedule-page-cover-wrap {
        width: 100%;
        height: 270px;

        padding: 8px;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        border-radius: 16px;

        background: #f8fafc;
    }

    .schedule-page-cover {
        width: 100%;
        height: 100%;

        object-fit: contain;

        display: block;
    }

    .schedule-page-body {
        min-width: 0;

        display: flex;
        flex-direction: column;
    }

    .schedule-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;

        margin-bottom: 12px;
    }

    .schedule-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        width: fit-content;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 11px;
        font-weight: 700;
    }

    .schedule-badge-open {
        background: #dcfce7;
        color: #166534;
    }

    .schedule-badge-close {
        background: #fef3c7;
        color: #92400e;
    }

    .schedule-badge-method {
        background: #eef2ff;
        color: #4338ca;
    }

    .schedule-page-title {
        margin: 0 0 14px;

        font-size: 20px;
        line-height: 1.45;
        font-weight: 700;

        color: #0f172a;
    }

    .schedule-page-info {
        list-style: none;

        margin: 0;
        padding: 0;

        display: grid;
        gap: 9px;
    }

    .schedule-page-info li {
        display: flex;
        align-items: flex-start;
        gap: 9px;

        color: #475569;

        font-size: 13px;
        line-height: 1.65;
    }

    .schedule-page-info i {
        width: 16px;

        flex: 0 0 16px;

        margin-top: 4px;

        color: #4f46e5;
    }

    .schedule-page-info strong {
        color: #0f172a;
        font-weight: 700;
    }

    .schedule-page-action {
        margin-top: auto;
        padding-top: 18px;
    }

    .schedule-register-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-height: 42px;

        padding: 10px 16px;

        border-radius: 11px;

        background: #4f46e5;
        color: #ffffff;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        transition: .2s ease;
    }

    .schedule-register-btn:hover {
        background: #3730a3;
        color: #ffffff;
        text-decoration: none;
    }

    .schedule-empty {
        padding: 24px;

        background: #ffffff;

        border-radius: 20px;

        color: #64748b;

        box-shadow: 0 10px 30px rgba(15, 23, 42, .07);
    }

    /* Pagination */

    .schedule-pagination {
        width: 100%;

        margin-top: 38px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .schedule-pagination nav {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .schedule-pagination ul,
    .schedule-pagination .pagination {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;

        flex-wrap: wrap !important;

        gap: 8px !important;

        list-style: none !important;

        padding: 0 !important;
        margin: 0 !important;
    }

    .schedule-pagination li,
    .schedule-pagination .page-item {
        list-style: none !important;

        padding: 0 !important;
        margin: 0 !important;
    }

    .schedule-pagination li::before,
    .schedule-pagination li::after {
        display: none !important;
        content: none !important;
    }

    .schedule-pagination .page-link {
        min-width: 42px;
        height: 42px;

        padding: 0 12px !important;

        display: inline-flex !important;
        align-items: center;
        justify-content: center;

        border: 1px solid #e2e8f0 !important;
        border-radius: 11px !important;

        background: #ffffff !important;
        color: #334155 !important;

        text-decoration: none !important;

        font-size: 14px;
        font-weight: 600;
    }

    .schedule-pagination .page-item.active .page-link {
        background: #4f46e5 !important;
        border-color: #4f46e5 !important;
        color: #ffffff !important;
    }

    .schedule-pagination .page-item.disabled .page-link {
        color: #cbd5e1 !important;
        background: #f8fafc !important;
    }

    @media (max-width: 992px) {
        .schedule-page-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .schedule-page-wrap {
            padding: 30px 16px 45px;
        }

        .schedule-page-card {
            grid-template-columns: 1fr;
        }

        .schedule-page-cover-wrap {
            height: 350px;
        }

        .schedule-page-title {
            font-size: 19px;
        }
    }
</style>

<div class="sub-hero">
    <div class="sub-hero-container">
        <h1>JADWAL LAYANAN & PELATIHAN</h1>
    </div>
</div>

<div class="schedule-page-wrap">

    <div class="schedule-page-intro">
        <h2>Agenda Pelatihan Terbaru</h2>
        <p>
            Temukan informasi pelatihan, seminar, webinar, serta kegiatan
            pengembangan kompetensi di bidang jasa konstruksi.
        </p>
    </div>

    @if($jadwalPelatihan->count())

        <div class="schedule-page-grid">

            @foreach($jadwalPelatihan as $jadwal)

                <article class="schedule-page-card">

                    <div class="schedule-page-cover-wrap">
                        <img
                            src="{{ media_url($jadwal->cover, 'images/og-image1.png') }}"
                            alt="{{ $jadwal->nama_pelatihan }}"
                            class="schedule-page-cover"
                            loading="lazy"
                        >
                    </div>

                    <div class="schedule-page-body">

                        <div class="schedule-badges">

                            @if($jadwal->tanggal && $jadwal->tanggal >= now()->format('Y-m-d'))

                                <span class="schedule-badge schedule-badge-open">
                                    <i class="fas fa-check-circle"></i>
                                    BUKA
                                </span>

                            @else

                                <span class="schedule-badge schedule-badge-close">
                                    <i class="fas fa-clock"></i>
                                    TUTUP
                                </span>

                            @endif

                            <span class="schedule-badge schedule-badge-method">
                                <i class="fas fa-laptop"></i>
                                {{ $metodeLabels[$jadwal->metode] ?? '-' }}
                            </span>

                        </div>

                        <h3 class="schedule-page-title">
                            {{ $jadwal->nama_pelatihan }}
                        </h3>

                        <ul class="schedule-page-info">

                            @if($jadwal->deskripsi)
                                <li>
                                    <i class="fas fa-book-open"></i>

                                    <span>
                                        <strong>Tema:</strong>
                                        {{ \Illuminate\Support\Str::limit(strip_tags($jadwal->deskripsi), 140) }}
                                    </span>
                                </li>
                            @endif

                            <li>
                                <i class="far fa-calendar-alt"></i>

                                <span>
                                    <strong>Tanggal:</strong>

                                    {{
                                        $jadwal->tanggal
                                            ? \Carbon\Carbon::parse($jadwal->tanggal)
                                                ->translatedFormat('d F Y')
                                            : '-'
                                    }}
                                </span>
                            </li>

                            <li>
                                <i class="fas fa-user-tie"></i>

                                <span>
                                    <strong>Narasumber:</strong>
                                    {{ $jadwal->narasumber ?: '-' }}
                                </span>
                            </li>

                            <li>
                                <i class="fas fa-map-marker-alt"></i>

                                <span>
                                    <strong>Lokasi:</strong>
                                    {{ $jadwal->lokasi ?: '-' }}
                                </span>
                            </li>

                        </ul>

                        @if($jadwal->link_pendaftaran)

                            <div class="schedule-page-action">

                                <a
                                    href="{{ $jadwal->link_pendaftaran }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="schedule-register-btn"
                                >
                                    <i class="fas fa-arrow-right"></i>
                                    Daftar sekarang
                                </a>

                            </div>

                        @endif

                    </div>

                </article>

            @endforeach

        </div>

        @if($jadwalPelatihan->hasPages())

            <div class="schedule-pagination">

                {{
                    $jadwalPelatihan
                        ->onEachSide(1)
                        ->links('pagination::bootstrap-4')
                }}

            </div>

        @endif

    @else

        <div class="schedule-empty">
            Belum ada jadwal layanan atau pelatihan yang tersedia.
        </div>

    @endif

</div>
@endsection
