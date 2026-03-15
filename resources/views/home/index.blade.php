@extends('layout')

@section('pagetitle')
Dashboard
@endsection

@section('content')
<style>
    .dashboard-wrap {
        padding-bottom: 12px;
    }

    .dashboard-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 22px;
        padding: 28px;
        color: #ffffff;
        margin-bottom: 24px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
    }

    .dashboard-hero h1 {
        margin: 0 0 8px;
        font-size: 30px;
        font-weight: 700;
        color: #ffffff;
    }

    .dashboard-hero p {
        margin: 0;
        color: #cbd5e1;
        max-width: 760px;
        line-height: 1.7;
    }

    .dashboard-hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .stat-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        height: 100%;
        background: #ffffff;
    }

    .stat-card .card-body {
        padding: 20px;
    }

    .stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 36px;
        line-height: 1;
        font-weight: 800;
        color: #0f172a;
    }

    .stat-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 700;
    }

    .chip-indigo {
        background: #eef2ff;
        color: #4338ca;
    }

    .chip-emerald {
        background: #ecfdf5;
        color: #047857;
    }

    .chip-amber {
        background: #fffbeb;
        color: #b45309;
    }

    .chip-sky {
        background: #eff6ff;
        color: #0369a1;
    }

    .stat-link {
        font-size: 13px;
        font-weight: 700;
        color: #4338ca;
        text-decoration: none;
    }

    .stat-link:hover {
        color: #312e81;
        text-decoration: underline;
    }

    .dashboard-card {
        border: 0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        height: 100%;
        background: #ffffff;
    }

    .dashboard-card .card-header {
        background: #ffffff;
        border-bottom: 1px solid #eef2f7;
        padding: 18px 20px;
        border-radius: 20px 20px 0 0 !important;
    }

    .dashboard-card .card-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .dashboard-card .card-body {
        padding: 20px;
        color: #334155;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .quick-action {
        display: block;
        padding: 16px 18px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #0f172a;
        text-decoration: none;
        transition: .2s ease;
    }

    .quick-action:hover {
        border-color: #c7d2fe;
        background: #f8faff;
        color: #312e81;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .quick-action-title {
        font-weight: 700;
        margin-bottom: 4px;
        color: #0f172a;
    }

    .quick-action-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
    }

    .info-list {
        display: grid;
        gap: 12px;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 14px;
        background: #f8fafc;
    }

    .info-key {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        min-width: 96px;
    }

    .info-value {
        text-align: right;
        color: #0f172a;
        font-weight: 600;
        word-break: break-word;
    }

    .feed-list {
        display: grid;
        gap: 14px;
    }

    .feed-item {
        padding-bottom: 14px;
        border-bottom: 1px solid #eef2f7;
    }

    .feed-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .feed-title {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
        line-height: 1.5;
    }

    .feed-meta {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 6px;
        line-height: 1.6;
    }

    .feed-desc {
        font-size: 14px;
        color: #475569;
        line-height: 1.7;
    }

    .empty-state {
        border-radius: 14px;
        padding: 16px;
        background: #f8fafc;
        color: #64748b;
        font-size: 14px;
    }

    .section-link {
        font-size: 13px;
        font-weight: 700;
        color: #4338ca;
        text-decoration: none;
    }

    .section-link:hover {
        color: #312e81;
        text-decoration: underline;
    }

    @media (max-width: 991.98px) {
        .quick-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrap">
    <div class="dashboard-hero">
        <h1>Dashboard Web</h1>
        <p>Ringkasan cepat aktivitas website, performa konten, dan lead konsultasi yang perlu ditindaklanjuti.</p>

        <div class="dashboard-hero-actions">
            <a href="{{ url('master-artikel') }}" class="btn btn-light btn-sm">Kelola Artikel</a>
            <a href="{{ url('master-produk') }}" class="btn btn-outline-light btn-sm">Kelola Produk</a>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-light btn-sm">Lihat Website Publik</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Artikel Publish</div>
                            <div class="stat-value">{{ $stats['artikel_publish'] }}</div>
                        </div>
                        <div class="stat-chip chip-indigo">ART</div>
                    </div>
                    <a href="{{ url('master-artikel') }}" class="stat-link">Kelola artikel</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Produk Publish</div>
                            <div class="stat-value">{{ $stats['produk_publish'] }}</div>
                        </div>
                        <div class="stat-chip chip-emerald">PRD</div>
                    </div>
                    <a href="{{ url('master-produk') }}" class="stat-link">Kelola produk</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Konsultasi Baru</div>
                            <div class="stat-value">{{ $stats['konsultasi_baru'] }}</div>
                        </div>
                        <div class="stat-chip chip-amber">LEAD</div>
                    </div>
                    <a href="{{ url('order-konsultasi') }}" class="stat-link">Tindak lanjuti</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Jadwal Aktif</div>
                            <div class="stat-value">{{ $stats['jadwal_aktif'] }}</div>
                        </div>
                        <div class="stat-chip chip-sky">JWL</div>
                    </div>
                    <a href="{{ url('jadwal-pelayanan') }}" class="stat-link">Kelola jadwal</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">View Artikel</div>
                            <div class="stat-value">{{ number_format($stats['artikel_views']) }}</div>
                        </div>
                        <div class="stat-chip chip-indigo">VIEW</div>
                    </div>
                    <a href="{{ url('master-artikel') }}" class="stat-link">Lihat performa artikel</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">View Produk</div>
                            <div class="stat-value">{{ number_format($stats['produk_views']) }}</div>
                        </div>
                        <div class="stat-chip chip-emerald">VIEW</div>
                    </div>
                    <a href="{{ url('master-produk') }}" class="stat-link">Lihat performa produk</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card dashboard-card h-100">
                <div class="card-header">
                    <h5 class="card-title">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="quick-grid">
                        <a href="{{ url('master-artikel') }}" class="quick-action">
                            <div class="quick-action-title">Tambah / Kelola Artikel</div>
                            <div class="quick-action-desc">Buat artikel baru, edit headline, atau ubah status publish.</div>
                        </a>

                        <a href="{{ url('master-produk') }}" class="quick-action">
                            <div class="quick-action-title">Tambah / Kelola Produk</div>
                            <div class="quick-action-desc">Atur produk unggulan, harga, foto, dan detail order WhatsApp.</div>
                        </a>

                        <a href="{{ url('jadwal-pelayanan') }}" class="quick-action">
                            <div class="quick-action-title">Kelola Jadwal Pelatihan</div>
                            <div class="quick-action-desc">Update flyer, tanggal, lokasi, metode, dan link pendaftaran.</div>
                        </a>

                        <a href="{{ url('pengaturan-website') }}" class="quick-action">
                            <div class="quick-action-title">Edit Pengaturan Website</div>
                            <div class="quick-action-desc">Ubah brand, lokasi, email, nomor WhatsApp, dan pesan CTA.</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card dashboard-card h-100">
                <div class="card-header">
                    <h5 class="card-title">Status Website</h5>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-key">Brand</div>
                            <div class="info-value">{{ $site->site_domain_text ?? 'untungyasril.com' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">Lokasi</div>
                            <div class="info-value">{{ $site->lokasi ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">Email</div>
                            <div class="info-value">{{ $site->email ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">WhatsApp</div>
                            <div class="info-value">{{ $site->whatsapp_number ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">CTA Default</div>
                            <div class="info-value">{{ $site->whatsapp_default_message ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Konsultasi Terbaru</h5>
                    <a href="{{ url('order-konsultasi') }}" class="section-link">Lihat semua</a>
                </div>
                <div class="card-body">
                    @forelse($latestKonsultasi as $item)
                        <div class="feed-item">
                            <div class="feed-title">{{ $item->nama ?: 'Tanpa nama' }}</div>
                            <div class="feed-meta">
                                {{ $item->whatsapp ?: '-' }} • {{ $item->tanggal ?: optional($item->created_at)->format('Y-m-d') }}
                            </div>
                            <div class="feed-desc">
                                {{ \Illuminate\Support\Str::limit($item->pertanyaan, 90) }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada konsultasi.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Jadwal Pelatihan Terdekat</h5>
                    <a href="{{ url('jadwal-pelayanan') }}" class="section-link">Kelola</a>
                </div>
                <div class="card-body">
                    @forelse($nearestJadwal as $item)
                        <div class="feed-item">
                            <div class="feed-title">{{ $item->nama_pelatihan }}</div>
                            <div class="feed-meta">
                                {{ $item->tanggal }} • {{ $item->lokasi ?: 'Lokasi menyusul' }}
                            </div>
                            <div class="feed-desc">
                                {{ $item->narasumber ?: 'Narasumber belum diisi' }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada jadwal aktif.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Artikel Terpopuler</h5>
                        <a href="{{ url('master-artikel') }}" class="section-link">Kelola</a>
                    </div>
                    <div class="card-body">
                        @forelse($topArtikel as $item)
                            <div class="feed-item">
                                <div class="feed-title">{{ $item->judul }}</div>
                                <div class="feed-meta">
                                    <i class="far fa-eye"></i> {{ number_format($item->view_count ?? 0) }} kali dilihat
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">Belum ada data artikel populer.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Produk Terpopuler</h5>
                        <a href="{{ url('master-produk') }}" class="section-link">Kelola</a>
                    </div>
                    <div class="card-body">
                        @forelse($topProduk as $item)
                            <div class="feed-item">
                                <div class="feed-title">{{ $item->judul }}</div>
                                <div class="feed-meta">
                                    <i class="far fa-eye"></i> {{ number_format($item->view_count ?? 0) }} kali dilihat
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">Belum ada data produk populer.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
