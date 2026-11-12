<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Support\UploadGambar;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.pengurus.index', [
            'pengurus' => Pengurus::query()
                ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                    ->where('nama', 'like', "%{$cari}%")
                    ->orWhere('jabatan', 'like', "%{$cari}%")))
                ->urut()
                ->paginate(10)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.pengurus.form', ['pengurus' => new Pengurus()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'pengurus');

        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('sukses', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.form', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $this->validasi($request);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'pengurus', $pengurus->foto);

        $pengurus->update($data);

        return redirect()->route('admin.pengurus.index')->with('sukses', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        UploadGambar::hapus($pengurus->foto);
        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('sukses', 'Pengurus berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'periode' => ['nullable', 'string', 'max:50'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:999'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [], [
            'nama' => 'nama pengurus',
            'jabatan' => 'jabatan',
        ]);
    }
}
