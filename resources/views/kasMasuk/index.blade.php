@extends('layout.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Riwayat Kas Masuk</h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormKasMasuk">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kas Masuk
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">No. Ref</th>
                        <th>Tanggal</th>
                        <th>Akun Kas (Debit)</th>
                        <th>Akun Lawan (Kredit)</th>
                        <th>Keterangan</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kasMasuks as $kasMasuk)
                        <tr>
                            <td class="ps-3 fw-bold text-secondary">{{ $kasMasuk->nomor_referensi }}</td>
                            <td>{{ $kasMasuk->tanggal->format('d M Y') }}</td>
                            <td>{{ $kasMasuk->akunKas->kode_akun }} - {{ $kasMasuk->akunKas->nama_akun }}</td>
                            <td>{{ $kasMasuk->akunLawan->kode_akun }} - {{ $kasMasuk->akunLawan->nama_akun }}</td>
                            <td>{{ $kasMasuk->keterangan ?: '-' }}</td>
                            <td class="text-end fw-bold text-success">+ Rp {{ number_format($kasMasuk->jumlah, 2, ',', '.') }}</td>
                            <td class="text-center pe-3">
                                <button class="btn btn-sm btn-outline-warning me-1" title="Edit"
                                    data-bs-toggle="modal" data-bs-target="#modalEditKasMasuk{{ $kasMasuk->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('kasmasuk.destroy', $kasMasuk) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi kas masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalFormKasMasuk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-arrow-down-circle me-2"></i>Tambah Kas Masuk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('kasmasuk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @include('kasMasuk.form', ['kasMasuk' => null])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kasMasuks as $kasMasuk)
        <div class="modal fade" id="modalEditKasMasuk{{ $kasMasuk->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Kas Masuk</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('kasmasuk.update', $kasMasuk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            @include('kasMasuk.form', ['kasMasuk' => $kasMasuk])
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
