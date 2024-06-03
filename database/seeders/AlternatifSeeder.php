<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatifs')->insert([
            ['nama' => 'budi'],
            ['nama' => 'susanto'],
            ['nama' => 'jamilah'],
            ['nama' => 'iskandar'],
            ['nama' => 'sueb'],
        ]);
    }
}
