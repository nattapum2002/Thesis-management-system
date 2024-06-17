<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = ['Mr.', 'Ms.', 'Miss'];
        $statusNames = ['Active', 'Inactive'];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('students')->insert([
                'STUDENT_NO' => 'ST' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'Prefix' => $prefixes[array_rand($prefixes)],
                'NAME' => 'ชื่อ ' . $i,
                'LNAME' => 'นามสกุล ' . $i,
                'StatusName' => $statusNames[array_rand($statusNames)],
                'created_by' => null, // ปรับตามความเหมาะสมหากมีการเชื่อมต่อกับตารางผู้ใช้
                'updated_by' => null, // ปรับตามความเหมาะสมหากมีการเชื่อมต่อกับตารางผู้ใช้
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
