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
        Schema::create('confirm_students', function (Blueprint $table) {
            $table->id('id_confirm_student');
            $table->string('id_student');
            $table->foreign('id_student')->references('id_student')->on('members');
            $table->foreignId('id_document')->constrained(table: 'documents', column: 'id_document');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_students');
    }
};
