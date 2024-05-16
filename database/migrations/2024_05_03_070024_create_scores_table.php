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
        Schema::create('scores', function (Blueprint $table) {
            $table->id('id_score');
            $table->tinyInteger('score');
            $table->string('id_student');
            $table->foreign('id_student')->references('id_student')->on('members');
            $table->foreignId('id_document')->constrained(table: 'documents', column: 'id_document');
            $table->foreignId('id_comment_list')->constrained(table: 'comment_lists', column: 'id_comment_list');
            $table->foreignId('id_teacher')->constrained(table: 'teachers', column: 'id_teacher');
            $table->foreignId('id_position')->constrained(table: 'positions', column: 'id_position');
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
        Schema::dropIfExists('scores');
    }
};
