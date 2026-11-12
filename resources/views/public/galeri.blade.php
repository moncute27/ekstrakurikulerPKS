@extends('layouts.public')

@section('title', 'Galeri')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Galeri Kegiatan',
        'sub' => 'Dokumentasi berbagai kegiatan Ekstrakurikuler PKS.',
    ])

    <section class="section">
        <div class="container">

            @if($galeri->isEmpty())
                <div class="empty">
                    <div class="empty__icon">🖼️</div>
                    <p>Belum ada foto dalam galeri.</p>
                </div>
            @else
                <div class="gallery" id="gallery">
                    @foreach($galeri as $foto)
                        <figure data-src="{{ asset($foto->gambar) }}" data-caption="{{ $foto->keterangan ?: $foto->judul }}">
                            <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}" loading="lazy">
                            <figcaption>{{ $foto->judul }}</figcaption>
                        </figure>
                    @endforeach
                </div>

                <div class="pagination-wrap">{{ $galeri->links() }}</div>
            @endif

        </div>
    </section>

    <div class="lightbox" id="lightbox">
        <button class="lightbox__close" id="lightboxClose" type="button" aria-label="Tutup">×</button>
        <img id="lightboxImage" src="" alt="">
        <div class="lightbox__caption" id="lightboxCaption"></div>
    </div>

@endsection

@push('scripts')
<script>
    (function () {
        const lightbox = document.getElementById('lightbox');
        const gambar = document.getElementById('lightboxImage');
        const caption = document.getElementById('lightboxCaption');

        document.querySelectorAll('#gallery figure').forEach(function (figure) {
            figure.addEventListener('click', function () {
                gambar.src = figure.dataset.src;
                caption.textContent = figure.dataset.caption || '';
                lightbox.classList.add('is-open');
            });
        });

        function tutup() {
            lightbox.classList.remove('is-open');
        }

        document.getElementById('lightboxClose').addEventListener('click', tutup);
        lightbox.addEventListener('click', e => { if (e.target === lightbox) tutup(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') tutup(); });
    })();
</script>
@endpush
