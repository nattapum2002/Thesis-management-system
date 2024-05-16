<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'course' => 'หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง',
            'branch' => 'เทคโนโลยีคอมพิวเตอร์'
        ]);
        DB::table('courses')->insert([
            'course' => 'หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต',
            'branch' => 'เทคโนโลยีคอมพิวเตอร์'
        ]);
        DB::table('courses')->insert([
            'course' => 'หลักสูตรวิทยาศาสตรบัณฑิต',
            'branch' => 'เทคโนโลยีคอมพิวเตอร์'
        ]);
    }
}
