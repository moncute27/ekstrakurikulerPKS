@extends('backend.layout')

@section('title', 'Kelola Agenda')
@section('page_title', 'Kelola Agenda Patroli & Kegiatan')
@section('page_subtitle', 'Jadwal apel, latihan gabungan, piket gerbang, dan kegiatan seremonial PKS')

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

    .date-badge-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--pks-navy);
        color: #ffffff;
        border-radius: 8px;
        padding: 6px 10px;
        min-width: 55px;
    }
    .date-badge-col .day {
        font-size: 16px;
        font-weight: 800;
        line-height: 1;
    }
    .date-badge-col .month {
        font-size: 9px;
        text-transform: uppercase;
        color: var(--pks-gold-light);
        margin-top: 3px;
        font-weight: 700;
    }

    .badge-upcoming {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 999px;
    }

    .badge-past {
        background: #f1f5f9;
        color: var(--pks-gray);
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
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
        <i class="fa-solid fa-plus"></i> Tambah Agenda
    </button>

    <form method="GET" action="{{ route('admin.agenda') }}" class="search-box-custom">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama, tempat, atau keterangan...">
    </form>
</div>

<!-- TABLE CARD -->
<div class="table-container-card">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 50px;">No.</th>
                <th style="width: 80px;">Jadwal</th>
                <th>Nama Kegiatan & Keterangan</th>
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Status</th>
                <th style="width: 110px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agenda as $index => $ag)
                <tr>
                    <td>{{ $agenda->firstItem() + $index }}.</td>
                    <td>
                        <div class="date-badge-col">
                            <span class="day">{{ date('d', strtotime($ag->tanggal)) }}</span>
                            <span class="month">{{ date('M Y', strtotime($ag->tanggal)) }}</span>
                        </div>
                    </td>
                    <td>
                        <strong style="font-size: 14px; color: var(--pks-navy);">{{ $ag->nama }}</strong>
                        <p style="font-size: 12px; color: var(--pks-gray); margin: 4px 0 0 0;">
                            {{ Str::limit($ag->keterangan, 85) }}
                        </p>
                    </td>
                    <td style="font-size: 12.5px; white-space: nowrap;">
                        <i class="fa-regular fa-clock" style="color: var(--pks-gold); margin-right: 4px;"></i> {{ substr($ag->waktu, 0, 5) }} WIB
                    </td>
                    <td style="font-size: 12.5px;">
                        <i class="fa-solid fa-location-dot" style="color: var(--pks-red); margin-right: 4px;"></i> {{ $ag->tempat }}
                    </td>
                    <td>
                        @if($ag->tanggal >= now()->toDateString())
                            <span class="badge-upcoming"><i class="fa-solid fa-hourglass-half"></i> Mendatang</span>
                        @else
                            <span class="badge-past">Selesai</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div style="display: inline-flex; gap: 8px;">
                            <button type="button" class="btn-action-edit" title="Edit"
                                onclick="openEditModal({{ $ag->id }}, '{{ addslashes($ag->nama) }}', '{{ $ag->tanggal }}', '{{ substr($ag->waktu, 0, 5) }}', '{{ addslashes($ag->tempat) }}', '{{ addslashes(preg_replace('/\s+/', ' ', $ag->keterangan)) }}')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <form action="{{ route('admin.agenda.destroy', $ag->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda kegiatan ini?');">
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
                        <i class="fa-solid fa-calendar-xmark" style="font-size: 30px; margin-bottom: 10px; display: block;"></i>
                        Belum ada agenda kegiatan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-container">
    <div>
        Menampilkan {{ $agenda->firstItem() ?? 0 }} - {{ $agenda->lastItem() ?? 0 }} dari {{ $agenda->total() }} agenda
    </div>
    <div>
        {{ $agenda->links() }}
    </div>
</div>

<!-- MODAL TAMBAH AGENDA -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-calendar-plus"></i> Tambah Agenda Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.agenda.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Kegiatan / Patroli <span class="required">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Latihan Gabungan PKS se-Purwakarta" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Pelaksanaan <span class="required">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="waktu">Waktu (Jam Mulai) <span class="required">*</span></label>
                        <input type="time" id="waktu" name="waktu" class="form-control" value="07:30" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tempat">Lokasi / Tempat <span class="required">*</span></label>
                    <input type="text" id="tempat" name="tempat" class="form-control" placeholder="Contoh: Lapangan Utama SMKN 2 Purwakarta" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan / Rincian Kegiatan <span class="required">*</span></label>
                    <textarea id="keterangan" name="keterangan" class="form-control" rows="4" placeholder="Tuliskan petunjuk pakaian/seragam, perlengkapan, atau tujuan kegiatan..." required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Agenda</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT AGENDA -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Agenda</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_nama">Nama Kegiatan <span class="required">*</span></label>
                    <input type="text" id="edit_nama" name="nama" class="form-control" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="edit_tanggal">Tanggal Pelaksanaan <span class="required">*</span></label>
                        <input type="date" id="edit_tanggal" name="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_waktu">Waktu (Jam Mulai) <span class="required">*</span></label>
                        <input type="time" id="edit_waktu" name="waktu" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_tempat">Lokasi / Tempat <span class="required">*</span></label>
                    <input type="text" id="edit_tempat" name="tempat" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit_keterangan">Keterangan Kegiatan <span class="required">*</span></label>
                    <textarea id="edit_keterangan" name="keterangan" class="form-control" rows="4" required></textarea>
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

    function openEditModal(id, nama, tanggal, waktu, tempat, keterangan) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('edit_waktu').value = waktu;
        document.getElementById('edit_tempat').value = tempat;
        document.getElementById('edit_keterangan').value = keterangan;
        document.getElementById('editForm').action = '/backendagenda/' + id + '/update';
        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }
</script>
@endpush

@endsection
