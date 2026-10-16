<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Buku Besar';
        $query = BukuBesar::query();

        // Fitur Filter Berdasarkan Rentang Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // Ambil data diurutkan dari tanggal paling lama ke terbaru (kronologis)
        $bukuBesars = $query->orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        // Hitung total keseluruhan untuk ringkasan (opsional tapi sangat berguna)
        $totalDebit = $bukuBesars->sum('debit');
        $totalKredit = $bukuBesars->sum('kredit');
        $saldoAkhir = $bukuBesars->isNotEmpty() ? $bukuBesars->last()->saldo : 0;

        return view('bukuBesar.index', compact('title', 'bukuBesars', 'totalDebit', 'totalKredit', 'saldoAkhir'));
    }

    public function exportExcel(Request $request)
    {
        $query = BukuBesar::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $bukuBesars = $query->orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        // Hitung total debit, kredit, dan saldo akhir
        $totalDebit = $bukuBesars->sum('debit');
        $totalKredit = $bukuBesars->sum('kredit');
        $saldoAkhir = $bukuBesars->isNotEmpty() ? $bukuBesars->last()->saldo : 0;

        $fileName = 'buku-besar-kas-' . date('Y-m-d') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($bukuBesars, $totalDebit, $totalKredit, $saldoAkhir) {
            $file = fopen('php://output', 'w');

            // Header Kolom Excel
            fputcsv($file, ['Tanggal', 'Nomor Referensi', 'Keterangan', 'Debit (Masuk)', 'Kredit (Keluar)', 'Saldo Berjalan']);

            // Data Baris Transaksi
            foreach ($bukuBesars as $row) {
                fputcsv($file, [
                    $row->tanggal,
                    $row->nomor_referensi,
                    $row->keterangan,
                    $row->debit,
                    $row->kredit,
                    $row->saldo
                ]);
            }

            // Baris Total Akhir di Bagian Bawah
            fputcsv($file, [
                'TOTAL MUTASI & SALDO AKHIR',
                '',
                '',
                $totalDebit,
                $totalKredit,
                $saldoAkhir
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
