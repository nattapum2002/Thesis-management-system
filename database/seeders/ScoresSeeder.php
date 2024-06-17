<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = \App\Models\Member::all();
        $documents = \App\Models\Document::all();
        $commentLists = \App\Models\Comment_list::all();
        $teachers = \App\Models\Teacher::all();
        $positions = \App\Models\Position::all();

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
