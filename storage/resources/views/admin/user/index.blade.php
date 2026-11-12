@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('subtitle', 'Akun yang dapat mengakses panel admin')

@section('content')

    <div class="page-head">
        <div>
            <h1>Manajemen User</h1>
            <p>Total {{ $users->total() }} akun terdaftar.</p>
        </div>

        <a href="{{ route('admin.user.create') }}" class="btn btn--gold">+ Tambah User</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.user.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari nama atau email...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.user.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($users->isEmpty())
            <div class="empty">
                <div class="empty__icon">🔑</div>
                <p>Tidak ada akun yang cocok.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Dibuat</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.7rem;">
                                        @if($item->foto)
                                            <img src="{{ asset($item->foto) }}" alt="" class="thumb thumb--round">
                                        @else
                                            <span class="thumb-empty" style="width:40px;border-radius:50%;">
                                                {{ strtoupper(substr($item->name, 0, 1)) }}
                                            </span>
                                        @endif
                                        <strong>
                                            {{ $item->name }}
                                            @if($item->id === auth()->id())
                                                <span class="badge badge--navy">Anda</span>
                                            @endif
                                        </strong>
                                    </div>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <span class="badge {{ $item->role === 'admin' ? 'badge--gold' : ($item->role === 'pengurus' ? 'badge--navy' : 'badge--grey') }}">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at?->translatedFormat('d M Y') }}</td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.user.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        @if($item->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.user.destroy', $item) }}"
                                                  data-confirm="Hapus akun &quot;{{ $item->name }}&quot;?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn--danger btn-icon" title="Hapus">🗑</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">{{ $users->links() }}</div>
        @endif
    </div>

@endsection
