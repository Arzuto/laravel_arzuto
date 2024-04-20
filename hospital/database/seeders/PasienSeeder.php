<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pasien = [
            [
                'nama' => 'John Doe',
                'alamat' => 'Jl. Contoh No. 123',
                'no_telepon' => '081234567890',
                'rumah_sakit_id' => 1,
            ],
            [
                'nama' => 'Jane Smith',
                'alamat' => 'Jl. Contoh No. 456',
                'no_telepon' => '081234567891',
                'rumah_sakit_id' => 2,
            ],
        ];

        foreach ($pasien as $data) {
            DB::table('pasien')->insert($data);
        }
    }

}
