<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = \App\Models\Project::all();
        $documents = \App\Models\Document::all();

        foreach ($projects as $project) {
            foreach ($documents as $document) {
                DB::table('exam_schedules')->insert([
                    'exam_time' => now()->format('H:i:s'),
                    'exam_day' => now()->format('Y-m-d'),
                    'exam_room' => 'Exam Room',
                    'exam_building' => 'Exam Building',
                    'exam_group' => 'Group A',
                    'year_published' => now()->format('Y'),
                    'semester' => 1, // Example semester
                    'id_project' => $project->id_project,
                    'id_document' => $document->id_document,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
