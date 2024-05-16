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
        Schema::create('document_submission_schedules', function (Blueprint $table) {
            $table->id('id_submission');
            $table->time('time_submission');
            $table->date('date_submission');
            $table->year('year_submission');
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
        Schema::dropIfExists('document_submission_schedules');
    }
};
