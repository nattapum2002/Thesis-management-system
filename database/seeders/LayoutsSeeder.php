<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have projects already seeded, retrieve project ids
        $projectIds = \App\Models\Project::pluck('id_project');

        foreach ($projectIds as $projectId) {
            // Insert multiple layouts for each project
            for ($i = 1; $i <= 10; $i++) { // Insert 3 layouts for each project
                DB::table('layouts')->insert([
                    'file_layout' => 'path/to/layout_' . $i . '.pdf', // Example path
                    'id_project' => $projectId,
                    'created_by' => null, // Adjust if you have a user table
                    'updated_by' => null, // Adjust if you have a user table
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
