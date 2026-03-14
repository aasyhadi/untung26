<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Produk;
use App\Konsultasi;
use App\JadwalPelatihan;
use App\SiteSetting;

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
        ];

        $latestKonsultasi = Konsultasi::orderByDesc('id')->limit(5)->get();
        $latestArtikel = Artikel::orderByDesc('id')->limit(5)->get();
        $latestProduk = Produk::orderByDesc('id')->limit(5)->get();
        $nearestJadwal = JadwalPelatihan::whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->limit(5)
            ->get();
        $site = SiteSetting::first();

        return view('home.index', compact(
            'pagetitle',
            'stats',
            'latestKonsultasi',
            'latestArtikel',
            'latestProduk',
            'nearestJadwal',
            'site'
        ));
   }
}
