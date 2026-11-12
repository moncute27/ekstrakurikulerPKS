@extends('backend.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Utama')
@section('page_subtitle', 'Selamat datang di Sistem Informasi Ekstrakurikuler PKS SMKN 2 Purwakarta')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, var(--pks-navy) 0%, #152d4e 100%);
        color: #ffffff;
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(11, 30, 54, 0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -40px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(217, 119, 6, 0.25) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-text h2 {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #ffffff;
    }

    .welcome-text p {
        font-size: 13.5px;
        color: #cbd5e1;
        max-width: 600px;
        line-height: 1.5;
        margin: 0;
    }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(217, 119, 6, 0.2);
        color: var(--pks-gold-light);
        border: 1px solid rgba(217, 119, 6, 0.4);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .welcome-actions {
        display: flex;
        gap: 12px;
    }

    .btn-action-banner {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--pks-red) 0%, #991b1b 100%);
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
        box-shadow: 0 4px 12px rgba(197, 22, 29, 0.3);
    }
    .btn-action-banner:hover {
        background: #a51319;
        transform: translateY(-2px);
    }

    /* STATS GRID */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: 0.25s ease;
        text-decoration: none;
        color: inherit;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(11, 30, 54, 0.08);
        border-color: #cbd5e1;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-icon.blue { background: #eff6ff; color: #2563eb; }
    .stat-icon.gold { background: #fef3c7; color: #d97706; }
    .stat-icon.green { background: #ecfdf5; color: #059669; }
    .stat-icon.red { background: #fef2f2; color: #dc2626; }
    .stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
    .stat-icon.indigo { background: #e0e7ff; color: #4338ca; }

    .stat-details h3 {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        color: var(--pks-navy);
        line-height: 1.1;
    }

    .stat-details p {
        font-size: 12.5px;
        color: var(--pks-gray);
        margin: 4px 0 0 0;
        font-weight: 500;
    }

    /* DASHBOARD SECTIONS */
    .dashboard-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    @media (max-width: 1024px) {
        .dashboard-row {
            grid-template-columns: 1fr;
        }
    }

    .card-box {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        padding: 24px;
    }

    .card-box-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--pks-border);
    }

    .card-box-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--pks-navy);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-box-header a {
        font-size: 12px;
        font-weight: 600;
        color: var(--pks-red);
        text-decoration: none;
    }
    .card-box-header a:hover {
        text-decoration: underline;
    }

    /* TABLE MINI */
    .table-mini {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .table-mini th {
        text-align: left;
        padding: 10px 12px;
        background: #f8fafc;
        color: var(--pks-gray);
        font-weight: 600;
        font-size: 12px;
        border-bottom: 1px solid var(--pks-border);
    }

    .table-mini td {
        padding: 12px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-mini tr:last-child td {
        border-bottom: none;
    }

    .badge-category {
        display: inline-block;
        padding: 3px 8px;
        background: #f1f5f9;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        color: var(--pks-navy);
    }

    /* AGENDA MINI */
    .agenda-mini-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .agenda-mini-item:last-child {
        border-bottom: none;
    }

    .agenda-date-badge {
        background: var(--pks-navy);
        color: #ffffff;
        border-radius: 8px;
        padding: 6px 10px;
        text-align: center;
        min-width: 46px;
    }
    .agenda-date-badge .day {
        font-size: 15px;
        font-weight: 700;
        line-height: 1;
    }
    .agenda-date-badge .month {
        font-size: 9px;
        text-transform: uppercase;
        color: var(--pks-gold-light);
        margin-top: 2px;
    }

    .agenda-mini-info h4 {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--pks-dark);
        margin: 0 0 4px 0;
    }

    .agenda-mini-info p {
        font-size: 11.5px;
        color: var(--pks-gray);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')

<!-- WELCOME BANNER -->
<div class="welcome-banner">
    <div class="welcome-text">
        <div class="welcome-badge">
            <i class="fa-solid fa-shield-halved"></i> Markas Komando Patroli Keamanan Sekolah
        </div>
        <h2>Siap Bertugas, {{ Auth::user()->nama ?? 'Admin PKS' }}! 👮</h2>
        <p>
            Kelola seluruh aktivitas, berita, keanggotaan, prestasi, dan agenda Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta dengan tertib, disiplin, dan terintegrasi langsung ke database.
        </p>
    </div>
    <div class="welcome-actions">
        <a href="{{ route('admin.berita') }}" class="btn-action-banner">
            <i class="fa-solid fa-plus"></i> Tambah Berita
        </a>
    </div>
</div>

<!-- STATS GRID -->
<div class="stats-grid">
    <a href="{{ route('admin.anggota') }}" class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalAnggota }}</h3>
            <p>Total Anggota</p>
        </div>
    </a>

    <a href="{{ route('admin.prestasi') }}" class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-trophy"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalPrestasi }}</h3>
            <p>Prestasi Juara</p>
        </div>
    </a>

    <a href="{{ route('admin.berita') }}" class="stat-card">
        <div class="stat-icon red">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalBerita }}</h3>
            <p>Berita & Informasi</p>
        </div>
    </a>

    <a href="{{ route('admin.galeri') }}" class="stat-card">
        <div class="stat-icon purple">
            <i class="fa-solid fa-images"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalGaleri }}</h3>
            <p>Dokumentasi Foto</p>
        </div>
    </a>

    <a href="{{ route('admin.agenda') }}" class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalAgenda }}</h3>
            <p>Agenda Patroli</p>
        </div>
    </a>

    <a href="{{ route('admin.organisasi') }}" class="stat-card">
        <div class="stat-icon indigo">
            <i class="fa-solid fa-sitemap"></i>
        </div>
        <div class="stat-details">
            <h3>{{ $totalOrganisasi }}</h3>
            <p>Pengurus Organisasi</p>
        </div>
    </a>
</div>

<!-- DASHBOARD ROW -->
<div class="dashboard-row">
    <!-- RECENT NEWS -->
    <div class="card-box">
        <div class="card-box-header">
            <h3><i class="fa-solid fa-newspaper" style="color: var(--pks-red);"></i> Berita & Kegiatan Terbaru</h3>
            <a href="{{ route('admin.berita') }}">Kelola Semua &rarr;</a>
        </div>

        @if($beritaTerbaru->count() > 0)
            <table class="table-mini">
                <thead>
                    <tr>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Penulis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritaTerbaru as $b)
                        <tr>
                            <td>
                                <strong>{{ Str::limit($b->judul_berita, 40) }}</strong>
                            </td>
                            <td>
                                <span class="badge-category">{{ $b->kategori }}</span>
                            </td>
                            <td style="color: var(--pks-gray);">
                                {{ date('d M Y', strtotime($b->tanggal)) }}
                            </td>
                            <td>
                                <i class="fa-regular fa-user" style="font-size: 11px; margin-right: 4px;"></i> {{ $b->penulis }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: var(--pks-gray); padding: 20px 0;">Belum ada berita yang diterbitkan.</p>
        @endif
    </div>

    <!-- UPCOMING AGENDAS -->
    <div class="card-box">
        <div class="card-box-header">
            <h3><i class="fa-solid fa-calendar-days" style="color: var(--pks-gold);"></i> Agenda Patroli</h3>
            <a href="{{ route('admin.agenda') }}">Lihat Semua &rarr;</a>
        </div>

        @if($agendaTerdekat->count() > 0)
            @foreach($agendaTerdekat as $ag)
                <div class="agenda-mini-item">
                    <div class="agenda-date-badge">
                        <div class="day">{{ date('d', strtotime($ag->tanggal)) }}</div>
                        <div class="month">{{ date('M', strtotime($ag->tanggal)) }}</div>
                    </div>
                    <div class="agenda-mini-info">
                        <h4>{{ $ag->nama }}</h4>
                        <p>
                            <i class="fa-regular fa-clock"></i> {{ substr($ag->waktu, 0, 5) }} WIB &bull;
                            <i class="fa-solid fa-location-dot"></i> {{ Str::limit($ag->tempat, 18) }}
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: var(--pks-gray); padding: 20px 0;">Belum ada agenda patroli.</p>
        @endif
    </div>
</div>

@endsection
