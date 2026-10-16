<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use App\Models\KasMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasMasukController extends Controller
{
    private function generateKodeReferensi($jenis)
    {
        $prefix = $jenis === 'masuk' ? 'KM-' : 'KK-';

        $kodeTerakhir = DB::table('kas_masuks')
            ->where('nomor_referensi', 'like', $prefix . '%')
            ->orderByDesc('nomor_referensi')
            ->limit(1)
            ->value('nomor_referensi');

        $nomor = $kodeTerakhir
            ? (int) substr($kodeTerakhir, 3) + 1
            : 1;

        return $prefix . str_pad($nomor, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $dataKasMasuk = KasMasuk::all();
        $title = 'Kas Masuk';
        return view('kasMasuk.index', compact('title', 'dataKasMasuk'));
    }

    public function create()
    {
        $kodeReferensi = $this->generateKodeReferensi('masuk');
        $title = 'Tambah Kas Masuk';
        return view('kasMasuk.create', compact('kodeReferensi', 'title'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_referensi' => 'required|string|max:255|unique:kas_masuks,nomor_referensi',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Set user_id
        $validatedData['user_id'] = 1; // atau Auth::id()

        // Gunakan Database Transaction agar aman (jika satu gagal, semua dibatalkan)
        DB::transaction(function () use ($validatedData) {
            // 1. Simpan data ke tabel kas_masuks
            $kasMasuk = KasMasuk::create($validatedData);

            // 2. Ambil saldo terakhir dari buku besar
            $lastBukuBesar = BukuBesar::latest('tanggal')->latest('id')->first();
            $lastSaldo = $lastBukuBesar ? $lastBukuBesar->saldo : 0;

            // Kas Masuk = Saldo Bertambah
            $newSaldo = $lastSaldo + $kasMasuk->jumlah;

            // 3. Simpan otomatis ke tabel buku_besars (Masuk = DEBIT)
            BukuBesar::create([
                'tanggal' => $kasMasuk->tanggal,
                'nomor_referensi' => $kasMasuk->nomor_referensi,
                'keterangan' => 'Kas Masuk: ' . ($kasMasuk->keterangan ?? '-'),
                'debit' => $kasMasuk->jumlah,
                'kredit' => 0,
                'saldo' => $newSaldo,
            ]);
        });

        // Redirect to the index page with a success message
        return redirect()->route('kasmasuk.index')->with('success', 'Kas Masuk berhasil ditambahkan.');
    }

    public function edit(KasMasuk $kasMasuk)
    {
        return view('kasMasuk.edit', compact('kasMasuk'));
    }

    public function update(Request $request, KasMasuk $kasMasuk)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_referensi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Update the KasMasuk record
        $kasMasuk->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('kasmasuk.index')->with('success', 'Kas Masuk berhasil diperbarui.');
    }

    public function destroy(kasMasuk $kasMasuk)
    {
        DB::transaction(function () use ($kasMasuk) {
            // 1. Hapus data di buku besar yang nomor referensinya sama
            BukuBesar::where('nomor_referensi', $kasMasuk->nomor_referensi)->delete();

            // 2. Hapus data kas masuk
            $kasMasuk->delete();

            // (Opsional) Di sini Anda juga bisa memanggil fungsi untuk merapikan/menghitung ulang saldo buku besar jika diperlukan.
        });
        return back()->with('success', 'Kas Masuk berhasil dihapus.');
    }
}
