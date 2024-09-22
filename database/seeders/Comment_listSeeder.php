<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Comment_listSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comment_lists')->insert([
            'comment_list' => 'ความเห็น(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => 'ความเห็น(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '1.ชื่อเรื่อง(ไทย)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '1.ชื่อเรื่อง(อังกฤษ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '2.ความเป็นมา(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '2.ความเป็นมา(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '3.วัตถุประสงค์(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '3.วัตถุประสงค์(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '4.ความเป็นไปได้(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '4.ความเป็นไปได้(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '5.การวางแผน(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '5.การวางแผน(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '6.ประโยชน์(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '6.ประโยชน์(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '7.ความซ้ำซ้อน(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '7.ความซ้ำซ้อน(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '8.ความเหมาะสม(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '8.ความเหมาะสม(ข้อเสนอ)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => 'ข้อเสนอแนะ'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '1.บุคลิก'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '2.1.ไฟล์'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '2.2.สัดส่วน'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '2.3.ทักษะ'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '3.การตอบคำถาม'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '4.1.รูปแบบ'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '4.2.เนื้อหา'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '5.1.วัตถุประสงค์'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '5.2.ขอบเขต'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => '6.ความพร้อมและความตรงต่อเวลา'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => 'สรุปผลการสอบ(ตัวเลือก)'
        ]);
        DB::table('comment_lists')->insert([
            'comment_list' => 'สรุปผลการสอบ(ข้อเสนอ)'
        ]);
    }
}