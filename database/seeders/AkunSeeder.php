<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $akuns = [
            // Aset (Kas & Bank)
            ['kode_akun' => '111', 'nama_akun' => 'Kas Tunai', 'tipe_akun' => 'Aset'],
            ['kode_akun' => '112', 'nama_akun' => 'Bank BCA', 'tipe_akun' => 'Aset'],

            // Pendapatan
            ['kode_akun' => '411', 'nama_akun' => 'Pendapatan Usaha', 'tipe_akun' => 'Pendapatan'],
            ['kode_akun' => '412', 'nama_akun' => 'Pendapatan Lain-lain', 'tipe_akun' => 'Pendapatan'],

            // Beban / Biaya
            ['kode_akun' => '511', 'nama_akun' => 'Biaya Gaji', 'tipe_akun' => 'Beban'],
            ['kode_akun' => '512', 'nama_akun' => 'Biaya Listrik & Air', 'tipe_akun' => 'Beban'],
            ['kode_akun' => '513', 'nama_akun' => 'Biaya Operasional Lainnya', 'tipe_akun' => 'Beban'],
        ];

        foreach ($akuns as $akun) {
            Akun::create($akun);
        }
    }
}
