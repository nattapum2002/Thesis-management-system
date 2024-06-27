<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = ['Mr.', 'Ms.', 'Miss'];
        $levels = DB::table('levels')->pluck('id_level')->toArray();
        $courses = DB::table('courses')->pluck('id_course')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('members')->insert([
                'id_student' => 'S' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'prefix' => $prefixes[array_rand($prefixes)],
                'name' => 'ชื่อ ' . $i,
                'surname' => 'นามสกุล ' . $i,
                'email' => 'student' . $i . '@example.com',
                'email_verified_at' => now(),
                'tel' => '081234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'id_line' => 'line' . $i,
                'student_image' => 'https://via.placeholder.com/150',
                'id_level' => $levels[array_rand($levels)],
                'id_course' => $courses[array_rand($courses)],
                'username' => 'student' . $i,
                'password' => Hash::make('password'),
                'account_status' => false,
                'remember_token' => Str::random(10),
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
