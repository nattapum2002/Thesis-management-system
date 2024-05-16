<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id('id_exam_schedule');
            $table->time('exam_time');
            $table->date('exam_day');
            $table->string('exam_room');
            $table->string('exam_building');
            $table->string('exam_group');
            $table->year('year_published');
            $table->tinyInteger('semester');
            $table->foreignId('id_project')->constrained(table: 'projects', column: 'id_project');
            $table->foreignId('id_document')->constrained(table: 'documents', column: 'id_document');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};
