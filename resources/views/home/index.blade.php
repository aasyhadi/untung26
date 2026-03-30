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

    .chip-indigo { background: #eef2ff; color: #4338ca; }
    .chip-emerald { background: #ecfdf5; color: #047857; }
    .chip-amber { background: #fffbeb; color: #b45309; }
    .chip-sky { background: #eff6ff; color: #0369a1; }

    .stat-link,
    .section-link {
        font-size: 13px;
        font-weight: 700;
        color: #4338ca;
        text-decoration: none;
    }

    .stat-link:hover,
    .section-link:hover {
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

    .info-list,
    .feed-list {
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

    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .bg-soft-indigo { background-color: #eef2ff; color: #4338ca; }
    .bg-soft-emerald { background-color: #ecfdf5; color: #047857; }

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
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-line text-primary me-2"></i>Grafik View Artikel & Produk (12 Bulan)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="viewChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card dashboard-card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-bolt text-warning me-2"></i>Quick Actions
                    </h5>
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
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-server text-info me-2"></i>Status Website
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-key">Brand</div>
                            <div class="info-value">{{ optional($site)->site_domain_text ?: 'untungyasril.com' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">Lokasi</div>
                            <div class="info-value">{{ optional($site)->lokasi ?: '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">Email</div>
                            <div class="info-value">{{ optional($site)->email ?: '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">WhatsApp</div>
                            <div class="info-value">{{ optional($site)->whatsapp_number ?: '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-key">CTA Default</div>
                            <div class="info-value">{{ optional($site)->whatsapp_default_message ?: '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-comments text-primary me-2"></i>Konsultasi Terbaru
                    </h5>
                    <a href="{{ url('order-konsultasi') }}" class="section-link">Lihat semua</a>
                </div>
                <div class="card-body">
                    @forelse($latestKonsultasi as $item)
                        <div class="feed-item">
                            <div class="feed-title">{{ $item->nama ?: 'Tanpa nama' }}</div>
                            <div class="feed-meta">
                                <span class="me-2">
                                    <i class="fab fa-whatsapp"></i>
                                    {{ $item->whatsapp ?: '-' }}
                                </span>
                                <span>
                                    <i class="far fa-calendar"></i>
                                    {{ $item->tanggal ?: optional($item->created_at)->format('Y-m-d') }}
                                </span>
                            </div>
                            <div class="feed-desc">
                                {{ \Illuminate\Support\Str::limit($item->pertanyaan, 90) }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada konsultasi masuk.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-calendar-alt text-success me-2"></i>Jadwal Pelatihan Terdekat
                    </h5>
                    <a href="{{ url('jadwal-pelayanan') }}" class="section-link">Kelola</a>
                </div>
                <div class="card-body">
                    @forelse($nearestJadwal as $item)
                        <div class="feed-item">
                            <div class="feed-title">{{ $item->nama_pelatihan }}</div>
                            <div class="feed-meta">
                                <span class="me-2">
                                    <i class="far fa-calendar"></i>
                                    {{ $item->tanggal }}
                                </span>
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $item->lokasi ?: 'Lokasi menyusul' }}
                                </span>
                            </div>
                            <div class="feed-desc">
                                {{ $item->narasumber ?: 'Narasumber belum diisi' }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada jadwal pelatihan aktif.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-fire text-danger me-2"></i>Artikel Terpopuler
                    </h5>
                    <a href="{{ url('master-artikel') }}" class="btn btn-sm btn-light text-primary fw-bold">Kelola</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($topArtikel as $item)
                            <div class="list-group-item list-group-item-action border-0 px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        @if($item->foto)
                                            <img src="{{ media_url($item->foto) }}" class="rounded-3 object-fit-cover" width="48" height="48" alt="thumb">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="far fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1 me-2">
                                        <div class="fw-bold text-dark mb-0 line-clamp-1">{{ $item->judul }}</div>
                                        <small class="text-muted" style="font-size: 11px;">
                                            <i class="far fa-clock me-1"></i>{{ optional($item->created_at)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <div class="text-end">
                                        <span class="badge bg-soft-indigo rounded-pill px-2 py-1">
                                            <i class="far fa-eye me-1"></i>{{ number_format($item->view_count ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-muted">Belum ada data artikel.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card dashboard-card h-100 border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-shopping-bag text-success me-2"></i>Produk Terpopuler
                    </h5>
                    <a href="{{ url('master-produk') }}" class="btn btn-sm btn-light text-primary fw-bold">Kelola</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($topProduk as $item)
                            <div class="list-group-item list-group-item-action border-0 px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        @if($item->foto)
                                            <img src="{{ media_url($item->foto) }}" class="rounded-3 object-fit-cover" width="48" height="48" alt="thumb">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="fas fa-box text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1 me-2">
                                        <div class="fw-bold text-dark mb-0 line-clamp-1">{{ $item->judul }}</div>
                                        <div class="text-success fw-bold small">
                                            Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <span class="badge bg-soft-emerald rounded-pill px-2 py-1">
                                            <i class="far fa-eye me-1"></i>{{ number_format($item->view_count ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-muted">Belum ada data produk.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($months);
    const artikelData = @json($artikelViews);
    const produkData = @json($produkViews);

    const el = document.getElementById('viewChart');

    if (el) {
        new Chart(el.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'View Artikel',
                        data: artikelData,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'View Produk',
                        data: produkData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
@endsection
