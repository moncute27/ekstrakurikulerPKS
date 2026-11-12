<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengurus;
use App\Models\Prestasi;
use App\Models\Profil;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function beranda()
    {
        return view('public.beranda', [
            'beritaTerbaru' => Berita::published()->latest('tanggal')->take(3)->get(),
            'agendaTerdekat' => Agenda::mendatang()->orderBy('tanggal')->take(3)->get(),
            'jumlahAnggota' => Anggota::aktif()->count(),
            'jumlahPrestasi' => Prestasi::count(),
            'jumlahAgenda' => Agenda::count(),
            'jumlahGaleri' => Galeri::count(),
            'galeriSorot' => Galeri::latest('id')->take(6)->get(),
        ]);
    }

    public function profil()
    {
        return view('public.profil', [
            'detail' => app(Profil::class),
        ]);
    }

    public function organisasi()
    {
        return view('public.organisasi', [
            'pengurus' => Pengurus::urut()->get(),
        ]);
    }

    public function berita(Request $request)
    {
        $kategori = $request->query('kategori', 'Semua');
        $cari = $request->query('cari');

        $berita = Berita::published()
            ->when($kategori !== 'Semua', fn ($q) => $q->where('kategori', $kategori))
            ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                ->where('judul', 'like', "%{$cari}%")
                ->orWhere('isi', 'like', "%{$cari}%")))
            ->latest('tanggal')
            ->paginate(9)
            ->withQueryString();

        return view('public.berita', [
            'berita' => $berita,
            'kategoriAktif' => $kategori,
            'cari' => $cari,
        ]);
    }

    public function beritaDetail(Berita $berita)
    {
        abort_unless($berita->is_published, 404);

        return view('public.berita-detail', [
            'berita' => $berita,
            'lainnya' => Berita::published()->where('id', '!=', $berita->id)->latest('tanggal')->take(3)->get(),
        ]);
    }

    public function galeri()
    {
        return view('public.galeri', [
            'galeri' => Galeri::latest('id')->paginate(12),
        ]);
    }

    public function prestasi(Request $request)
    {
        $tingkat = $request->query('tingkat', 'Semua');

        return view('public.prestasi', [
            'prestasi' => Prestasi::tingkat($tingkat)->orderByDesc('tahun')->orderByDesc('id')->get(),
            'tingkatAktif' => $tingkat,
        ]);
    }

    public function anggota(Request $request)
    {
        $cari = $request->query('cari');
        $angkatan = $request->query('angkatan');

        $anggota = Anggota::query()
            ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                ->where('nama', 'like', "%{$cari}%")
                ->orWhere('kelas', 'like', "%{$cari}%")))
            ->when($angkatan, fn ($q) => $q->where('angkatan', $angkatan))
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('public.anggota', [
            'anggota' => $anggota,
            'daftarAngkatan' => Anggota::query()->distinct()->orderByDesc('angkatan')->pluck('angkatan'),
            'cari' => $cari,
            'angkatan' => $angkatan,
        ]);
    }

    public function agenda()
    {
        return view('public.agenda', [
            'mendatang' => Agenda::mendatang()->orderBy('tanggal')->get(),
            'lampau' => Agenda::whereDate('tanggal', '<', now()->toDateString())->orderByDesc('tanggal')->take(10)->get(),
        ]);
    }
}
