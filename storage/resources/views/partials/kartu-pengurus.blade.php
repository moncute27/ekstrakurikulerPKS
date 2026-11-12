<div class="person">
    @if($orang->foto)
        <img src="{{ asset($orang->foto) }}" alt="{{ $orang->nama }}" class="person__photo" loading="lazy">
    @else
        <div class="person__avatar">{{ strtoupper(substr($orang->nama, 0, 1)) }}</div>
    @endif

    <h3>{{ $orang->nama }}</h3>
    <div class="person__role">{{ $orang->jabatan }}</div>

    @if($orang->periode)
        <div class="person__period">Periode {{ $orang->periode }}</div>
    @endif
</div>
