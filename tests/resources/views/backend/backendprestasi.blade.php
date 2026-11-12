@extends('backend.layout')

@section('title', 'Kelola Prestasi')
@section('page_title', 'Kelola Prestasi & Penghargaan')
@section('page_subtitle', 'Pencatatan rekam jejak medali, piala, dan kejuaraan PKS SMKN 2 Purwakarta')

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

    .trophy-badge {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: #fef3c7;
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 2px 8px rgba(217, 119, 6, 0.2);
    }

    .badge-tingkat {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        background: #eff6ff;
        color: #1e40af;
    }

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
        <i class="fa-solid fa-plus"></i> Tambah Prestasi
    </button>

    <div class="filters-wrapper">
        <form method="GET" action="{{ route('admin.prestasi') }}" id="filterForm" style="display: flex; gap: 10px;">
            <select name="tingkat" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="Semua" {{ $tingkat === 'Semua' ? 'selected' : '' }}>Semua Tingkat</option>
                <option value="Kabupaten" {{ $tingkat === 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                <option value="Provinsi" {{ $tingkat === 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                <option value="Nasional" {{ $tingkat === 'Nasional' ? 'selected' : '' }}>Nasional</option>
            </select>

            <div class="search-box-custom">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama kejuaraan...">
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
                <th style="width: 60px;">Piala</th>
                <th>Nama Prestasi & Deskripsi</th>
                <th>Tingkat</th>
                <th>Predikat / Juara</th>
                <th>Tahun</th>
                <th style="width: 110px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasi as $index => $p)
                <tr>
                    <td>{{ $prestasi->firstItem() + $index }}.</td>
                    <td>
                        <div class="trophy-badge">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                    </td>
                    <td>
                        <strong style="font-size: 14px; color: var(--pks-navy);">{{ $p->nama }}</strong>
                        <p style="font-size: 12px; color: var(--pks-gray); margin: 3px 0 0 0;">
                            {{ Str::limit($p->deskripsi, 80) }}
                        </p>
                    </td>
                    <td>
                        <span class="badge-tingkat">{{ $p->tingkat_lomba }}</span>
                    </td>
                    <td>
                        <strong style="color: #b45309;">{{ $p->juara }}</strong>
                    </td>
                    <td style="color: var(--pks-gray); font-size: 12.5px;">
                        {{ $p->tahun ?? '-' }}
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $p->id }}, '{{ addslashes($p->nama) }}', '{{ addslashes($p->tingkat_lomba) }}', '{{ addslashes($p->juara) }}', '{{ $p->tahun }}', '{{ addslashes(preg_replace('/\s+/', ' ', $p->deskripsi)) }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('admin.prestasi.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?');">
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
                        <i class="fa-solid fa-trophy" style="font-size: 30px; margin-bottom: 10px; display: block;"></i>
                        Belum ada data prestasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $prestasi->firstItem() ?? 0 }} - {{ $prestasi->lastItem() ?? 0 }} dari {{ $prestasi->total() }} prestasi
    </div>
    <div>
        {{ $prestasi->links() }}
    </div>
</div>

<!-- MODAL TAMBAH PRESTASI -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-trophy"></i> Tambah Prestasi Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Lomba / Prestasi <span class="required">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Juara 1 Lomba PBB Presisi" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="tingkat_lomba">Tingkat Perlombaan <span class="required">*</span></label>
                        <select id="tingkat_lomba" name="tingkat_lomba" class="form-control" required>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="juara">Predikat Juara <span class="required">*</span></label>
                        <input type="text" id="juara" name="juara" class="form-control" placeholder="Contoh: Juara 1 / Harapan 1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun Prestasi</label>
                    <input type="text" id="tahun" name="tahun" class="form-control" value="{{ date('Y') }}">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Prestasi <span class="required">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan rincian kejuaraan dan penyelenggara..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto Dokumentasi Piala/Sertifikat (Opsional)</label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Prestasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT PRESTASI -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Prestasi</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_nama">Nama Lomba / Prestasi <span class="required">*</span></label>
                    <input type="text" id="edit_nama" name="nama" class="form-control" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_tingkat_lomba">Tingkat Perlombaan <span class="required">*</span></label>
                        <select id="edit_tingkat_lomba" name="tingkat_lomba" class="form-control" required>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_juara">Predikat Juara <span class="required">*</span></label>
                        <input type="text" id="edit_juara" name="juara" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_tahun">Tahun Prestasi</label>
                    <input type="text" id="edit_tahun" name="tahun" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit_deskripsi">Deskripsi Prestasi <span class="required">*</span></label>
                    <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="edit_foto">Ganti Foto (Opsional)</label>
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

    function openEditModal(id, nama, tingkat, juara, tahun, deskripsi) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_tingkat_lomba').value = tingkat;
        document.getElementById('edit_juara').value = juara;
        document.getElementById('edit_tahun').value = tahun;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('editForm').action = '/backendprestasi/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
