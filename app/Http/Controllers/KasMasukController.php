<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\KasMasuk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KasMasukController extends Controller
{
    public function index()
    {
        $kasMasuks = KasMasuk::with(['akunKas', 'akunLawan'])
            // ->where('user_id', auth()->id())
            ->latest('tanggal')
            ->latest('id')
            ->get();
        $akunKas = Akun::where('tipe_akun', 'Aset')->orderBy('kode_akun')->get();
        $akunLawan = Akun::whereIn('tipe_akun', ['Pendapatan', 'Kewajiban', 'Modal'])
            ->orderBy('kode_akun')
            ->get();
        $title = 'Kas Masuk';

        return view('kasMasuk.index', compact('title', 'kasMasuks', 'akunKas', 'akunLawan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        DB::transaction(function () use ($data, $request) {
            KasMasuk::create([
                'user_id' => $request->user()->id ?? 1,
                'id_akun_kas' => $data['id_akun_kas'],
                'id_akun_lawan' => $data['id_akun_lawan'],
                'tanggal' => $data['tanggal'],
                'nomor_referensi' => $this->generateReference($data['tanggal']),
                'jumlah' => $data['jumlah'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        });

        return redirect()->route('kasmasuk.index')->with('success', 'Transaksi kas masuk berhasil disimpan.');
    }

    public function update(Request $request, KasMasuk $kasMasuk): RedirectResponse
    {
        // abort_unless($kasMasuk->user_id === $request->user()->id ? 1, 403);
        $data = $this->validatedData($request);

        $kasMasuk->update([
            'id_akun_kas' => $data['id_akun_kas'],
            'id_akun_lawan' => $data['id_akun_lawan'],
            'tanggal' => $data['tanggal'],
            'jumlah' => $data['jumlah'],
            'keterangan' => $data['keterangan'] ?? null,
        ]);

        return redirect()->route('kasmasuk.index')->with('success', 'Transaksi kas masuk berhasil diperbarui.');
    }

    public function destroy(KasMasuk $kasMasuk): RedirectResponse
    {
        abort_unless($kasMasuk->user_id === auth()->id(), 403);
        $kasMasuk->delete();

        return redirect()->route('kasmasuk.index')->with('success', 'Transaksi kas masuk berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date'],
            'id_akun_kas' => ['required', 'integer', 'exists:akuns,id'],
            'id_akun_lawan' => ['required', 'integer', 'exists:akuns,id', 'different:id_akun_kas'],
            'jumlah' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
            'keterangan' => ['nullable', 'string', 'max:65535'],
        ]);

        $accounts = Akun::whereIn('id', [$data['id_akun_kas'], $data['id_akun_lawan']])
            ->get()
            ->keyBy('id');

        if (!$accounts->has((int) $data['id_akun_kas'])
            || $accounts[(int) $data['id_akun_kas']]->tipe_akun !== 'Aset') {
            throw ValidationException::withMessages([
                'id_akun_kas' => 'Akun kas harus merupakan akun bertipe Aset.',
            ]);
        }

        if (!$accounts->has((int) $data['id_akun_lawan'])
            || !in_array($accounts[(int) $data['id_akun_lawan']]->tipe_akun, ['Pendapatan', 'Kewajiban', 'Modal'], true)) {
            throw ValidationException::withMessages([
                'id_akun_lawan' => 'Akun lawan harus bertipe Pendapatan, Kewajiban, atau Modal.',
            ]);
        }

        return $data;
    }

    private function generateReference(string $date): string
    {
        $prefix = 'KM-' . date('Y', strtotime($date)) . '-';
        $references = KasMasuk::where('nomor_referensi', 'like', $prefix . '%')
            ->lockForUpdate()
            ->pluck('nomor_referensi');
        $sequence = $references->max(function (string $reference) use ($prefix): int {
            return (int) substr($reference, strlen($prefix));
        }) + 1;

        return $prefix . str_pad((string) $sequence, 3, '0', STR_PAD_LEFT);
    }
}
