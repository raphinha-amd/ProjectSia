@extends('layout.app')
@section('content')
    <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Riwayat Kas Keluar</h5>
    <div class="btn-toolbar my-4">
        <!-- Tombol Tambah Kas Keluar memicu Modal Form -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalFormKasMasuk">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kas Keluar
        </button>
    </div>
    <!-- Tabel Daftar Kas Keluar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <div class="input-group input-group-sm w-auto">
                <input type="text" class="form-control" placeholder="Cari transaksi...">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">No. Ref</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Akun Kas</th>
                            <th scope="col">Sumber (Akun Lawan)</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col" class="text-end">Jumlah</th>
                            <th scope="col" class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3 fw-bold text-secondary">KM-2026-001</td>
                            <td>14 Okt 2026</td>
                            <td>Kas Tunai (1-1001)</td>
                            <td>Pendapatan Iuran Anggota (4-1001)</td>
                            <td>Iuran kas bulanan periode Oktober</td>
                            <td class="text-end fw-bold text-danger">+ Rp 250.000</td>
                            <td class="text-center pe-3">
                                <button class="btn btn-sm btn-outline-warning me-1" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#modalFormKasMasuk">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3 fw-bold text-secondary">KM-2026-002</td>
                            <td>10 Okt 2026</td>
                            <td>Bank BCA (1-1002)</td>
                            <td>Pendapatan Donasi (4-1002)</td>
                            <td>Donasi alumni untuk kegiatan sosial</td>
                            <td class="text-end fw-bold text-danger">+ Rp 1.500.000</td>
                            <td class="text-center pe-3">
                                <button class="btn btn-sm btn-outline-warning me-1" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#modalFormKasMasuk">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Input (Create / Edit Kas Keluar) -->
    <div class="modal fade" id="modalFormKasMasuk" tabindex="-1" aria-labelledby="modalFormKasMasukLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalFormKasMasukLabel"><i class="bi bi-arrow-down-circle me-2"></i>Form Transaksi Kas Keluar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <!-- Input Tanggal -->
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="tanggal" value="2026-10-15">
                            </div>
                            <!-- Nomor Referensi -->
                            <div class="col-md-6">
                                <label for="nomorReferensi" class="form-label">Nomor Referensi</label>
                                <input type="text" class="form-control" id="nomorReferensi" placeholder="Contoh: KM-2026-003" value="KM-2026-003">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Select Dropdown Akun Kas (Tempat uang masuk) -->
                            <div class="col-md-6">
                                <label for="akunKas" class="form-label">Akun Kas (Penerima)</label>
                                <select class="form-select" id="akunKas">
                                    <option selected disabled>Pilih Akun Kas</option>
                                    <option value="1-1001" selected>1-1001 - Kas Tunai</option>
                                    <option value="1-1002">1-1002 - Bank BCA (Kas Bank)</option>
                                </select>
                            </div>
                            <!-- Select Dropdown Akun Lawan (Sumber Pendapatan) -->
                            <div class="col-md-6">
                                <label for="akunLawan" class="form-label">Akun Lawan (Sumber Pendapatan)</label>
                                <select class="form-select" id="akunLawan">
                                    <option selected disabled>Pilih Akun Pendapatan</option>
                                    <option value="4-1001" selected>4-1001 - Pendapatan Iuran Anggota</option>
                                    <option value="4-1002">4-1002 - Pendapatan Donasi / Sumbangan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Input Jumlah (Nominal) -->
                            <label for="jumlah" class="form-label">Jumlah (Nominal)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="jumlah" placeholder="0" value="500000">
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Textarea Keterangan -->
                            <label for="keterangan" class="form-label">Keterangan / Uraian</label>
                            <textarea class="form-control" id="keterangan" rows="3" placeholder="Masukkan detail keterangan transaksi...">Pembayaran iuran tambahan kas anggota bulan ini.</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
