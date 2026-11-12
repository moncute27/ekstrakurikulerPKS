@extends('layouts.public')

@section('title', 'Struktur Organisasi')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Struktur Organisasi',
        'sub' => 'Susunan pembina, pelatih, dan pengurus Ekstrakurikuler PKS.',
    ])

    <section class="section">
        <div class="container">

            @if($pengurus->isEmpty())
                <div class="empty">
                    <div class="empty__icon">🎖️</div>
                    <p>Data struktur organisasi belum diisi.</p>
                </div>
            @else
                @php
                    $pimpinan = $pengurus->filter(fn ($p) => in_array($p->jabatan, ['Pembina', 'Pelatih']));
                    $inti = $pengurus->reject(fn ($p) => in_array($p->jabatan, ['Pembina', 'Pelatih']));
                @endphp

                @if($pimpinan->isNotEmpty())
                    <div class="section-head">
                        <div class="section-head__eyebrow">Pembimbing</div>
                        <h2>Pembina &amp; Pelatih</h2>
                    </div>

                    <div class="grid grid--4" style="margin-bottom:3rem;">
                        @foreach($pimpinan as $orang)
                            @include('partials.kartu-pengurus', ['orang' => $orang])
                        @endforeach
                    </div>
                @endif

                @if($inti->isNotEmpty())
                    <div class="section-head">
                        <div class="section-head__eyebrow">Kepengurusan</div>
                        <h2>Pengurus Inti</h2>
                    </div>

                    <div class="grid grid--4">
                        @foreach($inti as $orang)
                            @include('partials.kartu-pengurus', ['orang' => $orang])
                        @endforeach
                    </div>
                @endif
            @endif

        </div>
    </section>

@endsection
