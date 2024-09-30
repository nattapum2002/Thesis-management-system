<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfirmTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have projects, documents, teachers, and positions already seeded, retrieve their ids
        $projectIds = \App\Models\Project::pluck('id_project');
        $documentIds = \App\Models\Document::pluck('id_document');
        $teacherIds = \App\Models\Teacher::pluck('id_teacher');
        $positionIds = \App\Models\Position::pluck('id_position');

        foreach ($projectIds as $projectId) {
            foreach ($documentIds as $documentId) {
                foreach ($teacherIds as $teacherId) {
                    foreach ($positionIds as $positionId) {
                        DB::table('confirm_teachers')->insert([
                            'id_project' => $projectId,
                            'id_document' => $documentId,
                            'id_teacher' => $teacherId,
                            'id_position' => $positionId,
                            'confirm_status' => false,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
