@extends('layouts.admin')

@section('title', 'Struktur Organisasi')
@section('subtitle', 'Kelola data pembina, pelatih, dan pengurus')

@section('content')

    <div class="page-head">
        <div>
            <h1>Struktur Organisasi</h1>
            <p>Total {{ $pengurus->total() }} data pengurus tersimpan.</p>
        </div>

        <a href="{{ route('admin.pengurus.create') }}" class="btn btn--gold">+ Tambah Pengurus</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.pengurus.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari nama atau jabatan...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.pengurus.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($pengurus->isEmpty())
            <div class="empty">
                <div class="empty__icon">🎖️</div>
                <p>Belum ada data pengurus.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th style="width:70px;">Urutan</th>
                            <th style="width:70px;">Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengurus as $item)
                            <tr>
                                <td><span class="badge badge--navy">{{ $item->urutan }}</span></td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset($item->foto) }}" alt="" class="thumb thumb--round">
                                    @else
                                        <span class="thumb-empty" style="width:40px;border-radius:50%;">👤</span>
                                    @endif
                                </td>
                                <td><strong>{{ $item->nama }}</strong></td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->periode ?: '—' }}</td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.pengurus.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        <form method="POST" action="{{ route('admin.pengurus.destroy', $item) }}"
                                              data-confirm="Hapus data pengurus &quot;{{ $item->nama }}&quot;?">
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

            <div class="pagination-wrap">{{ $pengurus->links() }}</div>
        @endif
    </div>

@endsection
