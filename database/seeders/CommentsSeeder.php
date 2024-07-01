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
    }
}