@php
    $formId = $kasMasuk ? $kasMasuk->id : '';
    $formDate = $kasMasuk && $kasMasuk->tanggal ? $kasMasuk->tanggal->format('Y-m-d') : now()->format('Y-m-d');
@endphp
<div class="row mb-3">
    <div class="col-md-6">
        <label for="tanggal{{ $formId }}" class="form-label">Tanggal Transaksi</label>
        <input type="date" class="form-control" id="tanggal{{ $formId }}" name="tanggal"
            value="{{ old('tanggal', $formDate) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nomor Referensi</label>
        <input type="text" class="form-control" value="{{ $kasMasuk ? $kasMasuk->nomor_referensi : 'Dibuat otomatis saat disimpan' }}" readonly>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="akunKas{{ $formId }}" class="form-label">Akun Kas (Debit)</label>
        <select class="form-select" id="akunKas{{ $formId }}" name="id_akun_kas" required>
            <option value="" disabled {{ old('id_akun_kas', $kasMasuk ? $kasMasuk->id_akun_kas : null) ? '' : 'selected' }}>Pilih akun kas</option>
            @foreach ($akunKas as $akun)
                <option value="{{ $akun->id }}" {{ (string) old('id_akun_kas', $kasMasuk ? $kasMasuk->id_akun_kas : null) === (string) $akun->id ? 'selected' : '' }}>
                    {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label for="akunLawan{{ $formId }}" class="form-label">Akun Lawan (Kredit)</label>
        <select class="form-select" id="akunLawan{{ $formId }}" name="id_akun_lawan" required>
            <option value="" disabled {{ old('id_akun_lawan', $kasMasuk ? $kasMasuk->id_akun_lawan : null) ? '' : 'selected' }}>Pilih akun lawan</option>
            @foreach ($akunLawan as $akun)
                <option value="{{ $akun->id }}" {{ (string) old('id_akun_lawan', $kasMasuk ? $kasMasuk->id_akun_lawan : null) === (string) $akun->id ? 'selected' : '' }}>
                    {{ $akun->kode_akun }} - {{ $akun->nama_akun }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3">
    <label for="jumlah{{ $formId }}" class="form-label">Jumlah (Nominal)</label>
    <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control" id="jumlah{{ $formId }}" name="jumlah"
            min="0.01" step="0.01" value="{{ old('jumlah', $kasMasuk ? $kasMasuk->jumlah : null) }}" required>
    </div>
</div>
<div>
    <label for="keterangan{{ $formId }}" class="form-label">Keterangan / Uraian</label>
    <textarea class="form-control" id="keterangan{{ $formId }}" name="keterangan" rows="3"
        maxlength="65535">{{ old('keterangan', $kasMasuk ? $kasMasuk->keterangan : null) }}</textarea>
</div>
