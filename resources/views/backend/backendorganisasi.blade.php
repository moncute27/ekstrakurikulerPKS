@extends('backend.layout')

@section('title', 'Kelola Organisasi')
@section('page_title', 'Struktur Organisasi PKS')
@section('page_subtitle', 'Kelola daftar Pembina, Pelatih, dan Pengurus Inti PKS SMKN 2 Purwakarta')

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

    .search-box-custom {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid var(--pks-border);
        border-radius: 10px;
        padding: 4px 14px;
        width: 320px;
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
        font-size: 13.5px;
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

    .avatar-small {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--pks-border);
        display: block;
    }

    .avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pks-gray);
        font-size: 18px;
        border: 2px solid var(--pks-border);
    }

    .badge-jabatan {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        background: #eff6ff;
        color: #1d4ed8;
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
    .btn-action-edit:hover {
        background: #fde68a;
    }

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
    .btn-action-delete:hover {
        background: #fca5a5;
    }
</style>
@endpush

@section('content')

<!-- ACTION BAR -->
<div class="action-header-bar">
    <button type="button" class="btn-add-item" onclick="openAddModal()">
        <i class="fa-solid fa-plus"></i> Tambah Pengurus
    </button>

    <form method="GET" action="{{ route('admin.organisasi') }}" class="search-box-custom">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama atau jabatan...">
    </form>
</div>

<!-- TABLE CARD -->
<div class="table-container-card">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 60px;">No.</th>
                <th style="width: 80px;">Foto</th>
                <th>Nama Pengurus</th>
                <th>Jabatan</th>
                <th style="width: 120px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($organisasi as $index => $org)
                <tr>
                    <td>{{ $organisasi->firstItem() + $index }}.</td>
                    <td>
                        @if($org->foto_pengurus && file_exists(public_path($org->foto_pengurus)))
                            <img src="{{ asset($org->foto_pengurus) }}" class="avatar-small" alt="{{ $org->nama_pengurus }}">
                        @else
                            <div class="avatar-placeholder">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $org->nama_pengurus }}</strong>
                    </td>
                    <td>
                        <span class="badge-jabatan">{{ $org->jabatan }}</span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $org->id }}, '{{ addslashes($org->nama_pengurus) }}', '{{ addslashes($org->jabatan) }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('admin.organisasi.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengurus {{ $org->nama_pengurus }}?');">
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
                    <td colspan="5" style="text-align: center; color: var(--pks-gray); padding: 30px;">
                        <i class="fa-solid fa-folder-open" style="font-size: 28px; margin-bottom: 10px; display: block;"></i>
                        Belum ada data struktur organisasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $organisasi->firstItem() ?? 0 }} - {{ $organisasi->lastItem() ?? 0 }} dari {{ $organisasi->total() }} data pengurus
    </div>
    <div>
        {{ $organisasi->links() }}
    </div>
</div>

<!-- MODAL TAMBAH PENGURUS -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-user-plus"></i> Tambah Pengurus Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.organisasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_pengurus">Nama Pengurus / Pembina <span class="required">*</span></label>
                    <input type="text" id="nama_pengurus" name="nama_pengurus" class="form-control" placeholder="Contoh: Lilis Aisyah Yuniarti, S.Pd." required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan <span class="required">*</span></label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Contoh: Pembina, Pelatih, Ketua Umum" required>
                </div>

                <div class="form-group">
                    <label for="foto_pengurus">Foto Pengurus</label>
                    <input type="file" id="foto_pengurus" name="foto_pengurus" class="form-control" accept="image/*">
                    <small style="color: var(--pks-gray);">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Pengurus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT PENGURUS -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Data Pengurus</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_nama_pengurus">Nama Pengurus <span class="required">*</span></label>
                    <input type="text" id="edit_nama_pengurus" name="nama_pengurus" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit_jabatan">Jabatan <span class="required">*</span></label>
                    <input type="text" id="edit_jabatan" name="jabatan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit_foto_pengurus">Ganti Foto (Opsional)</label>
                    <input type="file" id="edit_foto_pengurus" name="foto_pengurus" class="form-control" accept="image/*">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Update Data</button>
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

    function openEditModal(id, nama, jabatan) {
        document.getElementById('edit_nama_pengurus').value = nama;
        document.getElementById('edit_jabatan').value = jabatan;
        document.getElementById('editForm').action = '/backendorganisasi/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
