@extends('layouts.public')

@section('title', 'Anggota')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Daftar Anggota',
        'sub' => 'Anggota aktif Ekstrakurikuler PKS dari berbagai angkatan.',
    ])

    <section class="section">
        <div class="container">

            <form class="search-form" method="GET" action="{{ route('anggota') }}">
                <input type="text" name="cari" value="{{ $cari }}" placeholder="Cari nama atau kelas...">

                <select name="angkatan">
                    <option value="">Semua Angkatan</option>
                    @foreach($daftarAngkatan as $item)
                        <option value="{{ $item }}" @selected($angkatan == $item)>Angkatan {{ $item }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn--outline">Cari</button>
            </form>

            @if($anggota->isEmpty())
                <div class="empty">
                    <div class="empty__icon">👥</div>
                    <p>Data anggota tidak ditemukan.</p>
                </div>
            @else
                <div class="table-wrap">
                    <div class="table-scroll">
                        <table class="data">
                            <thead>
                                <tr>
                                    <th style="width:60px;">No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jabatan</th>
                                    <th>Angkatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggota as $i => $item)
                                    <tr>
                                        <td>{{ $anggota->firstItem() + $i }}</td>
                                        <td>
                                            <div class="cell-user">
                                                @if($item->foto)
                                                    <img src="{{ asset($item->foto) }}" alt="" class="avatar-sm">
                                                @else
                                                    <span class="avatar-initial">{{ strtoupper(substr($item->nama, 0, 1)) }}</span>
                                                @endif
                                                <strong>{{ $item->nama }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->angkatan }}</td>
                                        <td>
                                            <span class="chip {{ $item->status === 'Aktif' ? 'chip--green' : 'chip--grey' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pagination-wrap">{{ $anggota->links() }}</div>
            @endif

        </div>
    </section>

@endsection
