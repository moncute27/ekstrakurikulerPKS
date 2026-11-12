@extends('backend.layout')

@section('title', 'Kelola Galeri')
@section('page_title', 'Galeri Dokumentasi Foto')
@section('page_subtitle', 'Dokumentasi visual apel, latihan, upacara, dan kegiatan ekstrakurikuler PKS')

@push('styles')
<style>
    .action-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .filters-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-select {
        padding: 9px 14px;
        border: 1.5px solid var(--pks-border);
        border-radius: 10px;
        font-size: 13px;
        color: var(--pks-dark);
        outline: none;
        background: #ffffff;
        cursor: pointer;
    }

    .search-box-custom {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid var(--pks-border);
        border-radius: 10px;
        padding: 4px 14px;
        width: 250px;
        max-width: 100%;
    }

    .search-box-custom i {
        color: var(--pks-gray);
        margin-right: 10px;
    }

    .search-box-custom input {
        border: none;
        outline: none;
        padding: 8px 0;
        font-size: 13px;
        width: 100%;
        font-family: inherit;
    }

    .btn-add-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--pks-red) 0%, #991b1b 100%);
        color: #ffffff;
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(197, 22, 29, 0.25);
        transition: 0.2s;
    }
    .btn-add-item:hover {
        background: #a51319;
        transform: translateY(-2px);
    }

    /* GALLERY GRID */
    .gallery-admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .gallery-item-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--pks-border);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        transition: 0.25s;
    }
    .gallery-item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .gallery-thumb-wrap {
        height: 170px;
        width: 100%;
        position: relative;
        background: #f1f5f9;
        overflow: hidden;
    }

    .gallery-thumb-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .gallery-item-card:hover .gallery-thumb-wrap img {
        transform: scale(1.05);
    }

    .gallery-cat-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(11, 30, 54, 0.85);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .gallery-item-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .gallery-item-title {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--pks-dark);
        margin: 0 0 14px 0;
        line-height: 1.4;
    }

    .gallery-item-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
    }
</style>
@endpush

@section('content')

<!-- ACTION BAR -->
<div class="action-header-bar">
    <button type="button" class="btn-add-item" onclick="openAddModal()">
        <i class="fa-solid fa-cloud-arrow-up"></i> Upload Foto Baru
    </button>

    <div class="filters-wrapper">
        <form method="GET" action="{{ route('admin.galeri') }}" id="filterForm" style="display: flex; gap: 10px;">
            <select name="kategori" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="Semua" {{ $kategori === 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ $kategori === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <div class="search-box-custom">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari foto kegiatan...">
            </div>
        </form>
    </div>
</div>

<!-- GALLERY GRID -->
<div class="gallery-admin-grid">
    @forelse($galeri as $item)
        <div class="gallery-item-card">
            <div class="gallery-thumb-wrap">
                <img src="{{ asset($item->foto) }}" alt="{{ $item->judul }}">
                <span class="gallery-cat-badge"><i class="fa-solid fa-tag"></i> {{ $item->kategori }}</span>
            </div>
            <div class="gallery-item-body">
                <h4 class="gallery-item-title">{{ $item->judul }}</h4>
                <div class="gallery-item-actions">
                    <button type="button" class="btn-action-edit" title="Edit"
                        onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->judul) }}', '{{ $item->kategori }}')">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action-delete" title="Hapus">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; background: #ffffff; padding: 50px; text-align: center; border-radius: 16px; border: 1px solid var(--pks-border); color: var(--pks-gray);">
            <i class="fa-regular fa-image" style="font-size: 38px; margin-bottom: 12px; display: block;"></i>
            Belum ada dokumentasi foto galeri.
        </div>
    @endforelse
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $galeri->firstItem() ?? 0 }} - {{ $galeri->lastItem() ?? 0 }} dari {{ $galeri->total() }} foto
    </div>
    <div>
        {{ $galeri->links() }}
    </div>
</div>

<!-- MODAL TAMBAH FOTO -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-camera"></i> Upload Foto Kegiatan</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul">Judul / Keterangan Foto <span class="required">*</span></label>
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Contoh: Latihan 12 Gerakan Pengaturan Lalu Lintas" required>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Album <span class="required">*</span></label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Pelatihan">Pelatihan</option>
                        <option value="Upacara">Upacara</option>
                        <option value="Lomba">Lomba</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">File Foto <span class="required">*</span></label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*" required>
                    <small style="color: var(--pks-gray);">Format JPG, PNG, WEBP. Maks 3MB.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Foto</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT FOTO -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Foto Galeri</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_judul">Judul / Keterangan Foto <span class="required">*</span></label>
                    <input type="text" id="edit_judul" name="judul" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit_kategori">Kategori Album <span class="required">*</span></label>
                    <select id="edit_kategori" name="kategori" class="form-control" required>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Pelatihan">Pelatihan</option>
                        <option value="Upacara">Upacara</option>
                        <option value="Lomba">Lomba</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_foto">Ganti File Foto (Opsional)</label>
                    <input type="file" id="edit_foto" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('addModal').classList.add('show');
    }

    function openEditModal(id, judul, kategori) {
        document.getElementById('edit_judul').value = judul;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('editForm').action = '/backendgaleri/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
