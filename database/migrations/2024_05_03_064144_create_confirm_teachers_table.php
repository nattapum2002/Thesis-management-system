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
        Schema::create('confirm_teachers', function (Blueprint $table) {
            $table->id('id_confirm_teacher');
            $table->foreignId('id_project')->constrained(table: 'projects', column: 'id_project');
            $table->foreignId('id_document')->constrained(table: 'documents', column: 'id_document');
            $table->foreignId('id_teacher')->constrained(table: 'teachers', column: 'id_teacher');
            $table->foreignId('id_position')->constrained(table: 'positions', column: 'id_position');
            $table->boolean('confirm_status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_teachers');
    }
};