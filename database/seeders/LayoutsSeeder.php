<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class LayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all project ids
        $projects = Project::all();

        foreach ($projects as $project) {
            // Generate 3 layouts for each project
            for ($i = 1; $i <= 3; $i++) {
                DB::table('layouts')->insert([
                    'file_layout' => 'path/to/layout_' . $i . '.pdf', // Example path
                    'id_project' => $project->id_project,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}