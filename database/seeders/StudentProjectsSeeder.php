<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = DB::table('members')->pluck('id_student')->toArray();
        $projects = DB::table('projects')->pluck('id_project')->toArray();

        foreach ($students as $student) {
            // Assign each student to a random project
            DB::table('student_projects')->insert([
                'id_student' => $student,
                'id_project' => $projects[array_rand($projects)],
            ]);
        }
    }
}
