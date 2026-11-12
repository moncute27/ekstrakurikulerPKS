<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Support\UploadGambar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');
        $status = $request->query('status');

        return view('admin.anggota.index', [
            'anggota' => Anggota::query()
                ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                    ->where('nama', 'like', "%{$cari}%")
                    ->orWhere('kelas', 'like', "%{$cari}%")
                    ->orWhere('nis', 'like', "%{$cari}%")))
                ->when($status, fn ($q) => $q->where('status', $status))
                ->orderBy('nama')
                ->paginate(15)
                ->withQueryString(),
            'cari' => $cari,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin.anggota.form', ['item' => new Anggota(['status' => 'Aktif', 'angkatan' => now()->year])]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'anggota');

        Anggota::create($data);

        return redirect()->route('admin.anggota.index')->with('sukses', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('admin.anggota.form', ['item' => $anggota]);
    }

    public function update(Request $request, Anggota $anggota)
    {
        $data = $this->validasi($request, $anggota);
        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'anggota', $anggota->foto);

        $anggota->update($data);

        return redirect()->route('admin.anggota.index')->with('sukses', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        UploadGambar::hapus($anggota->foto);
        $anggota->delete();

        return redirect()->route('admin.anggota.index')->with('sukses', 'Anggota berhasil dihapus.');
    }

    private function validasi(Request $request, ?Anggota $anggota = null): array
    {
        return $request->validate([
            'nis' => ['nullable', 'string', 'max:30', Rule::unique('anggotas', 'nis')->ignore($anggota?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
            'angkatan' => ['required', 'string', 'max:10'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'status' => ['required', Rule::in(Anggota::STATUS)],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
