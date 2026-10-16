<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        $totalKasMasuk = DB::table('kas_masuks')->sum('jumlah');
        $totalKasKeluar = DB::table('kas_keluars')->sum('jumlah');
        $totalSaldoKas = $totalKasMasuk - $totalKasKeluar;

        $kasMasukBulanIni = DB::table('kas_masuks')
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->sum('jumlah');

        $kasKeluarBulanIni = DB::table('kas_keluars')
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->sum('jumlah');

        $kasMasuk = DB::table('kas_masuks')
            ->select('tanggal', 'jumlah', 'keterangan')
            ->selectRaw("'Kas Masuk' as jenis");

        $kasKeluar = DB::table('kas_keluars')
            ->select('tanggal', 'jumlah', 'keterangan')
            ->selectRaw("'Kas Keluar' as jenis");

        $transaksiTerakhir = DB::query()
            ->fromSub($kasMasuk->unionAll($kasKeluar), 'transaksi')
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'title',
            'totalSaldoKas',
            'kasMasukBulanIni',
            'kasKeluarBulanIni',
            'transaksiTerakhir'
        ));
    }
}
