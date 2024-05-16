<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            'level' => 'ป.ตรี 4 ปี',
            'sector' => 'ปกติ'
        ]);
        DB::table('levels')->insert([
            'level' => 'ป.ตรี 4 ปี',
            'sector' => 'สมทบ'
        ]);
        DB::table('levels')->insert([
            'level' => 'ปวส. 2 ปี',
            'sector' => 'ปกติ'
        ]);
        DB::table('levels')->insert([
            'level' => 'ปวส. 2 ปี',
            'sector' => 'สมทบ'
        ]);
    }
}
