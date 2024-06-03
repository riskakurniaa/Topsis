<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_kriterias')->insert([
            ['kriteria_id' => 1, 'nama' => '<RP 500.000', 'nilai' => 5],
            ['kriteria_id' => 1, 'nama' => 'Rp 500.001 - 750.000', 'nilai' => 4],
            ['kriteria_id' => 1, 'nama' => 'Rp 750.001 - Rp 1.000.000', 'nilai' => 3],
            ['kriteria_id' => 1, 'nama' => 'Rp 1.000.001 - 1.500.000', 'nilai' => 2],
            ['kriteria_id' => 1, 'nama' => '>Rp1.500.000', 'nilai' => 1],
            ['kriteria_id' => 2, 'nama' => '>5', 'nilai' => 5],
            ['kriteria_id' => 2, 'nama' => '4', 'nilai' => 4],
            ['kriteria_id' => 2, 'nama' => '3', 'nilai' => 3],
            ['kriteria_id' => 2, 'nama' => '2', 'nilai' => 2],
            ['kriteria_id' => 2, 'nama' => '1', 'nilai' => 1],
            ['kriteria_id' => 3, 'nama' => '<Rp 10.000', 'nilai' => 5],
            ['kriteria_id' => 3, 'nama' => 'Rp 10.001 - 25.000', 'nilai' => 4],
            ['kriteria_id' => 3, 'nama' => 'Rp 25.001 - 75.000', 'nilai' => 3],
            ['kriteria_id' => 3, 'nama' => 'Rp 75.001 - 100.000', 'nilai' => 2],
            ['kriteria_id' => 3, 'nama' => '>Rp 100.000', 'nilai' => 1],
            ['kriteria_id' => 4, 'nama' => 'Lantai Tanah', 'nilai' => 5],
            ['kriteria_id' => 4, 'nama' => 'Lantai Kayu', 'nilai' => 4],
            ['kriteria_id' => 4, 'nama' => 'Lantai Semen', 'nilai' => 3],
            ['kriteria_id' => 4, 'nama' => 'Lantai Keramik Kualitas Rendah', 'nilai' => 2],
            ['kriteria_id' => 4, 'nama' => 'Lantai Keramik Kualitas tinggi', 'nilai' => 1],
            ['kriteria_id' => 5, 'nama' => 'Tidak bekerja', 'nilai' => 5],
            ['kriteria_id' => 5, 'nama' => 'Pekerja Serabutan', 'nilai' => 4],
            ['kriteria_id' => 5, 'nama' => 'Pekerja Lepas', 'nilai' => 3],
            ['kriteria_id' => 5, 'nama' => 'Pekerja Kontrak', 'nilai' => 2],
            ['kriteria_id' => 5, 'nama' => 'Pekerja Tetap', 'nilai' => 1],
            ['kriteria_id' => 6, 'nama' => '>60', 'nilai' => 5],
            ['kriteria_id' => 6, 'nama' => '51-60', 'nilai' => 4],
            ['kriteria_id' => 6, 'nama' => '41-50', 'nilai' => 3],
            ['kriteria_id' => 6, 'nama' => '30-40', 'nilai' => 2],
            ['kriteria_id' => 6, 'nama' => '<30', 'nilai' => 1],
            ['kriteria_id' => 7, 'nama' => 'Memiliki cacat fisik', 'nilai' => 5],
            ['kriteria_id' => 7, 'nama' => 'Cacat fisik ringan', 'nilai' => 3],
            ['kriteria_id' => 7, 'nama' => 'Tidak memiliki cacat fisik', 'nilai' => 0],
        ]);
    }
}
