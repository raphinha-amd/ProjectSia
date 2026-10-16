@extends('layout.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="h4 mb-0">Tambah Kas Masuk</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('kasmasuk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_referensi" class="form-label">No. Referensi</label>
                        <input type="text" class="form-control" id="nomor_referensi" name="nomor_referensi"
                            value="{{ $kodeReferensi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kasmasuk.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
