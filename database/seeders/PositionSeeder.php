<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            'position' => 'ที่ปรึกษาหลัก'
        ]);
        DB::table('positions')->insert([
            'position' => 'ที่ปรึกษาร่วม'
        ]);
        DB::table('positions')->insert([
            'position' => 'อาจารย์ประจำวิชา'
        ]);
        DB::table('positions')->insert([
            'position' => 'หัวหน้าสาขา'
        ]);
        DB::table('positions')->insert([
            'position' => 'ประธานกรรมการ'
        ]);
        DB::table('positions')->insert([
            'position' => 'กรรมการ'
        ]);
        DB::table('positions')->insert([
            'position' => 'กรรมการและเลขานุการ'
        ]);
    }
}
