<?php

namespace App\Http\Controllers;

use App\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KonsultasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'whatsapp' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'pertanyaan' => 'required|string|min:10',
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $data = Konsultasi::create([
            'nama' => $request->filled('nama') ? $request->nama : null,
            'whatsapp' => $request->whatsapp,
            'email' => $request->filled('email') ? $request->email : null,
            'pertanyaan' => trim($request->pertanyaan),
            'status' => 7,
            'tanggal' => now(),
            'uuid' => Str::uuid()->toString(),
        ]);

        $message = "Halo Pak Untung, saya ingin konsultasi online.%0A"
            . "Nama: " . ($data->nama ?: '-') . "%0A"
            . "WhatsApp: " . $data->whatsapp . "%0A"
            . "Email: " . ($data->email ?: '-') . "%0A"
            . "Pertanyaan: " . $data->pertanyaan;

        return redirect()->away(wa_link(site_setting('whatsapp_number'), $message));
    }
}
