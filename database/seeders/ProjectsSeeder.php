<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectStatuses = ['Pending', 'In Progress', 'Completed'];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('projects')->insert([
                'project_name_th' => 'โครงการที่ ' . $i,
                'project_name_en' => 'Project ' . $i,
                'project_status' => $projectStatuses[array_rand($projectStatuses)],
                'created_by' => null, // You can adjust this if you have a user table
                'updated_by' => null, // You can adjust this if you have a user table
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
