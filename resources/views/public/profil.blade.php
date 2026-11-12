@extends('layouts.public')

@section('title', 'Profil')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Profil Ekstrakurikuler',
        'sub' => $detail->deskripsi_singkat,
    ])

    <section class="section">
        <div class="container profile-grid">

            <div class="prose">
                <h2>Tentang {{ $detail->nama_ekskul }}</h2>
                @forelse(preg_split('/\r\n|\r|\n/', (string) $detail->sejarah) as $paragraf)
                    @if(trim($paragraf) !== '')
                        <p>{{ $paragraf }}</p>
                    @endif
                @empty
                    <p>Belum ada deskripsi.</p>
                @endforelse

                @if($detail->visi)
                    <h2>Visi</h2>
                    <p>{{ $detail->visi }}</p>
                @endif

                @if(count($detail->misiList()))
                    <h2>Misi</h2>
                    <ul class="check-list">
                        @foreach($detail->misiList() as $misi)
                            <li>{{ $misi }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <aside>
                <ul class="info-list">
                    <li>
                        <span class="ic">🏫</span>
                        <div>
                            <span>Sekolah</span>
                            <strong>{{ $detail->nama_sekolah }}</strong>
                        </div>
                    </li>
                    <li>
                        <span class="ic">👥</span>
                        <div>
                            <span>Ekstrakurikuler</span>
                            <strong>{{ $detail->nama_ekskul }}</strong>
                        </div>
                    </li>
                    @if($detail->alamat)
                        <li>
                            <span class="ic">📍</span>
                            <div>
                                <span>Alamat</span>
                                <strong>{{ $detail->alamat }}</strong>
                            </div>
                        </li>
                    @endif
                    @if($detail->telepon)
                        <li>
                            <span class="ic">📞</span>
                            <div>
                                <span>Telepon</span>
                                <strong>{{ $detail->telepon }}</strong>
                            </div>
                        </li>
                    @endif
                    @if($detail->email)
                        <li>
                            <span class="ic">✉️</span>
                            <div>
                                <span>Email</span>
                                <strong>{{ $detail->email }}</strong>
                            </div>
                        </li>
                    @endif
                    @if($detail->instagram)
                        <li>
                            <span class="ic">📷</span>
                            <div>
                                <span>Instagram</span>
                                <strong>{{ $detail->instagram }}</strong>
                            </div>
                        </li>
                    @endif
                </ul>

                <div style="margin-top:1.2rem;">
                    <a href="{{ route('organisasi') }}" class="btn btn--outline btn-block">Lihat Struktur Organisasi</a>
                </div>
            </aside>

        </div>
    </section>

@endsection
