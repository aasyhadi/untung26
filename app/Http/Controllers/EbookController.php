<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\OrderBuku;
use App\Buku;

class EbookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'get_uuid' => 'required|string',
            'nama' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $ebook = Buku::where('uuid', $request->get_uuid)->first();
        if (!$ebook) {
            return back()->with('error', 'eBook tidak ditemukan.');
        }

        OrderBuku::create([
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'nama_ebook' => $ebook->judul,
            'status' => 7,
            'tanggal' => now(),
            'uuid' => Str::uuid()->toString(),
        ]);

        if ($ebook->landing_page_link) {
            return redirect()->away($ebook->landing_page_link);
        }

        return back()->with('success', 'Permintaan eBook berhasil disimpan.');
    }
}
