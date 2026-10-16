@extends('layout.app')

@section('content')
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
                            <div class="h5 mb-0 fw-bold text-dark">Rp {{ number_format($totalSaldoKas, 0, ',', '.') }}</div>
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
                            <div class="h5 mb-0 fw-bold text-dark">Rp {{ number_format($kasMasukBulanIni, 0, ',', '.') }}
                            </div>
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
                            <div class="h5 mb-0 fw-bold text-dark">Rp {{ number_format($kasKeluarBulanIni, 0, ',', '.') }}
                            </div>
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
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiTerakhir as $tr)
                            <tr>
                                <td class="ps-3">{{ $loop->iteration }}</td>
                                <td>{{ $tr->tanggal }}</td>
                                <td>{{ $tr->keterangan }}</td>
                                <td>
                                    @if ($tr->jenis == 'Kas Masuk')
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle">Masuk</span>
                                    @else
                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger-subtle">Keluar</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($tr->jenis == 'Kas Masuk')
                                        <span class="fw-bold text-success">+ Rp
                                            {{ number_format($tr->jumlah, 0, ',', '.') }}</span>
                                    @else
                                        <span class="fw-bold text-danger">- Rp
                                            {{ number_format($tr->jumlah, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
