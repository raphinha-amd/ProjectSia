@extends('layout.app')

@section('content')
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i> Ekspor</button>
        </div>
        <button type="button" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
        </button>
    </div> --}}
    <!-- Cards/Boxes Informasi Penting -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <!-- Total Saldo Kas Saat Ini -->
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-primary border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Saldo Kas
                                Saat Ini</div>
                            <div class="h5 mb-0 fw-bold text-dark">Rp 12.450.000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kas Masuk (Bulan Ini) -->
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-success border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Kas Masuk (Bulan
                                Ini)</div>
                            <div class="h5 mb-0 fw-bold text-dark">Rp 4.200.000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-down-circle fs-2 text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kas Keluar (Bulan Ini) -->
        <div class="col">
            <div class="card border-0 shadow-sm border-start border-danger border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">Kas Keluar (Bulan
                                Ini)</div>
                            <div class="h5 mb-0 fw-bold text-dark">Rp 1.150.000</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-up-circle fs-2 text-danger opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Tabel Ringkasan Transaksi Terakhir -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-clock-history me-2"></i>Transaksi Terakhir
            </h5>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jenis</th>
                            <th scope="col" class="text-end pe-3">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3">1</td>
                            <td>14 Okt 2026</td>
                            <td>Iuran Kas Bulanan Anggota</td>
                            <td>Pendapatan</td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle">Masuk</span>
                            </td>
                            <td class="text-end pe-3 fw-bold text-success">+ Rp 250.000</td>
                        </tr>
                        <tr>
                            <td class="ps-3">2</td>
                            <td>12 Okt 2026</td>
                            <td>Pembelian Perlengkapan Sekretariat</td>
                            <td>Operasional</td>
                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Keluar</span>
                            </td>
                            <td class="text-end pe-3 fw-bold text-danger">- Rp 150.000</td>
                        </tr>
                        <tr>
                            <td class="ps-3">3</td>
                            <td>10 Okt 2026</td>
                            <td>Donasi Kegiatan Sosial</td>
                            <td>Sumbangan</td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle">Masuk</span>
                            </td>
                            <td class="text-end pe-3 fw-bold text-success">+ Rp 1.500.000</td>
                        </tr>
                        <tr>
                            <td class="ps-3">4</td>
                            <td>05 Okt 2026</td>
                            <td>Konsumsi Rapat Koordinasi</td>
                            <td>Konsumsi</td>
                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Keluar</span>
                            </td>
                            <td class="text-end pe-3 fw-bold text-danger">- Rp 200.000</td>
                        </tr>
                        <tr>
                            <td class="ps-3">5</td>
                            <td>02 Okt 2026</td>
                            <td>Subsidi Kegiatan Lomba</td>
                            <td>Acara</td>
                            <td><span class="badge bg-danger-subtle text-danger border border-danger-subtle">Keluar</span>
                            </td>
                            <td class="text-end pe-3 fw-bold text-danger">- Rp 800.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
