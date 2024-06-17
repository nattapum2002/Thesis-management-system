<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = ['Mr.', 'Ms.', 'Dr.'];
        $academicPositions = ['Professor', 'Associate Professor', 'Assistant Professor'];
        $branches = ['Computer Technology', 'Information Technology', 'Software Engineering'];
        $userTypes = ['Admin', 'Branch head', 'Teacher'];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('teachers')->insert([
                'prefix' => $prefixes[array_rand($prefixes)],
                'name' => 'ชื่อ ' . $i,
                'surname' => 'นามสกุล ' . $i,
                'academic_position' => $academicPositions[array_rand($academicPositions)],
                'educational_qualification' => 'วุฒิการศึกษา ' . $i,
                'branch' => $branches[array_rand($branches)],
                'user_type' => $userTypes[array_rand($userTypes)],
                'email' => 'teacher' . $i . '@example.com',
                'email_verified_at' => now(),
                'tel' => '081234567' . $i,
                'id_line' => 'line' . $i,
                'teacher_image' => 'https://via.placeholder.com/150',
                'signature_image' => 'https://via.placeholder.com/50',
                'username' => 'teacher' . $i,
                'password' => Hash::make('password'),
                'account_status' => 'active',
                'created_by' => null,
                'updated_by' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
