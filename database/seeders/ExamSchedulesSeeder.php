<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Document;

class ExamSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $documents = Document::whereIn('id_document', [3, 6])->get();

        foreach ($projects as $project) {
            // สุ่มเลือกจำนวนของ documents ที่จะใช้
            $documentCount = rand(1, $documents->count());
            $selectedDocuments = $documents->random($documentCount);

            foreach ($selectedDocuments as $document) {
                DB::table('exam_schedules')->insert([
                    'exam_time' => now()->addMinutes(rand(0, 1440))->format('H:i:s'), // เพิ่มเวลาสุ่ม
                    'exam_day' => now()->addDays(rand(0, 30))->format('Y-m-d'), // เพิ่มวันสุ่ม
                    'exam_room' => 'Exam Room ' . rand(1, 10), // ห้องสอบสุ่ม
                    'exam_building' => 'Exam Building ' . rand(1, 5), // อาคารสุ่ม
                    'exam_group' => 'Group ' . chr(rand(65, 90)), // กลุ่มสุ่ม A-Z
                    'year_published' => now()->format('Y'),
                    'semester' => rand(1, 2), // สุ่มภาคการศึกษา
                    'id_project' => $project->id_project,
                    'id_document' => $document->id_document,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}