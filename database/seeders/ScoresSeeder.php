<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Document;
use App\Models\Comment_list;
use App\Models\Teacher;
use App\Models\Position;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Member::all();
        $documents = Document::whereIn('id_document', [3, 6])->get();
        $commentLists = Comment_list::all();
        $teachers = Teacher::all();
        $positions = Position::whereIn('id_position', [5, 6, 7])->get();

        foreach ($documents as $document) {
            foreach ($students as $student) {
                foreach ($commentLists as $commentList) {
                    $teacher = $teachers->random();
                    $position = $positions->random();

                    DB::table('scores')->insert([
                        'score' => rand(60, 100), // Example score range
                        'id_student' => $student->id_student,
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