<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.agenda.index', [
            'agenda' => Agenda::query()
                ->when($cari, fn ($q) => $q->where('judul', 'like', "%{$cari}%"))
                ->orderByDesc('tanggal')
                ->paginate(10)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.agenda.form', ['item' => new Agenda(['tanggal' => now()])]);
    }

    public function store(Request $request)
    {
        Agenda::create($this->validasi($request));

        return redirect()->route('admin.agenda.index')->with('sukses', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.form', ['item' => $agenda]);
    }

    public function update(Request $request, Agenda $agenda)
    {
        $agenda->update($this->validasi($request));

        return redirect()->route('admin.agenda.index')->with('sukses', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('sukses', 'Agenda berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['nullable', 'date_format:H:i,H:i:s'],
            'lokasi' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
