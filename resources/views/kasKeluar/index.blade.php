@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Riwayat Kas Keluar</h5>
        <a href="{{ route('kaskeluar.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kas Keluar
        </a>
    </div>
    <!-- Tabel Daftar Kas Keluar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">No. Ref</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col" class="text-end">Jumlah</th>
                            <th scope="col" class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKasKeluar as $kasKeluar)
                            <tr>
                                <td class="ps-3 fw-bold text-secondary">{{ $kasKeluar->nomor_referensi }}</td>
                                <td>{{ $kasKeluar->tanggal }}</td>
                                <td>{{ $kasKeluar->keterangan }}</td>
                                <td class="text-end fw-bold text-danger">- Rp
                                    {{ number_format($kasKeluar->jumlah, 2, ',', '.') }}</td>
                                <td class="text-center pe-3">
                                    <a href="{{ route('kaskeluar.edit', $kasKeluar->id) }}"
                                        class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('kaskeluar.destroy', $kasKeluar->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
    </div>
@endsection
