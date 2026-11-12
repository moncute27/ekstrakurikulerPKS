@extends('layouts.public')

@section('title', 'Prestasi')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Prestasi PKS',
        'sub' => 'Pencapaian anggota PKS dari tingkat sekolah hingga nasional.',
    ])

    <section class="section">
        <div class="container">

            <div class="filter-bar">
                <a href="{{ route('prestasi') }}" class="{{ $tingkatAktif === 'Semua' ? 'is-active' : '' }}">Semua</a>
                @foreach(\App\Models\Prestasi::TINGKAT as $tingkat)
                    <a href="{{ route('prestasi', ['tingkat' => $tingkat]) }}"
                       class="{{ $tingkatAktif === $tingkat ? 'is-active' : '' }}">{{ $tingkat }}</a>
                @endforeach
            </div>

            @if($prestasi->isEmpty())
                <div class="empty">
                    <div class="empty__icon">🏆</div>
                    <p>Belum ada prestasi pada kategori ini.</p>
                </div>
            @else
                <div class="grid grid--2">
                    @foreach($prestasi as $item)
                        <div class="trophy-card">
                            <div class="trophy-card__icon">🏆</div>

                            <div>
                                <span class="chip">🏅 {{ $item->tingkat }}{{ $item->tahun ? ' · '.$item->tahun : '' }}</span>

                                <h3>{{ $item->judul }}</h3>

                                @if($item->penyelenggara)
                                    <p style="font-weight:600;color:var(--navy-600);font-size:.82rem;">{{ $item->penyelenggara }}</p>
                                @endif

                                @if($item->keterangan)
                                    <p>{{ $item->keterangan }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
