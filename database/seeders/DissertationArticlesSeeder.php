<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class DissertationArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all project ids
        $projectIds = Project::pluck('id_project')->toArray();

        // Shuffle project ids to ensure they are used in a random order
        shuffle($projectIds);

        // Number of articles to insert
        $articlesCount = count($projectIds);

        for ($i = 0; $i < $articlesCount; $i++) {
            DB::table('dissertation_articles')->insert([
                'title' => 'บทความปริญญานิพนธ์ ' . ($i + 1),
                'details' => 'รายละเอียดบทความปริญญานิพนธ์ ' . ($i + 1),
                'thesis_image' => null,
                'file_dissertation' => 'path/to/dissertation_' . ($i + 1) . '.pdf', // Example path
                'year_published' => now()->year,
                'type' => ['Hardware', 'Software'][array_rand(['Hardware', 'Software'])], // Randomly select between Hardware and Software
                'status' => true,
                'id_project' => $projectIds[$i], // Use shuffled project id
                'created_by' => null, // Adjust if you have a user table
                'updated_by' => null, // Adjust if you have a user table
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}