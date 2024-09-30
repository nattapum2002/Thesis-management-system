<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSubmissionSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = \App\Models\Document::all();

        foreach ($documents as $document) {
            DB::table('document_submission_schedules')->insert([
                'time_submission' => now()->format('H:i:s'),
                'date_submission' => now()->addDay(10)->format('Y-m-d'),
                'year_submission' => now()->format('Y'),
                'status' => true,
                'id_document' => $document->id_document,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
