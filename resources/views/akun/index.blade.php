@extends('layout.app')
@section('content')
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-table me-2"></i>Daftar Akun Terdaftar</h5>
    </div>
    <div class="btn-toolbar my-4">
        <!-- Tombol Tambah Akun yang memicu Bootstrap Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAkun">
            <i class="bi bi-plus-lg me-1"></i> Tambah Akun
        </button>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3" style="width: 15%;">Kode Akun</th>
                            <th scope="col" style="width: 40%;">Nama Akun</th>
                            <th scope="col" style="width: 25%;">Tipe Akun</th>
                            <th scope="col" class="text-center pe-3" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_akun as $akun)
                            <tr>
                                <td class="ps-3 fw-bold text-secondary">{{ $akun->kode_akun }}</td>
                                <td>{{ $akun->nama_akun }}</td>
                                <td>
                                    @php
                                        $tipeAkun = strtolower($akun->tipe_akun ?? '');
                                        $badgeClass = match ($tipeAkun) {
                                            'aset',
                                            'asset'
                                                => 'bg-primary-subtle text-primary border border-primary-subtle',
                                            'kewajiban',
                                            'liability'
                                                => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                            'modal',
                                            'ekuitas',
                                            'equity'
                                                => 'bg-success-subtle text-success border border-success-subtle',
                                            'pendapatan',
                                            'revenue'
                                                => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                            'beban',
                                            'expense'
                                                => 'bg-danger-subtle text-danger border border-danger-subtle',
                                            default
                                                => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                                        };
                                    @endphp
                                    <span
                                        class="badge {{ $badgeClass }}">{{ ucfirst($akun->tipe_akun ?? 'Tidak diketahui') }}</span>
                                </td>

                                <td class="text-center pe-3">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <button class="btn btn-sm btn-outline-warning" title="Edit Akun"
                                            data-bs-toggle="modal" data-bs-target="#modalEditAkun{{ $akun->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('akun.destroy', $akun->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger" type="submit" title="Hapus Akun">
                                                <i class="bi bi-trash" onclick="return confirm('Data akan hilang jika dihapus!')"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Akun (Opsional pendukung) -->
                            <div class="modal fade" id="modalEditAkun{{ $akun->id }}" tabindex="-1"
                                aria-labelledby="modalEditAkunLabel{{ $akun->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditAkunLabel{{ $akun->id }}"><i
                                                    class="bi bi-pencil-square me-2"></i>Edit Akun
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('akun.update', $akun->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="editTipeAkun" class="form-label">Tipe Akun</label>
                                                    <select class="form-select" id="editTipeAkun{{ $akun->id }}"
                                                        name="tipe_akun" required>
                                                        <option value="Aset"
                                                            {{ $akun->tipe_akun == 'Aset' ? 'selected' : '' }}>
                                                            Aset (kode akun 1)
                                                        </option>

                                                        <option value="Kewajiban"
                                                            {{ $akun->tipe_akun == 'Kewajiban' ? 'selected' : '' }}>
                                                            Kewajiban (kode akun 2)
                                                        </option>

                                                        <option value="Modal"
                                                            {{ $akun->tipe_akun == 'Modal' ? 'selected' : '' }}>
                                                            Modal (kode akun 3)
                                                        </option>

                                                        <option value="Pendapatan"
                                                            {{ $akun->tipe_akun == 'Pendapatan' ? 'selected' : '' }}>
                                                            Pendapatan (kode akun 4)
                                                        </option>

                                                        <option value="Beban"
                                                            {{ $akun->tipe_akun == 'Beban' ? 'selected' : '' }}>
                                                            Beban (kode akun 5)
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editNamaAkun{{ $akun->id }}" class="form-label">Nama
                                                        Akun</label>
                                                    <input type="text" name="nama_akun" class="form-control"
                                                        id="editNamaAkun{{ $akun->id }}"
                                                        value="{{ $akun->nama_akun }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal form tambah akun --}}
    <div class="modal fade" id="modalTambahAkun" tabindex="-1" aria-labelledby="modalTambahAkunLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahAkunLabel"><i class="bi bi-plus-circle me-2"></i>Tambah Akun
                        Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('akun.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="tipeAkun" class="form-label">Tipe Akun</label>
                            <select class="form-select" id="tipeAkun" name="tipe_akun" required>
                                <option selected disabled>Pilih Tipe Akun</option>
                                <option value="Aset">Aset (kode akun 1)</option>
                                <option value="Kewajiban">Kewajiban (kode akun 2)</option>
                                <option value="Modal">Modal (kode akun 3)</option>
                                <option value="Pendapatan">Pendapatan (kode akun 4)</option>
                                <option value="Beban">Beban (kode akun 5)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="namaAkun" class="form-label">Nama Akun</label>
                            <input type="text" name="nama_akun" class="form-control" id="namaAkun"
                                placeholder="Contoh: Piutang Anggota" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan Akun</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
