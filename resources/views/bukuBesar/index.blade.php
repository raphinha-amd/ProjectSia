@extends('layout.app')
@section('content')
    <div class="btn-toolbar mb-2 mb-md-0 gap-2">

        <!-- Tombol Cetak / Export Excel -->
        <a href="{{ route('bukubesar.export.excel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-2"></i>
            Ekspor ke Excel
        </a>
    </div>
    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-white rounded-3">
            <form action="{{ route('bukubesar.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="startDate" class="form-label fw-bold">Tanggal Mulai (Start Date)</label>
                    <input type="date" class="form-control" id="startDate" name="start_date"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="endDate" class="form-label fw-bold">Tanggal Akhir (End Date)</label>
                    <input type="date" class="form-control" id="endDate" name="end_date"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    @if (request('start_date') || request('end_date'))
                        <a href="{{ route('bukubesar.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
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
                        @foreach ($bukuBesars as $item)
                            <tr>
                                <td class="ps-3 text-secondary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>
                                <td><span class="badge bg-light text-dark border">{{ $item->nomor_referensi }}</span></td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-end text-success">
                                    {{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end text-danger">
                                    {{ $item->kredit > 0 ? 'Rp ' . number_format($item->kredit, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end pe-3 fw-bold">Rp {{ number_format($item->saldo, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="3" class="text-end ps-3">TOTAL MUTASI & SALDO AKHIR:</td>
                            <td class="text-end text-success">Rp {{ number_format($totalDebit ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end text-danger">Rp {{ number_format($totalKredit ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end pe-3 text-primary">Rp {{ number_format($saldoAkhir ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
