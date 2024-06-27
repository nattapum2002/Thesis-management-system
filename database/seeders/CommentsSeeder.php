<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Document;
use App\Models\Comment_list;
use App\Models\Teacher;
use App\Models\Position;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $documents = Document::all();
        $commentLists = Comment_list::all();
        $teachers = Teacher::all();
        $positions = Position::whereBetween('id_position', [3, 7])->get();


        foreach ($projects as $project) {
            foreach ($documents as $document) {
                foreach ($commentLists as $commentList) {
                    $teacher = $teachers->random();
                    $position = $positions->random();

                    DB::table('comments')->insert([
                        'comment' => 'This is a sample comment.', // Example comment
                        'id_project' => $project->id_project,
                        'id_document' => $document->id_document,
                        'id_comment_list' => $commentList->id_comment_list,
                        'id_teacher' => $teacher->id_teacher,
                        'id_position' => $position->id_position,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
