<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Support\UploadGambar;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.galeri.index', [
            'galeri' => Galeri::query()
                ->when($cari, fn ($q) => $q->where('judul', 'like', "%{$cari}%"))
                ->latest('id')
                ->paginate(12)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.galeri.form', ['item' => new Galeri(['tanggal' => now()])]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
            'tanggal' => ['nullable', 'date'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['gambar'] = UploadGambar::simpan($request->file('gambar'), 'galeri');

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', ['item' => $galeri]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:500'],
            'tanggal' => ['nullable', 'date'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['gambar'] = UploadGambar::simpan($request->file('gambar'), 'galeri', $galeri->gambar);

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        UploadGambar::hapus($galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto berhasil dihapus.');
    }
}
