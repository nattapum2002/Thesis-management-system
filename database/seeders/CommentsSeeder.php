<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have projects, documents, comment_lists, teachers, and positions already seeded, retrieve their ids
        $projectIds = \App\Models\Project::pluck('id_project');
        $documentIds = \App\Models\Document::pluck('id_document');
        $commentListIds = \App\Models\Comment_list::pluck('id_comment_list');
        $teacherIds = \App\Models\Teacher::pluck('id_teacher');
        $positionIds = \App\Models\Position::pluck('id_position');

        foreach ($projectIds as $projectId) {
            foreach ($documentIds as $documentId) {
                foreach ($commentListIds as $commentListId) {
                    foreach ($teacherIds as $teacherId) {
                        foreach ($positionIds as $positionId) {
                            DB::table('comments')->insert([
                                'comment' => 'This is a sample comment.', // Example comment
                                'id_project' => $projectId,
                                'id_document' => $documentId,
                                'id_comment_list' => $commentListId,
                                'id_teacher' => $teacherId,
                                'id_position' => $positionId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
