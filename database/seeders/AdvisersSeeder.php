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
<<<<<<< HEAD
=======
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
<<<<<<< HEAD
=======
>>>>>>> 5e2d8c6c374056b8b2e1620fed98aa9e47b1d630
>>>>>>> f00d0975e56290881ee21f26a325b79d120bf432
>>>>>>> 1eb7e9e7bf95c9a1e3e02d1f4bbb35443c1c5c1f
        $projectIds = \App\Models\Project::pluck('id_project')->toArray();
        $teacherIds = \App\Models\Teacher::pluck('id_teacher')->toArray();

        foreach ($projectIds as $projectId) {
            // Shuffle teacherIds array to randomize the selection
            shuffle($teacherIds);

            // Initialize counters
            $position1Count = 0;
            $position2Count = 0;

            foreach ($teacherIds as $teacherId) {
                // Determine random positionId (1 or 2)
                $randomPositionId = rand(1, 2);

                // Check if selected positionId is 1 and if position 1 count limit is reached
                if ($randomPositionId == 1 && $position1Count >= 1) {
                    continue; // Skip this teacher and try another randomPositionId
                }

                // Check if selected positionId is 2 and if position 2 count limit is reached (max 3 teachers)
                if ($randomPositionId == 2 && $position2Count >= 3) {
                    continue; // Skip this teacher and try another randomPositionId
                }

                // Increase position count based on selected positionId
                if ($randomPositionId == 1) {
                    $position1Count++;
                } elseif ($randomPositionId == 2) {
                    $position2Count++;
                }

                DB::table('advisers')->insert([
                    'adviser_status' => 'Active', // Example adviser status
                    'id_project' => $projectId,
                    'id_teacher' => $teacherId,
                    'id_position' => $randomPositionId,
                    'created_by' => null, // Adjust if you have a user table
                    'updated_by' => null, // Adjust if you have a user table
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Stop loop if maximum teachers for position 2 is reached for this project
                if ($position2Count >= 3) {
                    break;
                }
            }
        }
    }
}