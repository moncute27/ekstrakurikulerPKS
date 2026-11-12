@extends('backend.layout')

@section('title', 'Kelola Anggota')
@section('page_title', 'Kelola Data Anggota PKS')
@section('page_subtitle', 'Data anggota aktif, rekap kelas, angkatan, dan status keanggotaan PKS SMKN 2 Purwakarta')

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

    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
    }

    .badge-status.aktif {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .badge-status.nonaktif {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .gender-icon {
        font-size: 14px;
        margin-right: 4px;
    }
    .gender-icon.male { color: #2563eb; }
    .gender-icon.female { color: #db2777; }

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
        <i class="fa-solid fa-user-plus"></i> Tambah Anggota
    </button>

    <div class="filters-wrapper">
        <form method="GET" action="{{ route('admin.anggota') }}" id="filterForm" style="display: flex; gap: 10px;">
            <select name="angkatan" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="Semua" {{ $angkatan === 'Semua' ? 'selected' : '' }}>Semua Angkatan</option>
                @foreach($angkatanList as $akt)
                    <option value="{{ $akt }}" {{ $angkatan === $akt ? 'selected' : '' }}>Angkatan {{ $akt }}</option>
                @endforeach
            </select>

            <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="Semua" {{ $status === 'Semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="Aktif" {{ $status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $status === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>

            <div class="search-box-custom">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama atau kelas...">
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
                <th>Nama Anggota</th>
                <th>Kelas</th>
                <th>Gender</th>
                <th>Angkatan</th>
                <th>Status</th>
                <th style="width: 110px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggota as $index => $a)
                <tr>
                    <td>{{ $anggota->firstItem() + $index }}.</td>
                    <td>
                        <strong style="font-size: 14px; color: var(--pks-navy);">{{ $a->nama }}</strong>
                    </td>
                    <td>
                        <span style="font-weight: 600; color: #334155;">{{ $a->kelas }}</span>
                    </td>
                    <td>
                        @if(strtolower($a->jenis_kelamin) == 'laki laki')
                            <span class="gender-icon male"><i class="fa-solid fa-mars"></i> Laki-laki</span>
                        @else
                            <span class="gender-icon female"><i class="fa-solid fa-venus"></i> Perempuan</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight: 600; color: var(--pks-navy);">{{ $a->angkatan }}</span>
                    </td>
                    <td>
                        <span class="badge-status {{ strtolower($a->status_keanggotan) == 'aktif' ? 'aktif' : 'nonaktif' }}">
                            {{ $a->status_keanggotan }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $a->id }}, '{{ addslashes($a->nama) }}', '{{ addslashes($a->kelas) }}', '{{ $a->jenis_kelamin }}', '{{ $a->angkatan }}', '{{ $a->status_keanggotan }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('admin.anggota.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?');">
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
                        <i class="fa-solid fa-user-shield" style="font-size: 30px; margin-bottom: 10px; display: block;"></i>
                        Belum ada data anggota.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $anggota->firstItem() ?? 0 }} - {{ $anggota->lastItem() ?? 0 }} dari {{ $anggota->total() }} anggota
    </div>
    <div>
        {{ $anggota->links() }}
    </div>
</div>

<!-- MODAL TAMBAH ANGGOTA -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-user-plus"></i> Tambah Anggota PKS</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.anggota.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Tri Rahayu" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="kelas">Kelas / Jurusan <span class="required">*</span></label>
                        <input type="text" id="kelas" name="kelas" class="form-control" placeholder="Contoh: XI RPL 2" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="perempuan">Perempuan</option>
                            <option value="laki laki">Laki-laki</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="angkatan">Tahun Angkatan <span class="required">*</span></label>
                        <input type="text" id="angkatan" name="angkatan" class="form-control" value="{{ date('Y') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status_keanggotan">Status Keanggotaan <span class="required">*</span></label>
                        <select id="status_keanggotan" name="status_keanggotan" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Anggota</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT ANGGOTA -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-user-pen"></i> Edit Data Anggota</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_nama">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="edit_nama" name="nama" class="form-control" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_kelas">Kelas / Jurusan <span class="required">*</span></label>
                        <input type="text" id="edit_kelas" name="kelas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                        <select id="edit_jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="perempuan">Perempuan</option>
                            <option value="laki laki">Laki-laki</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_angkatan">Tahun Angkatan <span class="required">*</span></label>
                        <input type="text" id="edit_angkatan" name="angkatan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_status_keanggotan">Status Keanggotaan <span class="required">*</span></label>
                        <select id="edit_status_keanggotan" name="status_keanggotan" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
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

    function openEditModal(id, nama, kelas, jk, angkatan, status) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_kelas').value = kelas;
        document.getElementById('edit_jenis_kelamin').value = jk;
        document.getElementById('edit_angkatan').value = angkatan;
        document.getElementById('edit_status_keanggotan').value = status;
        document.getElementById('editForm').action = '/backendanggota/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
