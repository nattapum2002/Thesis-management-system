<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have projects, teachers, and positions already seeded, retrieve their ids
        // $projectIds = \App\Models\Project::pluck('id_project');
        // $teacherIds = \App\Models\Teacher::pluck('id_teacher');
        // $positionIds = \App\Models\Position::pluck('id_position');

        // foreach ($projectIds as $projectId) {
        //     foreach ($teacherIds as $teacherId) {
        //         foreach ($positionIds as $positionId) {
        //             DB::table('advisers')->insert([
        //                 'adviser_status' => 'Active', // Example adviser status
        //                 'id_project' => $projectId,
        //                 'id_teacher' => $teacherId,
        //                 'id_position' => $positionId,
        //                 'created_by' => null, // Adjust if you have a user table
        //                 'updated_by' => null, // Adjust if you have a user table
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         }
        //     }
        // }
    }
}
