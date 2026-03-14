<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $pagetitle = 'Pengaturan Website';
        $smalltitle = 'Kelola identitas website publik';
        $setting = SiteSetting::query()->first();

        return view('setting.website', compact('pagetitle', 'smalltitle', 'setting'));
    }

    public function update(Request $request)
    {
        if (!$this->ucu()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_domain_text' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => 'nullable|string|max:30',
            'whatsapp_default_message' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'profil_ringkas' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $setting = SiteSetting::query()->first() ?: new SiteSetting();

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('site', 'public');
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
