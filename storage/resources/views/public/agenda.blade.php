@extends('layouts.public')

@section('title', 'Agenda')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Agenda Kegiatan',
        'sub' => 'Jadwal kegiatan Ekstrakurikuler PKS yang akan dan telah dilaksanakan.',
    ])

    <section class="section">
        <div class="container">

            <div class="section-head section-head--left">
                <div class="section-head__eyebrow">Mendatang</div>
                <h2>Kegiatan Yang Akan Datang</h2>
            </div>

            @if($mendatang->isEmpty())
                <div class="empty">
                    <div class="empty__icon">📅</div>
                    <p>Belum ada agenda mendatang yang dijadwalkan.</p>
                </div>
            @else
                <div class="grid" style="gap:1rem;">
                    @foreach($mendatang as $item)
                        @include('partials.kartu-agenda', ['item' => $item])
                    @endforeach
                </div>
            @endif

            @if($lampau->isNotEmpty())
                <div class="section-head section-head--left" style="margin-top:3rem;">
                    <div class="section-head__eyebrow">Arsip</div>
                    <h2>Kegiatan Yang Telah Berlalu</h2>
                </div>

                <div class="grid" style="gap:1rem;">
                    @foreach($lampau as $item)
                        @include('partials.kartu-agenda', ['item' => $item])
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
