<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriterias')->insert([
            ['kode' => 'KT1', 'nama' => 'Pemasukan Bulanan', 'bobot' => 0.3],
            ['kode' => 'KT2', 'nama' => 'Jumlah Tanggungan', 'bobot' => 0.2],
            ['kode' => 'KT3', 'nama' => 'Biaya Listrik Perbulan', 'bobot' => 0.05],
            ['kode' => 'KT4', 'nama' => 'Jenis Lantai Rumah', 'bobot' => 0.05],
            ['kode' => 'KT5', 'nama' => 'Jenis Pekerjaan', 'bobot' => 0.1],
            ['kode' => 'KT6', 'nama' => 'Usia', 'bobot' => 0.1],
            ['kode' => 'KT7', 'nama' => 'Cacat Fisik', 'bobot' => 0.2],
        ]);
    }
}
