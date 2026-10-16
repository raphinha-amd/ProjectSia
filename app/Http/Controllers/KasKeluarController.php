<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use App\Models\KasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasKeluarController extends Controller
{
    private function generateKodeReferensi($jenis)
    {
        $prefix = $jenis === 'masuk' ? 'KM-' : 'KK-';

        $kodeTerakhir = DB::table('kas_keluars')
            ->where('nomor_referensi', 'like', $prefix . '%')
            ->orderByDesc('nomor_referensi')
            ->limit(1)
            ->value('nomor_referensi');

        $nomor = $kodeTerakhir
            ? (int) substr($kodeTerakhir, 3) + 1
            : 1;

        return $prefix . str_pad($nomor, 4, '0', STR_PAD_LEFT);
    }

    // Tambahkan fungsi privat ini di dalam controller yang sama
    private function recalculateBukuBesar()
    {
        $allBukuBesar = BukuBesar::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $runningSaldo = 0;

        foreach ($allBukuBesar as $item) {
            $runningSaldo = $runningSaldo + $item->debit - $item->kredit;
            $item->update(['saldo' => $runningSaldo]);
        }
    }

    public function index()
    {
        $title = 'Kas Keluar';
        $dataKasKeluar = KasKeluar::all();
        return view('kasKeluar.index', compact('title', 'dataKasKeluar'));
    }

    public function create()
    {
        $title = 'Tambah Kas Keluar';
        $kodeReferensi = $this->generateKodeReferensi('keluar');
        return view('kasKeluar.create', compact('title', 'kodeReferensi'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_referensi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Create a new KasKeluar record
        $validatedData['user_id'] = 1; // Assuming you want to associate the record with the authenticated user
        DB::transaction(function () use ($validatedData) {
            // 1. Simpan data ke tabel kas_keluars
            $kasKeluar = KasKeluar::create($validatedData);

            // 2. Ambil saldo terakhir dari buku besar
            $lastBukuBesar = BukuBesar::latest('tanggal')->latest('id')->first();
            $lastSaldo = $lastBukuBesar ? $lastBukuBesar->saldo : 0;

            // Kas Keluar = Saldo Berkurang
            $newSaldo = $lastSaldo - $kasKeluar->jumlah;

            // 3. Simpan otomatis ke tabel buku_besars (Keluar = kredit)
            BukuBesar::create([
                'tanggal' => $kasKeluar->tanggal,
                'nomor_referensi' => $kasKeluar->nomor_referensi,
                'keterangan' => 'Kas Keluar: ' . ($kasKeluar->keterangan ?? '-'),
                'debit' => 0,
                'kredit' => $kasKeluar->jumlah,
                'saldo' => $newSaldo,
            ]);
        });

        // Redirect to the index page with a success message
        return redirect()->route('kaskeluar.index')->with('success', 'Kas Keluar berhasil ditambahkan.');
    }

    public function edit(KasKeluar $kasKeluar)
    {
        $title = 'Edit Kas Keluar';
        return view('kasKeluar.edit', compact('title', 'kasKeluar'));
    }

    public function update(Request $request, KasKeluar $kasKeluar)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_referensi' => 'required|string|max:255|unique:kas_keluars,nomor_referensi,' . $kasKeluar->id,
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $kasKeluar, $validatedData) {
            // Simpan nomor referensi lama untuk acuan pencarian di buku besar
            $oldReferensi = $kasKeluar->nomor_referensi;

            // 1. Update data kas keluar
            $kasKeluar->update($validatedData);

            // 2. Cari dan update data yang bersangkutan di Buku Besar
            $bukuBesar = BukuBesar::where('nomor_referensi', $oldReferensi)->first();

            if ($bukuBesar) {
                $bukuBesar->update([
                    'tanggal' => $request->tanggal,
                    'nomor_referensi' => $request->nomor_referensi,
                    'keterangan' => 'Kas Keluar: ' . ($request->keterangan ?? '-'),
                    'kredit' => $request->jumlah, // Kas Keluar dicatat di kolom kredit
                ]);
            } else {
                // Jikalau data buku besar sebelumnya tidak ketemu, buat baru
                BukuBesar::create([
                    'tanggal' => $request->tanggal,
                    'nomor_referensi' => $request->nomor_referensi,
                    'keterangan' => 'Kas Keluar: ' . ($request->keterangan ?? '-'),
                    'debit' => 0,
                    'kredit' => $request->jumlah,
                    'saldo' => 0,
                ]);
            }

            // 3. Hitung ulang seluruh saldo buku besar dari awal agar urutan saldo berjalan tetap akurat
            $this->recalculateBukuBesar();
        });

        // Redirect to the index page with a success message
        return redirect()->route('kaskeluar.index')->with('success', 'Kas Keluar berhasil diperbarui.');
    }


    public function destroy(KasKeluar $kasKeluar)
    {
        // Delete the kasKeluar record
        DB::transaction(function () use ($kasKeluar) {
            // 1. Hapus data di buku besar yang nomor referensinya sama
            BukuBesar::where('nomor_referensi', $kasKeluar->nomor_referensi)->delete();

            // 2. Hapus data kas masuk
            $kasKeluar->delete();

            // (Opsional) Di sini Anda juga bisa memanggil fungsi untuk merapikan/menghitung ulang saldo buku besar jika diperlukan.
        });

        // Redirect to the index page with a success message
        return back()->with('success', 'Kas Keluar berhasil dihapus.');
    }
}
