<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Document;
use App\Models\Comment_list;
use App\Models\Teacher;
use App\Models\Position;
use Carbon\Carbon;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $students = Member::all();
        // $documents = Document::whereIn('id_document', [3, 6])->get();
        // $commentLists = Comment_list::whereBetween('id_comment_list', [20, 28])->get();
        // $teachers = Teacher::all();
        // $positions = Position::where('id_position', 3)->get();
        // $now = Carbon::now();

        // foreach ($documents as $document) {
        //     foreach ($students as $student) {
        //         foreach ($commentLists as $commentList) {
        //             $teacher = $teachers->random();
        //             $position = $positions->random();
        //             $score = $this->determineScore($commentList->id_comment_list);

        //             DB::table('scores')->insert([
        //                 'score' => $score,
        //                 'id_student' => $student->id_student,
        //                 'id_document' => $document->id_document,
        //                 'id_comment_list' => $commentList->id_comment_list,
        //                 'id_teacher' => $teacher->id_teacher,
        //                 'id_position' => $position->id_position,
        //                 'created_at' => $now,
        //                 'updated_at' => $now,
        //             ]);
        //         }
        //     }
        // }
    }

    /**
     * Determine the score based on the comment list ID.
     *
     * @param int $idCommentList
     * @return int
     */
    private function determineScore(int $idCommentList): int
    {
        switch ($idCommentList) {
            case 20:
                return rand(0, 5);
            case 21:
                return rand(0, 10);
            case 22:
                return rand(0, 5);
            case 23:
                return rand(0, 5);
            case 24:
                return rand(0, 20);
            case 25:
                return rand(0, 10);
            case 26:
                return rand(0, 10);
            case 27:
                return rand(0, 20);
            case 28:
                return rand(0, 15);
            default:
                return 0;
        }
    }
}
