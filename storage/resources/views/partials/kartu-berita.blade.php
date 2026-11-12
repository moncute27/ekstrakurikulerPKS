<article class="card">

    <a href="{{ route('berita.show', $item) }}" class="card__media">
        @if($item->gambar)
            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">
        @else
            <img src="{{ asset('img/logo pks.jpeg') }}" alt="{{ $item->judul }}" loading="lazy">
        @endif
    </a>

    <div class="card__body">
        <span class="chip chip--navy">{{ $item->kategori }}</span>

        <h3 style="margin-top:.6rem;">
            <a href="{{ route('berita.show', $item) }}">{{ $item->judul }}</a>
        </h3>

        <p>{{ \Illuminate\Support\Str::limit($item->ringkasan ?: strip_tags($item->isi), 120) }}</p>

        <div class="card__meta">
            <span>{{ $item->tanggal?->translatedFormat('d M Y') }}</span>
            <a href="{{ route('berita.show', $item) }}" class="card__link">Baca →</a>
        </div>
    </div>

</article>
