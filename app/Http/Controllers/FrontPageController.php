<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\JadwalPelatihan;
use App\Produk;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function home()
    {
        $jadwalPelatihan = JadwalPelatihan::orderBy('tanggal', 'desc')->limit(6)->get();
        $artikels = Artikel::where('status', 'publish')->orderByDesc('published_at')->limit(5)->get();
        $produks = Produk::where('status', 'publish')->orderBy('urutan')->orderByDesc('id')->limit(3)->get();

        return view('front-end.pages.home', compact('jadwalPelatihan', 'artikels', 'produks'));
    }

    public function artikels()
    {
        $artikels = Artikel::where('status', 'publish')->orderByDesc('published_at')->paginate(9);

        return view('front-end.pages.artikel', compact('artikels'));
    }

    public function artikelDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)->where('status', 'publish')->firstOrFail();
        $artikels = Artikel::where('status', 'publish')->where('id', '<>', $artikel->id)->orderByDesc('published_at')->limit(3)->get();

        return view('front-end.pages.artikel-detail', compact('artikel', 'artikels'));
    }

    public function produks()
    {
        $produks = Produk::where('status', 'publish')->orderBy('urutan')->orderByDesc('id')->paginate(9);

        return view('front-end.pages.produk', compact('produks'));
    }

    public function produkDetail($slug)
    {
        $produk = Produk::where('slug', $slug)->where('status', 'publish')->firstOrFail();
        $produks = Produk::where('status', 'publish')->where('id', '<>', $produk->id)->orderBy('urutan')->orderByDesc('id')->limit(3)->get();

        return view('front-end.pages.produk-detail', compact('produk', 'produks'));
    }
}
