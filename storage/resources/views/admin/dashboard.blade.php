@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data website Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Halo, {{ auth()->user()->name }} 👋</h1>
            <p>Berikut ringkasan data yang tersimpan di database saat ini.</p>
        </div>

        <a href="{{ route('admin.berita.create') }}" class="btn btn--gold">+ Tulis Berita</a>
    </div>

    <div class="stat-grid">
        @foreach($statistik as $stat)
            <a href="{{ $stat['route'] }}" class="stat-card">
                <span class="ic">{{ $stat['ikon'] }}</span>
                <div>
                    <div class="val">{{ $stat['nilai'] }}</div>
                    <div class="lbl">{{ $stat['label'] }}</div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="two-col">

        <div class="panel">
            <div class="panel__head">
                <h3>Berita Terbaru</h3>
                <a href="{{ route('admin.berita.index') }}" class="btn btn--light btn--sm">Kelola</a>
            </div>
            <div class="panel__body">
                @if($beritaTerbaru->isEmpty())
                    <div class="empty">
                        <div class="empty__icon">📰</div>
                        <p>Belum ada berita.</p>
                    </div>
                @else
                    <ul class="mini-list">
                        @foreach($beritaTerbaru as $item)
                            <li>
                                @if($item->gambar)
                                    <img src="{{ asset($item->gambar) }}" alt="" class="thumb">
                                @else
                                    <span class="thumb-empty">📰</span>
                                @endif
                                <div style="flex:1;min-width:0;">
                                    <strong>{{ \Illuminate\Support\Str::limit($item->judul, 48) }}</strong>
                                    <small>{{ $item->tanggal?->translatedFormat('d M Y') }} · {{ $item->penulis }}</small>
                                </div>
                                <span class="badge {{ $item->is_published ? 'badge--green' : 'badge--grey' }}">
                                    {{ $item->is_published ? 'Terbit' : 'Draf' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h3>Agenda Terdekat</h3>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn--light btn--sm">Kelola</a>
            </div>
            <div class="panel__body">
                @if($agendaTerdekat->isEmpty())
                    <div class="empty">
                        <div class="empty__icon">📅</div>
                        <p>Belum ada agenda mendatang.</p>
                    </div>
                @else
                    <ul class="mini-list">
                        @foreach($agendaTerdekat as $item)
                            <li>
                                <div class="mini-date">
                                    {{ $item->tanggal?->format('d') }}
                                    <span>{{ $item->tanggal?->translatedFormat('M') }}</span>
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <strong>{{ \Illuminate\Support\Str::limit($item->judul, 44) }}</strong>
                                    <small>{{ $item->lokasi ?: 'Lokasi belum ditentukan' }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>

@endsection
