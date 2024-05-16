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
        Schema::create('members', function (Blueprint $table) {
            $table->string('id_student')->primary();
            $table->string('prefix');
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel')->unique();
            $table->string('id_line')->unique()->nullable();
            $table->text('student_image')->nullable();
            $table->foreignId('id_level')->constrained(table: 'levels', column: 'id_level');
            $table->foreignId('id_course')->constrained(table: 'courses', column: 'id_course');
            $table->string('username');
            $table->string('password');
            $table->string('account_status');
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
};
