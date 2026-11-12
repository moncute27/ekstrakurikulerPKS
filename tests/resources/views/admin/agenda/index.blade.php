@extends('layouts.admin')

@section('title', 'Kelola Agenda')
@section('subtitle', 'Jadwal kegiatan Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Kelola Agenda</h1>
            <p>Total {{ $agenda->total() }} agenda tersimpan.</p>
        </div>

        <a href="{{ route('admin.agenda.create') }}" class="btn btn--gold">+ Tambah Agenda</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.agenda.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari judul agenda...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.agenda.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($agenda->isEmpty())
            <div class="empty">
                <div class="empty__icon">📅</div>
                <p>Belum ada agenda kegiatan.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th style="width:80px;">Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agenda as $item)
                            <tr>
                                <td>
                                    <div class="mini-date">
                                        {{ $item->tanggal?->format('d') }}
                                        <span>{{ $item->tanggal?->translatedFormat('M Y') }}</span>
                                    </div>
                                </td>
                                <td class="cell-title" style="max-width:320px;">
                                    <strong>{{ $item->judul }}</strong>
                                    <small>{{ \Illuminate\Support\Str::limit($item->deskripsi, 70) }}</small>
                                </td>
                                <td>{{ $item->waktu ? \Illuminate\Support\Carbon::parse($item->waktu)->format('H:i') : '—' }}</td>
                                <td>{{ $item->lokasi ?: '—' }}</td>
                                <td>
                                    <span class="badge {{ $item->sudah_lewat ? 'badge--grey' : 'badge--green' }}">
                                        {{ $item->sudah_lewat ? 'Selesai' : 'Mendatang' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.agenda.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        <form method="POST" action="{{ route('admin.agenda.destroy', $item) }}"
                                              data-confirm="Hapus agenda &quot;{{ $item->judul }}&quot;?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn--danger btn-icon" title="Hapus">🗑</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">{{ $agenda->links() }}</div>
        @endif
    </div>

@endsection
