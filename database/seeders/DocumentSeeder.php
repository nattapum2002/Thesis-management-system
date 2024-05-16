<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            'document' => 'เอกสาร 01'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 02'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 03'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 04'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 05'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 06'
        ]);
        DB::table('documents')->insert([
            'document' => 'เอกสาร 07'
        ]);
    }
}
