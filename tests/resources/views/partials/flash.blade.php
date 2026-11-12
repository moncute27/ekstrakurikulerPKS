@if(session('sukses'))
    <div class="alert alert--success">
        <span>✅</span>
        <div>{{ session('sukses') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert--danger">
        <span>⚠️</span>
        <div>
            <strong>Terjadi kesalahan, periksa kembali isian Anda.</strong>
            <ul>
                @foreach($errors->all() as $pesan)
                    <li>{{ $pesan }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
