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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('id_teacher');
            $table->string('prefix');
            $table->string('name');
            $table->string('surname');
            $table->string('academic_position');
            $table->text('educational_qualification');
            $table->text('branch');
            $table->string('user_type');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel')->unique()->nullable();
            $table->string('id_line')->unique()->nullable();
            $table->text('teacher_image')->nullable();
            $table->text('signature_image')->nullable();
            $table->string('username');
            $table->string('password');
            $table->boolean('account_status')->default(true);
            $table->rememberToken();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};