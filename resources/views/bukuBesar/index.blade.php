@extends('layout.app')
@section('content')
    <div class="btn-toolbar mb-2 mb-md-0 gap-2">
        <!-- Tombol Cetak / Export PDF/Excel -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-printer me-1"></i> Cetak / Ekspor
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-pdf text-danger me-2"></i> Ekspor ke
                        PDF</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-excel text-success me-2"></i>
                        Ekspor ke Excel</a></li>
            </ul>
        </div>
    </div>
    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-white rounded-3">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="pilihAkun" class="form-label fw-bold">Pilih Akun Buku Besar</label>
                    <select class="form-select" id="pilihAkun">
                        <option value="1-1001" selected>1-1001 - Kas Tunai</option>
                        <option value="1-1002">1-1002 - Bank BCA (Kas Bank)</option>
                        <option value="4-1001">4-1001 - Pendapatan Iuran Anggota</option>
                        <option value="5-1001">5-1001 - Beban Operasional & Sekretariat</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="startDate" class="form-label fw-bold">Tanggal Mulai (Start Date)</label>
                    <input type="date" class="form-control" id="startDate" value="2026-10-01">
                </div>
                <div class="col-md-3">
                    <label for="endDate" class="form-label fw-bold">Tanggal Akhir (End Date)</label>
                    <input type="date" class="form-control" id="endDate" value="2026-10-15">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Akun yang Sedang Dilihat -->
    <div class="alert alert-secondary d-flex justify-content-between align-items-center mb-4" role="alert">
        <div>
            <span class="fw-bold">Akun:</span> 1-1001 - Kas Tunai |
            <span class="fw-bold">Periode:</span> 01 Okt 2026 s.d. 15 Okt 2026
        </div>
        <div>
            <span class="badge bg-dark">Saldo Awal: Rp 10.000.000</span>
        </div>
    </div>

    <!-- Tabel Utama Buku Besar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Riwayat Transaksi Kronologis</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3" style="width: 12%;">Tanggal</th>
                            <th scope="col" style="width: 12%;">Referensi</th>
                            <th scope="col" style="width: 32%;">Keterangan</th>
                            <th scope="col" class="text-end" style="width: 12%;">Debit (Masuk)</th>
                            <th scope="col" class="text-end" style="width: 12%;">Kredit (Keluar)</th>
                            <th scope="col" class="text-end pe-3" style="width: 20%;">Saldo Berjalan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris Saldo Awal -->
                        <tr class="table-secondary fw-semibold">
                            <td colspan="5" class="ps-3 text-uppercase">Saldo Awal per 01 Oktober 2026</td>
                            <td class="text-end pe-3">Rp 10.000.000</td>
                        </tr>
                        <!-- Baris Transaksi 1 -->
                        <tr>
                            <td class="ps-3 text-secondary">02 Okt 2026</td>
                            <td><span class="badge bg-light text-dark border">KK-2026-001</span></td>
                            <td>Subsidi Kegiatan Lomba Antar Divisi</td>
                            <td class="text-end text-success">-</td>
                            <td class="text-end text-danger">Rp 800.000</td>
                            <td class="text-end pe-3 fw-bold">Rp 9.200.000</td>
                        </tr>
                        <!-- Baris Transaksi 2 -->
                        <tr>
                            <td class="ps-3 text-secondary">05 Okt 2026</td>
                            <td><span class="badge bg-light text-dark border">KK-2026-002</span></td>
                            <td>Konsumsi Rapat Koordinasi Bulanan</td>
                            <td class="text-end text-success">-</td>
                            <td class="text-end text-danger">Rp 200.000</td>
                            <td class="text-end pe-3 fw-bold">Rp 9.000.000</td>
                        </tr>
                        <!-- Baris Transaksi 3 -->
                        <tr>
                            <td class="ps-3 text-secondary">10 Okt 2026</td>
                            <td><span class="badge bg-light text-dark border">KM-2026-001</span></td>
                            <td>Donasi alumni untuk kegiatan sosial</td>
                            <td class="text-end text-success">Rp 1.500.000</td>
                            <td class="text-end text-danger">-</td>
                            <td class="text-end pe-3 fw-bold">Rp 10.500.000</td>
                        </tr>
                        <!-- Baris Transaksi 4 -->
                        <tr>
                            <td class="ps-3 text-secondary">14 Okt 2026</td>
                            <td><span class="badge bg-light text-dark border">KM-2026-002</span></td>
                            <td>Iuran kas bulanan periode Oktober</td>
                            <td class="text-end text-success">Rp 250.000</td>
                            <td class="text-end text-danger">-</td>
                            <td class="text-end pe-3 fw-bold">Rp 10.750.000</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="3" class="text-end ps-3">TOTAL MUTASI & SALDO AKHIR:</td>
                            <td class="text-end text-success">Rp 1.750.000</td>
                            <td class="text-end text-danger">Rp 1.000.000</td>
                            <td class="text-end pe-3 text-primary">Rp 10.750.000</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
