<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisasi;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', '');
        $query = Organisasi::query();

        if (!empty($q)) {
            $query->where('nama_pengurus', 'LIKE', "%{$q}%")
                ->orWhere('jabatan', 'LIKE', "%{$q}%");
        }

        $organisasi = $query->orderBy('id', 'asc')->paginate(10)->withQueryString();
        return view('backend.backendorganisasi', compact('organisasi', 'q'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto_pengurus' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fotoPath = '';
        if ($request->hasFile('foto_pengurus')) {
            $file = $request->file('foto_pengurus');
            $filename = 'org_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/organisasi'), $filename);
            $fotoPath = 'uploads/organisasi/' . $filename;
        }

        Organisasi::create([
            'nama_pengurus' => $request->nama_pengurus,
            'jabatan' => $request->jabatan,
            'foto_pengurus' => $fotoPath,
        ]);

        return redirect()->route('admin.organisasi')->with('success', 'Pengurus organisasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengurus' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto_pengurus' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $org = Organisasi::findOrFail($id);
        $org->nama_pengurus = $request->nama_pengurus;
        $org->jabatan = $request->jabatan;

        if ($request->hasFile('foto_pengurus')) {
            $file = $request->file('foto_pengurus');
            $filename = 'org_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/organisasi'), $filename);
            $org->foto_pengurus = 'uploads/organisasi/' . $filename;
        }

        $org->save();

        return redirect()->route('admin.organisasi')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $org = Organisasi::findOrFail($id);
        $org->delete();

        return redirect()->route('admin.organisasi')->with('success', 'Data pengurus berhasil dihapus!');
    }
}
