<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Produk;
use App\Konsultasi;
use App\JadwalPelatihan;
use App\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $pagetitle = 'Dashboard';

        $stats = [
            'artikel_publish' => Artikel::where('status', 'publish')->count(),
            'produk_publish' => Produk::where('status', 'publish')->count(),
            'konsultasi_baru' => Konsultasi::where('status', 7)->count(),
            'jadwal_aktif' => JadwalPelatihan::whereDate('tanggal', '>=', now()->toDateString())->count(),
            'artikel_views' => Artikel::sum('view_count'),
            'produk_views' => Produk::sum('view_count'),
        ];

        $latestKonsultasi = Konsultasi::where('status', 7)->orderByDesc('id')->limit(5)->get();
        $latestArtikel = Artikel::orderByDesc('id')->limit(5)->get();
        $latestProduk = Produk::orderByDesc('id')->limit(5)->get();
        $nearestJadwal = JadwalPelatihan::whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->limit(5)
            ->get();
        $site = SiteSetting::first();

        $topArtikel = Artikel::where('status', 'publish')
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        $topProduk = Produk::where('status', 'publish')
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        /* ========================
        GRAFIK VIEW 12 BULAN
        ======================== */

        $months = [];
        $artikelViews = [];
        $produkViews = [];

        for ($i = 11; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $months[] = $date->format('M Y');

            /*$artikelViews[] = Artikel::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('view_count');

            $produkViews[] = Produk::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('view_count'); */

            // ✅ AKUMULASI ARTIKEL
            $artikelViews[] = Artikel::whereDate('created_at', '<=', $date->copy()->endOfMonth())
                ->sum('view_count');

            // ✅ AKUMULASI PRODUK
            $produkViews[] = Produk::whereDate('created_at', '<=', $date->copy()->endOfMonth())
                ->sum('view_count');
        }

        return view('home.index', compact(
            'pagetitle',
            'stats',
            'latestKonsultasi',
            'latestArtikel',
            'latestProduk',
            'nearestJadwal',
            'site',
            'topArtikel',
            'topProduk',
            'months',
            'artikelViews',
            'produkViews'
        ));
   }
}
