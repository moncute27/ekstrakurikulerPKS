@extends('backend.layout')

@section('title', 'Kelola Berita')
@section('page_title', 'Kelola Berita & Informasi')
@section('page_subtitle', 'Publikasi artikel, liputan kegiatan, dan pengumuman resmi PKS SMKN 2 Purwakarta')

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
        width: 260px;
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

    .table-container-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .data-table th {
        background: #f8fafc;
        color: var(--pks-navy);
        font-weight: 700;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        border-bottom: 1px solid var(--pks-border);
        text-align: left;
    }

    .data-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .data-table tr:hover td {
        background: #fbfcfe;
    }

    .thumbnail-img {
        width: 65px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid var(--pks-border);
        display: block;
    }

    .badge-category {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        background: #eff6ff;
        color: #1e40af;
    }

    .badge-category.prestasi { background: #fef3c7; color: #b45309; }
    .badge-category.kegiatan { background: #ecfdf5; color: #047857; }
    .badge-category.latihan { background: #f3e8ff; color: #6b21a8; }
    .badge-category.pengumuman { background: #fef2f2; color: #b91c1c; }

    .btn-action-edit {
        background: #fef3c7;
        color: #b45309;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }
    .btn-action-edit:hover { background: #fde68a; }

    .btn-action-delete {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }
    .btn-action-delete:hover { background: #fca5a5; }
</style>
@endpush

@section('content')

<!-- ACTION BAR -->
<div class="action-header-bar">
    <button type="button" class="btn-add-item" onclick="openAddModal()">
        <i class="fa-solid fa-plus"></i> Tambah Berita
    </button>

    <div class="filters-wrapper">
        <form method="GET" action="{{ route('admin.berita') }}" id="filterForm" style="display: flex; gap: 10px; align-items: center;">
            <select name="kategori" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="Semua" {{ $kategori === 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ $kategori === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>

            <div class="search-box-custom">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul berita...">
            </div>
        </form>
    </div>
</div>

<!-- TABLE CARD -->
<div class="table-container-card">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th style="width: 90px;">Foto</th>
                <th>Judul & Ringkasan Berita</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Penulis</th>
                <th style="width: 110px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($berita as $index => $b)
                <tr>
                    <td>{{ $berita->firstItem() + $index }}.</td>
                    <td>
                        @if($b->foto_berita && file_exists(public_path($b->foto_berita)))
                            <img src="{{ asset($b->foto_berita) }}" class="thumbnail-img" alt="{{ $b->judul_berita }}">
                        @else
                            <div class="thumbnail-img" style="background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: var(--pks-gray);">
                                <i class="fa-regular fa-newspaper"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="font-size: 14px; color: var(--pks-navy);">{{ $b->judul_berita }}</strong>
                        <p style="font-size: 12px; color: var(--pks-gray); margin: 4px 0 0 0;">
                            {{ Str::limit($b->isi_berita, 80) }}
                        </p>
                    </td>
                    <td>
                        <span class="badge-category {{ strtolower($b->kategori) }}">{{ $b->kategori }}</span>
                    </td>
                    <td style="color: var(--pks-gray); font-size: 12.5px; white-space: nowrap;">
                        <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ date('d M Y', strtotime($b->tanggal)) }}
                    </td>
                    <td style="font-size: 12.5px;">
                        <i class="fa-regular fa-user" style="font-size: 11px; margin-right: 4px; color: var(--pks-gray);"></i> {{ $b->penulis }}
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $b->id }}, '{{ addslashes($b->judul_berita) }}', '{{ addslashes(preg_replace('/\s+/', ' ', $b->isi_berita)) }}', '{{ $b->tanggal }}', '{{ addslashes($b->penulis) }}', '{{ $b->kategori }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-delete" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--pks-gray); padding: 35px;">
                        <i class="fa-solid fa-newspaper" style="font-size: 30px; margin-bottom: 10px; display: block;"></i>
                        Belum ada data berita.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $berita->firstItem() ?? 0 }} - {{ $berita->lastItem() ?? 0 }} dari {{ $berita->total() }} berita
    </div>
    <div>
        {{ $berita->links() }}
    </div>
</div>

<!-- MODAL TAMBAH BERITA -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-newspaper"></i> Tambah Berita Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_berita">Judul Berita <span class="required">*</span></label>
                    <input type="text" id="judul_berita" name="judul_berita" class="form-control" placeholder="Contoh: Peringatan HUT Bhayangkara Ke-81" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="kategori">Kategori <span class="required">*</span></label>
                        <select id="kategori" name="kategori" class="form-control" required>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Latihan">Latihan</option>
                            <option value="Prestasi">Prestasi</option>
                            <option value="Pengumuman">Pengumuman</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Terbit <span class="required">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="penulis">Nama Penulis</label>
                    <input type="text" id="penulis" name="penulis" class="form-control" value="{{ Auth::user()->nama ?? 'Admin PKS' }}">
                </div>

                <div class="form-group">
                    <label for="isi_berita">Isi Konten Berita <span class="required">*</span></label>
                    <textarea id="isi_berita" name="isi_berita" class="form-control" rows="6" placeholder="Tuliskan isi berita atau dokumentasi kegiatan secara lengkap..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="foto_berita">Foto Dokumentasi</label>
                    <input type="file" id="foto_berita" name="foto_berita" class="form-control" accept="image/*">
                    <small style="color: var(--pks-gray);">Format JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Publikasikan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT BERITA -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Berita</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_judul_berita">Judul Berita <span class="required">*</span></label>
                    <input type="text" id="edit_judul_berita" name="judul_berita" class="form-control" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_kategori">Kategori <span class="required">*</span></label>
                        <select id="edit_kategori" name="kategori" class="form-control" required>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Latihan">Latihan</option>
                            <option value="Prestasi">Prestasi</option>
                            <option value="Pengumuman">Pengumuman</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_tanggal">Tanggal Terbit <span class="required">*</span></label>
                        <input type="date" id="edit_tanggal" name="tanggal" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_penulis">Nama Penulis</label>
                    <input type="text" id="edit_penulis" name="penulis" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit_isi_berita">Isi Konten Berita <span class="required">*</span></label>
                    <textarea id="edit_isi_berita" name="isi_berita" class="form-control" rows="6" required></textarea>
                </div>

                <div class="form-group">
                    <label for="edit_foto_berita">Ganti Foto (Opsional)</label>
                    <input type="file" id="edit_foto_berita" name="foto_berita" class="form-control" accept="image/*">
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

    function openEditModal(id, judul, isi, tanggal, penulis, kategori) {
        document.getElementById('edit_judul_berita').value = judul;
        document.getElementById('edit_isi_berita').value = isi;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('edit_penulis').value = penulis;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('editForm').action = '/backendberita/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
