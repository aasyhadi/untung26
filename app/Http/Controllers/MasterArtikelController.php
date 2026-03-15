<?php

namespace App\Http\Controllers;

use App\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class MasterArtikelController extends Controller
{
    public function index()
    {
        $pagetitle = 'Master Artikel';
        $smalltitle = 'Kelola artikel yang tampil di halaman publik';

        return view('master.artikel', compact('pagetitle', 'smalltitle'));
    }

    public function datatable(Request $request)
    {
        $query = Artikel::query()->select(['id', 'judul', 'slug', 'status', 'view_count', 'published_at', 'uuid']);

        if ($request->has('search')) {
            $keyword = trim(data_get($request->input('search'), 'value', ''));
            if (strlen($keyword) >= 3) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('slug', 'like', "%{$keyword}%")
                      ->orWhere('status', 'like', "%{$keyword}%");
                });
            }
        }

        return DataTables::of($query->latest('id'))
            ->editColumn('published_at', function ($row) {
                return $row->published_at ? optional($row->published_at)->format('Y-m-d') : '-';
            })
            ->addColumn('status_badge', function ($row) {
                return $row->status === 'publish'
                    ? '<span class="badge bg-success">Publish</span>'
                    : '<span class="badge bg-secondary">Draft</span>';
            })
            ->addColumn('link_public', function ($row) {
                if ($row->status !== 'publish') {
                    return '<span class="text-muted">Draft</span>';
                }
                return '<a href="' . url('artikel/' . $row->slug) . '" target="_blank">Lihat</a>';
            })
            ->addColumn('action', function ($row) {
                $edit = $this->ucu() ? '<button data-bs-toggle="modal" data-uuid="'.$row->uuid.'" data-bs-target="#modal-edit" class="btn btn-outline-secondary btn-sm" type="button"><i class="las la-pen"></i></button>' : '';
                $delete = $this->ucd() ? '<button data-uuid="'.$row->uuid.'" class="btn btn-outline-secondary btn-sm btn-konfirm-delete" type="button"><i class="las la-trash"></i></button>' : '';
                return trim($edit . ' ' . $delete);
            })
            ->rawColumns(['status_badge', 'link_public', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function get_data($uuid)
    {
        $artikel = Artikel::where('uuid', $uuid)->first();
        if (!$artikel) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return response()->json(['status' => true, 'data' => $artikel]);
    }

    public function submit_insert(Request $request)
    {
        if (!$this->ucc()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }

        $data = $this->validated($request);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        }
        $data['uuid'] = (string) Str::uuid();
        $data['slug'] = Str::slug($data['judul']) . '-' . substr(Str::uuid()->toString(), 0, 8);
        $data['published_at'] = $data['status'] === 'publish' ? ($request->published_at ?: now()) : null;
        Artikel::create($data);

        return response()->json(['status' => true, 'message' => 'Artikel berhasil ditambahkan', '_token' => csrf_token()]);
    }

    public function submit_update(Request $request)
    {
        if (!$this->ucu()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }

        $artikel = Artikel::where('uuid', $request->uuid)->first();
        if (!$artikel) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        $data = $this->validated($request);
        if ($request->hasFile('foto')) {
            if ($artikel->foto) {
                Storage::disk('public')->delete($artikel->foto);
            }
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        }
        if ($artikel->judul !== $data['judul']) {
            $data['slug'] = Str::slug($data['judul']) . '-' . substr(Str::uuid()->toString(), 0, 8);
        }
        $data['published_at'] = $data['status'] === 'publish' ? ($request->published_at ?: ($artikel->published_at ?: now())) : null;
        $artikel->update($data);

        return response()->json(['status' => true, 'message' => 'Artikel berhasil disimpan', '_token' => csrf_token()]);
    }

    public function submit_delete(Request $request)
    {
        if (!$this->ucd()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }

        $artikel = Artikel::where('uuid', $request->uuid)->first();
        if (!$artikel) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }
        $artikel->delete();

        return response()->json(['status' => true, 'message' => 'Artikel berhasil dihapus', '_token' => csrf_token()]);
    }

    protected function validated(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'isi_artikel' => 'required|string',
            'teks_foto' => 'nullable|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|in:draft,publish',
            'published_at' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}
