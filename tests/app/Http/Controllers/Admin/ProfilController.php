<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Support\UploadGambar;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('admin.profil', ['detail' => Profil::get()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_ekskul' => ['required', 'string', 'max:255'],
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'foto_header' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $profil = Profil::get();

        $data['logo'] = UploadGambar::simpan($request->file('logo'), 'profil', $profil->logo);
        $data['foto_header'] = UploadGambar::simpan($request->file('foto_header'), 'profil', $profil->foto_header);

        $profil->update($data);

        return redirect()->route('admin.profil.edit')->with('sukses', 'Profil berhasil diperbarui.');
    }
}
