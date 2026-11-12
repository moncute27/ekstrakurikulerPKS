<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profil;
use App\Models\Organisasi;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Anggota;
use App\Models\Agenda;

class FrontendController extends Controller
{
    public function beranda()
    {
        $profil = Profil::first();
        $totalAnggota = Anggota::where('status_keanggotan', 'Aktif')->count();
        if ($totalAnggota === 0) $totalAnggota = Anggota::count();
        $totalPrestasi = Prestasi::count();
        $totalAgenda = Agenda::count();
        $totalGaleri = Galeri::count();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')->take(3)->get();
        $prestasiUnggulan = Prestasi::orderBy('id', 'desc')->take(3)->get();
        $galeriCuplikan = Galeri::orderBy('id', 'desc')->take(6)->get();

        $agendaMendatang = Agenda::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();
        if ($agendaMendatang->isEmpty()) {
            $agendaMendatang = Agenda::orderBy('tanggal', 'desc')->take(3)->get();
        }

        $pembina = Organisasi::where('jabatan', 'LIKE', '%Pembina%')->first();
        $pelatih = Organisasi::where('jabatan', 'LIKE', '%Pelatih%')->first();
        $ketua = Organisasi::where('jabatan', 'LIKE', '%Ketua%')->first();

        return view('frontend.beranda', compact(
            'profil',
            'totalAnggota',
            'totalPrestasi',
            'totalAgenda',
            'totalGaleri',
            'beritaTerbaru',
            'prestasiUnggulan',
            'galeriCuplikan',
            'agendaMendatang',
            'pembina',
            'pelatih',
            'ketua'
        ));
    }

    public function profil()
    {
        $profil = Profil::first();
        return view('frontend.profil', compact('profil'));
    }

    public function organisasi()
    {
        $pembina = Organisasi::where('jabatan', 'LIKE', '%Pembina%')->first();
        $pelatih = Organisasi::where('jabatan', 'LIKE', '%Pelatih%')->first();
        $ketua = Organisasi::where('jabatan', 'LIKE', '%Ketua Umum%')->orWhere('jabatan', 'Ketua')->first();
        $pengurus = Organisasi::where('jabatan', 'NOT LIKE', '%Pembina%')
            ->where('jabatan', 'NOT LIKE', '%Pelatih%')
            ->where('id', '!=', $ketua ? $ketua->id : 0)
            ->get();
        $semuaOrganisasi = Organisasi::all();

        return view('frontend.organisasi', compact('pembina', 'pelatih', 'ketua', 'pengurus', 'semuaOrganisasi'));
    }

    public function berita(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'Semua');
        $q = $request->query('q', '');

        $query = Berita::query();

        if ($kategoriAktif !== 'Semua' && !empty($kategoriAktif)) {
            $query->where('kategori', $kategoriAktif);
        }

        if (!empty($q)) {
            $query->where(function ($sub) use ($q) {
                $sub->where('judul_berita', 'LIKE', "%{$q}%")
                    ->orWhere('isi_berita', 'LIKE', "%{$q}%")
                    ->orWhere('penulis', 'LIKE', "%{$q}%");
            });
        }

        $berita = $query->orderBy('tanggal', 'desc')->paginate(6)->withQueryString();
        $kategoriList = Berita::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('frontend.berita', compact('berita', 'kategoriList', 'kategoriAktif', 'q'));
    }

    public function galeri(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'Semua');
        $query = Galeri::query();

        if ($kategoriAktif !== 'Semua' && !empty($kategoriAktif)) {
            $query->where('kategori', $kategoriAktif);
        }

        $galeri = $query->orderBy('id', 'desc')->paginate(8)->withQueryString();
        $kategoriList = Galeri::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('frontend.galeri', compact('galeri', 'kategoriList', 'kategoriAktif'));
    }

    public function prestasi(Request $request)
    {
        $tingkatAktif = $request->query('tingkat', 'Semua');
        $query = Prestasi::query();

        if ($tingkatAktif !== 'Semua' && !empty($tingkatAktif)) {
            $query->where('tingkat_lomba', 'LIKE', "%{$tingkatAktif}%");
        }

        $prestasi = $query->orderBy('id', 'desc')->paginate(6)->withQueryString();
        return view('frontend.prestasi', compact('prestasi', 'tingkatAktif'));
    }

    public function anggota(Request $request)
    {
        $angkatanAktif = $request->query('angkatan', 'Semua');
        $statusAktif = $request->query('status', 'Semua');
        $q = $request->query('q', '');

        $query = Anggota::query();

        if ($angkatanAktif !== 'Semua' && !empty($angkatanAktif)) {
            $query->where('angkatan', $angkatanAktif);
        }

        if ($statusAktif !== 'Semua' && !empty($statusAktif)) {
            $query->where('status_keanggotan', $statusAktif);
        }

        if (!empty($q)) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'LIKE', "%{$q}%")
                    ->orWhere('kelas', 'LIKE', "%{$q}%");
            });
        }

        $anggota = $query->orderBy('nama', 'asc')->paginate(10)->withQueryString();
        $angkatanList = Anggota::select('angkatan')->distinct()->whereNotNull('angkatan')->orderBy('angkatan', 'desc')->pluck('angkatan');

        return view('frontend.anggota', compact('anggota', 'angkatanList', 'angkatanAktif', 'statusAktif', 'q'));
    }

    public function agenda(Request $request)
    {
        $tab = $request->query('tab', 'semua');
        $query = Agenda::query();

        if ($tab === 'mendatang') {
            $query->where('tanggal', '>=', now()->toDateString())->orderBy('tanggal', 'asc');
        } elseif ($tab === 'selesai') {
            $query->where('tanggal', '<', now()->toDateString())->orderBy('tanggal', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $agenda = $query->paginate(6)->withQueryString();
        return view('frontend.agenda', compact('agenda', 'tab'));
    }
}
