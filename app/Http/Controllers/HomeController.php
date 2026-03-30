<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Produk;
use App\Konsultasi;
use App\JadwalPelatihan;
use App\SiteSetting;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $pagetitle = 'Dashboard';
        $today = now()->toDateString();

        // Statistik ringkas
        $stats = [
            'artikel_publish' => Artikel::where('status', 'publish')->count(),
            'produk_publish'  => Produk::where('status', 'publish')->count(),
            'konsultasi_baru' => Konsultasi::where('status', 7)->count(),
            'jadwal_aktif'    => JadwalPelatihan::whereDate('tanggal', '>=', $today)->count(),
            'artikel_views'   => (int) Artikel::sum('view_count'),
            'produk_views'    => (int) Produk::sum('view_count'),
        ];

        // Data panel
        $latestKonsultasi = Konsultasi::where('status', 7)
            ->latest('id')
            ->limit(5)
            ->get();

        $nearestJadwal = JadwalPelatihan::whereDate('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        $site = SiteSetting::first();

        $topArtikel = Artikel::where('status', 'publish')
            ->orderByDesc('view_count')
            ->latest('id')
            ->limit(5)
            ->get();

        $topProduk = Produk::where('status', 'publish')
            ->orderByDesc('view_count')
            ->latest('id')
            ->limit(5)
            ->get();

        // Grafik 12 bulan
        $months = [];
        $artikelViews = [];
        $produkViews = [];
        $artikelGrowth = [];
        $produkGrowth = [];

        $lastArtikel = null;
        $lastProduk = null;

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();

            $months[] = $date->format('M Y');

            // Catatan:
            // Ini masih memakai created_at karena di kode Anda hanya ada total view_count.
            // Jadi grafik ini = total view_count dari konten yang dibuat pada bulan tersebut.
            $artikel = (int) Artikel::whereBetween('created_at', [$start, $end])->sum('view_count');
            $produk  = (int) Produk::whereBetween('created_at', [$start, $end])->sum('view_count');

            $artikelViews[] = $artikel;
            $produkViews[] = $produk;

            $artikelGrowth[] = ($lastArtikel === null || $lastArtikel == 0)
                ? 0
                : round((($artikel - $lastArtikel) / $lastArtikel) * 100, 2);

            $produkGrowth[] = ($lastProduk === null || $lastProduk == 0)
                ? 0
                : round((($produk - $lastProduk) / $lastProduk) * 100, 2);

            $lastArtikel = $artikel;
            $lastProduk = $produk;
        }

        return view('home.index', compact(
            'pagetitle',
            'stats',
            'latestKonsultasi',
            'nearestJadwal',
            'site',
            'topArtikel',
            'topProduk',
            'months',
            'artikelViews',
            'produkViews',
            'artikelGrowth',
            'produkGrowth'
        ));
    }
}
