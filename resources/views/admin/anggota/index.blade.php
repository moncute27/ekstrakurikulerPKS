@extends('layouts.admin')

@section('title', 'Kelola Anggota')
@section('subtitle', 'Data anggota Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Kelola Anggota</h1>
            <p>Total {{ $anggota->total() }} anggota terdaftar.</p>
        </div>

        <a href="{{ route('admin.anggota.create') }}" class="btn btn--gold">+ Tambah Anggota</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.anggota.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari nama, NIS, atau kelas...">

            <select name="status">
                <option value="">Semua Status</option>
                @foreach(\App\Models\Anggota::STATUS as $opsi)
                    <option value="{{ $opsi }}" @selected($status === $opsi)>{{ $opsi }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn--primary">Filter</button>
            @if($cari || $status)
                <a href="{{ route('admin.anggota.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($anggota->isEmpty())
            <div class="empty">
                <div class="empty__icon">👥</div>
                <p>Tidak ada data anggota yang cocok.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jabatan</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $i => $item)
                            <tr>
                                <td>{{ $anggota->firstItem() + $i }}</td>
                                <td>
                                    <div class="cell-user" style="display:flex;align-items:center;gap:.7rem;">
                                        @if($item->foto)
                                            <img src="{{ asset($item->foto) }}" alt="" class="thumb thumb--round">
                                        @else
                                            <span class="thumb-empty" style="width:40px;border-radius:50%;">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </span>
                                        @endif
                                        <strong>{{ $item->nama }}</strong>
                                    </div>
                                </td>
                                <td>{{ $item->nis ?: '—' }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->angkatan }}</td>
                                <td>
                                    <span class="badge {{ $item->status === 'Aktif' ? 'badge--green' : 'badge--grey' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.anggota.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        <form method="POST" action="{{ route('admin.anggota.destroy', $item) }}"
                                              data-confirm="Hapus anggota &quot;{{ $item->nama }}&quot;?">
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

            <div class="pagination-wrap">{{ $anggota->links() }}</div>
        @endif
    </div>

@endsection
