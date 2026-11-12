<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Support\UploadGambar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.prestasi.index', [
            'prestasi' => Prestasi::query()
                ->when($cari, fn ($q) => $q->where('judul', 'like', "%{$cari}%"))
                ->orderByDesc('tahun')
                ->orderByDesc('id')
                ->paginate(10)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.prestasi.form', ['item' => new Prestasi(['tahun' => now()->year])]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'prestasi');

        Prestasi::create($data);

        return redirect()->route('admin.prestasi.index')->with('sukses', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.form', ['item' => $prestasi]);
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $this->validasi($request);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'prestasi', $prestasi->foto);

        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')->with('sukses', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        UploadGambar::hapus($prestasi->foto);
        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('sukses', 'Prestasi berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tingkat' => ['required', Rule::in(Prestasi::TINGKAT)],
            'tahun' => ['nullable', 'integer', 'min:1990', 'max:2100'],
            'penyelenggara' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);
    }
}
