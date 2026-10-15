<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{

    public function index()
    {
        $data_akun = Akun::all();
        $title = 'Akun';
        return view('akun.index', compact('data_akun', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_akun' => 'required',
            'kode_akun' => 'required|unique:akun',
            'tipe_akun' => 'required|in:Aset,Kewajiban,Modal,Pendapatan,Beban',
        ]);

        Akun::create([
            'kode_akun' => $this->generateKodeAkun($request->tipe_akun),
            'nama_akun' => $request->nama_akun,
            'tipe_akun' => $request->tipe_akun,
        ]);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    private function generateKodeAkun(string $tipeAkun): string
    {
        $prefix = [
            'Aset' => '1',
            'Kewajiban' => '2',
            'Modal' => '3',
            'Pendapatan' => '4',
            'Beban' => '5',
        ][$tipeAkun];

        $nomor = 1;

        do {
            $kode = $prefix . '-' . str_pad((string) $nomor, 4, '0', STR_PAD_LEFT);
            $nomor++;
        } while (Akun::where('kode_akun', $kode)->exists());

        return $kode;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_akun' => 'required|string|max:255',
            'tipe_akun' => 'required|in:Aset,Kewajiban,Modal,Pendapatan,Beban',
        ]);

        $akun = Akun::findOrFail($id);

        // Jika tipe akun berubah, buat kode akun baru
        if ($akun->tipe_akun !== $request->tipe_akun) {
            $kodeAkun = $this->generateKodeAkun($request->tipe_akun);
        } else {
            // Jika tipe akun tetap, gunakan kode lama
            $kodeAkun = $akun->kode_akun;
        }

        $akun->update([
            'kode_akun' => $kodeAkun,
            'nama_akun' => $request->nama_akun,
            'tipe_akun' => $request->tipe_akun,
        ]);

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
