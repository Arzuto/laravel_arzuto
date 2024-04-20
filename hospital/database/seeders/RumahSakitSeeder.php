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
        ];

        foreach ($rumahSakitData as $data) {
            DB::table('rumah_sakit')->insert($data);
        }
    }
}
