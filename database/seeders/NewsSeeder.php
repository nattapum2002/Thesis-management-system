<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Teacher; // import Teacher model

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsTypes = ['ข่าวทั่วไป', 'ชื่อหัวข้อ'];

        // Assuming we have some teachers in the teachers table
        $teacherIds = DB::table('teachers')->pluck('id_teacher')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('news')->insert([
                'title' => 'ข่าวที่ ' . $i,
                'details' => 'นี่คือเนื้อหาของข่าวที่ ' . $i,
                'news_image' => null,
                'type' => $newsTypes[array_rand($newsTypes)],
                'status' => true,
                'id_teacher' => $teacherIds[array_rand($teacherIds)],
                'created_by' => null, // You can adjust this if you have a user table
                'updated_by' => null, // You can adjust this if you have a user table
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
