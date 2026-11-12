<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengurus;
use App\Models\Prestasi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'statistik' => [
                ['label' => 'Anggota Aktif', 'nilai' => Anggota::aktif()->count(), 'ikon' => '👥', 'route' => route('admin.anggota.index')],
                ['label' => 'Berita', 'nilai' => Berita::count(), 'ikon' => '📰', 'route' => route('admin.berita.index')],
                ['label' => 'Prestasi', 'nilai' => Prestasi::count(), 'ikon' => '🏆', 'route' => route('admin.prestasi.index')],
                ['label' => 'Agenda', 'nilai' => Agenda::count(), 'ikon' => '📅', 'route' => route('admin.agenda.index')],
                ['label' => 'Galeri', 'nilai' => Galeri::count(), 'ikon' => '🖼️', 'route' => route('admin.galeri.index')],
                ['label' => 'Pengurus', 'nilai' => Pengurus::count(), 'ikon' => '🎖️', 'route' => route('admin.pengurus.index')],
                ['label' => 'Pengguna', 'nilai' => User::count(), 'ikon' => '🔑', 'route' => route('admin.user.index')],
            ],
            'beritaTerbaru' => Berita::latest('tanggal')->take(5)->get(),
            'agendaTerdekat' => Agenda::mendatang()->orderBy('tanggal')->take(5)->get(),
        ]);
    }
}
