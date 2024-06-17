<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DissertationArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have projects already seeded, retrieve project ids
        $projectIds = \App\Models\Project::pluck('id_project');

        foreach ($projectIds as $projectId) {
            // Insert multiple dissertation articles for each project
            for ($i = 1; $i <= 10; $i++) { // Insert 5 articles for each project
                DB::table('dissertation_articles')->insert([
                    'title' => 'บทความปริญญานิพนธ์ ' . $i,
                    'details' => 'รายละเอียดบทความปริญญานิพนธ์ ' . $i,
                    'thesis_image' => 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000',
                    'file_dissertation' => 'path/to/dissertation_' . $i . '.pdf', // Example path
                    'year_published' => now()->year,
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
