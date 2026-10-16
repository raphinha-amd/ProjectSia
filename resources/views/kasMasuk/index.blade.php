@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Riwayat Kas Masuk</h5>
        <a href="{{ route('kasmasuk.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kas Masuk
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">No. Ref</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKasMasuk as $kasMasuk)
                        <tr>
                            <td class="ps-3 fw-bold text-secondary">{{ $kasMasuk->nomor_referensi }}</td>
                            <td>{{ $kasMasuk->tanggal }}</td>
                            <td>{{ $kasMasuk->keterangan }}</td>
                            <td class="text-end fw-bold text-success">+ Rp {{ number_format($kasMasuk->jumlah, 2, ',', '.') }}</td>
                            <td class="text-center pe-3">
                                <a href="{{ route('kasmasuk.edit', $kasMasuk->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('kasmasuk.destroy', $kasMasuk->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
