<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfirmStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assume you have members and documents already seeded, retrieve their ids
        $memberIds = \App\Models\Member::pluck('id_student');
        $documentIds = \App\Models\Document::pluck('id_document');

        foreach ($memberIds as $memberId) {
            foreach ($documentIds as $documentId) {
                DB::table('confirm_students')->insert([
                    'id_student' => $memberId,
                    'id_document' => $documentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
