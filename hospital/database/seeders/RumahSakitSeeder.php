<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data dummy untuk dimasukkan ke dalam tabel rumah_sakit
        $rumahSakitData = [
            [
                'nama' => 'RS Pertama',
                'alamat' => 'Jl. Jenderal Sudirman No. 1, Jakarta',
                'email' => 'rs_pertama@example.com',
                'telepon' => '08123456789'
            ],
            [
                'nama' => 'RS Kedua',
                'alamat' => 'Jl. Gatot Subroto No. 2, Surabaya',
                'email' => 'rs_kedua@example.com',
                'telepon' => '087654321'
            ],
            // Tambahkan data rumah sakit lainnya di sini sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel rumah_sakit
        foreach ($rumahSakitData as $data) {
            DB::table('rumah_sakit')->insert($data);
        }
    }
}
