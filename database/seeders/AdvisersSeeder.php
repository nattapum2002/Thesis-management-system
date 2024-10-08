<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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
