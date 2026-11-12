<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Support\UploadGambar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.berita.index', [
            'berita' => Berita::query()
                ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                    ->where('judul', 'like', "%{$cari}%")
                    ->orWhere('penulis', 'like', "%{$cari}%")))
                ->latest('tanggal')
                ->paginate(10)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.berita.form', [
            'berita' => new Berita(['tanggal' => now(), 'penulis' => auth()->user()?->name ?? 'Admin PKS', 'is_published' => true]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['gambar'] = UploadGambar::simpan($request->file('gambar'), 'berita');

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('sukses', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->validasi($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['gambar'] = UploadGambar::simpan($request->file('gambar'), 'berita', $berita->gambar);

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('sukses', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        UploadGambar::hapus($berita->gambar);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('sukses', 'Berita berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(Berita::KATEGORI)],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'isi' => ['required', 'string'],
            'penulis' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);
    }
}
