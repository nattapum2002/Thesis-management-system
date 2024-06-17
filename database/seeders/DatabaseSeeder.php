<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            LevelSeeder::class,
            CourseSeeder::class,
            MembersSeeder::class,
            TeachersSeeder::class,
            ProjectsSeeder::class,
            PositionSeeder::class,
            StudentProjectsSeeder::class,
            StudentsSeeder::class,
            NewsSeeder::class,
            LayoutsSeeder::class,
            DocumentSeeder::class,
            DissertationArticlesSeeder::class,
            Comment_listSeeder::class,
            AdvisersSeeder::class,
            CommentsSeeder::class,
            ConfirmStudentsSeeder::class,
            ConfirmTeachersSeeder::class,
            DirectorsSeeder::class,
            DocumentSubmissionSchedulesSeeder::class,
            ExamSchedulesSeeder::class,
            ScoresSeeder::class
        ]);
    }
}
