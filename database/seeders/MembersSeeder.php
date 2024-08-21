<?php

namespace Database\Seeders;

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
        $prefixes = ['นาย', 'นาง', 'นางสาว'];

        for ($i = 1; $i <= 10; $i++) {
            $course = ($i % 3) + 1; // 1, 2, 3, 1, 2, 3, ...
            $level = $course;

            if ($course == 1) {
                $level = 1;
            } elseif ($course == 2 || $course == 3) {
                $level = rand(2, 3);
            }

            DB::table('members')->insert([
                'id_student' => 'S' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'prefix' => $prefixes[array_rand($prefixes)],
                'name' => 'ชื่อ ' . $i,
                'surname' => 'นามสกุล ' . $i,
                'email' => 'student' . $i . '@example.com',
                'email_verified_at' => now(),
                'tel' => '081234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'id_line' => 'line' . $i,
                'student_image' => null,
                'id_level' => $level,
                'id_course' => $course,
                'username' => 'student' . $i,
                'password' => Hash::make('password'),
                'account_status' => true,
                'remember_token' => Str::random(10),
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
