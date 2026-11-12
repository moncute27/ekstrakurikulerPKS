@extends('backend.layout')

@section('title', 'Kelola User Admin')
@section('page_title', 'Kelola User & Administrator')
@section('page_subtitle', 'Manajemen akun petugas, pengurus, dan administrator sistem PKS SMKN 2 Purwakarta')

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
        width: 300px;
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

    .badge-role {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
    }
    .badge-role.admin { background: #fee2e2; color: #b91c1c; }
    .badge-role.operator { background: #eff6ff; color: #1e40af; }
    .badge-role.viewer { background: #f1f5f9; color: var(--pks-gray); }

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
        <i class="fa-solid fa-user-plus"></i> Tambah User Admin
    </button>

    <form method="GET" action="{{ route('admin.user') }}" class="search-box-custom">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama, username, email...">
    </form>
</div>

<!-- TABLE CARD -->
<div class="table-container-card">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Email</th>
                <th>Hak Akses (Role)</th>
                <th style="width: 110px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $u)
                <tr>
                    <td>{{ $users->firstItem() + $index }}.</td>
                    <td>
                        <strong style="font-size: 14px; color: var(--pks-navy);">
                            {{ $u->nama }}
                            @if(Auth::id() == $u->id)
                                <span style="font-size: 10px; background: #e0e7ff; color: #3730a3; padding: 2px 6px; border-radius: 4px; margin-left: 6px;">(Anda)</span>
                            @endif
                        </strong>
                    </td>
                    <td style="font-weight: 600; color: var(--pks-dark);">
                        {{ $u->username }}
                    </td>
                    <td style="color: var(--pks-gray); font-size: 12.5px;">
                        {{ $u->email ?: '-' }}
                    </td>
                    <td>
                        @php
                            $roleClass = strtolower($u->role);
                            if(str_contains($roleClass, 'admin')) $cls = 'admin';
                            elseif(str_contains($roleClass, 'operator')) $cls = 'operator';
                            else $cls = 'viewer';
                        @endphp
                        <span class="badge-role {{ $cls }}"><i class="fa-solid fa-shield"></i> {{ $u->role }}</span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $u->id }}, '{{ addslashes($u->nama) }}', '{{ addslashes($u->username) }}', '{{ addslashes($u->email) }}', '{{ $u->role }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            @if(Auth::id() != $u->id)
                                <form action="{{ route('admin.user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $u->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--pks-gray); padding: 35px;">
                        <i class="fa-solid fa-users-slash" style="font-size: 30px; margin-bottom: 10px; display: block;"></i>
                        Belum ada data user.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} user
    </div>
    <div>
        {{ $users->links() }}
    </div>
</div>

<!-- MODAL TAMBAH USER -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-user-plus"></i> Tambah User Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="username">Username <span class="required">*</span></label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Contoh: budi_pks" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="budi@example.com">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="role">Hak Akses (Role) <span class="required">*</span></label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="Administrator">Administrator</option>
                            <option value="Operator">Operator</option>
                            <option value="Viewer">Viewer</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-user-pen"></i> Edit User</h3>
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
                        <label for="edit_username">Username <span class="required">*</span></label>
                        <input type="text" id="edit_username" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" id="edit_email" name="email" class="form-control">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_role">Hak Akses (Role) <span class="required">*</span></label>
                        <select id="edit_role" name="role" class="form-control" required>
                            <option value="Administrator">Administrator</option>
                            <option value="Operator">Operator</option>
                            <option value="Viewer">Viewer</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_password">Password Baru (Opsional)</label>
                        <input type="password" id="edit_password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
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

    function openEditModal(id, nama, username, email, role) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_password').value = '';
        document.getElementById('editForm').action = '/backenduser/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
