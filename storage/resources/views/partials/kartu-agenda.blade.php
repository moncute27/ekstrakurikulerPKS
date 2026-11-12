<div class="agenda-item {{ ($item->tanggal && $item->tanggal->isPast()) ? 'agenda-item--past' : '' }}">

    <div class="date-box">
        <div class="d">{{ $item->tanggal?->format('d') }}</div>
        <div class="m">{{ $item->tanggal?->translatedFormat('M') }}</div>
        <div class="y">{{ $item->tanggal?->format('Y') }}</div>
    </div>

    <div>
        <h3>{{ $item->judul }}</h3>

        @if($item->deskripsi)
            <p>{{ $item->deskripsi }}</p>
        @endif

        <div class="agenda-meta">
            @if($item->waktu)
                <span>🕒 {{ \Illuminate\Support\Carbon::parse($item->waktu)->format('H:i') }} WIB</span>
            @endif
            @if($item->lokasi)
                <span>📍 {{ $item->lokasi }}</span>
            @endif
        </div>
    </div>

</div>
