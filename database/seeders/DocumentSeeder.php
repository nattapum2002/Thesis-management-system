<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            'document' => 'แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์ และแต่งตั้งอาจารย์ที่ปรึกษา'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบขอสอบหัวข้อและเค้าโครงของโครงงาน'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบรายงานผลการสอบเค้าโครงของโครงงาน'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบขอส่งเค้าโครงของโครงงาน'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบขอสอบสิ้นสุดโครงงาน'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบรายงานผลการสอบสิ้นสุดโครงงาน'
        ]);
        DB::table('documents')->insert([
            'document' => 'แบบส่งโครงงานฉบับสมบูรณ์'
        ]);
    }
}