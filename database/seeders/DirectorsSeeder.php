<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Document;
use App\Models\Teacher;
use App\Models\Position;

class DirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all ids from existing records
        $projectIds = Project::pluck('id_project');
        $documents = Document::whereIn('id_document', [3, 6])->get();
        $teachers = Teacher::all();
        $positions = Position::whereIn('id_position', [5, 6, 7])->get();

        foreach ($projectIds as $projectId) {
            // Randomly select documents, teachers, and positions
            $selectedDocument = $documents->random();
            $selectedTeacher = $teachers->random();
            $selectedPosition = $positions->random();

            DB::table('directors')->insert([
                'id_project' => $projectId,
                'id_document' => $selectedDocument->id_document,
                'id_teacher' => $selectedTeacher->id_teacher,
                'id_position' => $selectedPosition->id_position,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}