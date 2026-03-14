<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class MasterProdukController extends Controller
{
    public function index()
    {
        $pagetitle = 'Master Produk';
        $smalltitle = 'Kelola produk dan ulasan produk';

        return view('master.produk', compact('pagetitle', 'smalltitle'));
    }

    public function datatable(Request $request)
    {
        $query = Produk::query()->select(['id', 'judul', 'harga', 'status', 'uuid']);

        if ($request->has('search')) {
            $keyword = trim(data_get($request->input('search'), 'value', ''));
            if (strlen($keyword) >= 3) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('ulasan', 'like', "%{$keyword}%");
                });
            }
        }

        return DataTables::of($query->orderBy('urutan')->latest('id'))
            ->editColumn('harga', function ($row) {
                return 'Rp ' . number_format((float) $row->harga, 0, ',', '.');
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
                return '<a href="' . url('produk/' . $row->slug) . '" target="_blank">Lihat</a>';
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
        $produk = Produk::where('uuid', $uuid)->first();
        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return response()->json(['status' => true, 'data' => $produk]);
    }

    public function submit_insert(Request $request)
    {
        if (!$this->ucc()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }
        $data = $this->validated($request);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }
        $data['uuid'] = (string) Str::uuid();
        $data['slug'] = Str::slug($data['judul']) . '-' . substr(Str::uuid()->toString(), 0, 8);
        $data['nomor_wa_order'] = normalize_wa_number($data['nomor_wa_order'] ?: site_setting('whatsapp_number'));
        Produk::create($data);

        return response()->json(['status' => true, 'message' => 'Produk berhasil ditambahkan', '_token' => csrf_token()]);
    }

    public function submit_update(Request $request)
    {
        if (!$this->ucu()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }
        $produk = Produk::where('uuid', $request->uuid)->first();
        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        $data = $this->validated($request);
        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }
        if ($produk->judul !== $data['judul']) {
            $data['slug'] = Str::slug($data['judul']) . '-' . substr(Str::uuid()->toString(), 0, 8);
        }
        $data['nomor_wa_order'] = normalize_wa_number($data['nomor_wa_order'] ?: site_setting('whatsapp_number'));
        $produk->update($data);

        return response()->json(['status' => true, 'message' => 'Produk berhasil disimpan', '_token' => csrf_token()]);
    }

    public function submit_delete(Request $request)
    {
        if (!$this->ucd()) {
            return response()->json(['status' => false, 'message' => 'Akses ditolak']);
        }
        $produk = Produk::where('uuid', $request->uuid)->first();
        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();

        return response()->json(['status' => true, 'message' => 'Produk berhasil dihapus', '_token' => csrf_token()]);
    }

    protected function validated(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'ulasan' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'nomor_wa_order' => 'nullable|string|max:30',
            'status' => 'required|in:draft,publish',
            'urutan' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}
