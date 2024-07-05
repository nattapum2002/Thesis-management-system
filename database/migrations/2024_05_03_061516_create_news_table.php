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
        Schema::create('news', function (Blueprint $table) {
            $table->id('id_news');
            $table->string('title');
            $table->text('details');
            $table->text('news_image')->nullable();
            $table->string('type'); // 'general' หรือ 'topic'
            $table->boolean('status')->default(true);
            $table->foreignId('id_teacher')->constrained(table: 'teachers', column: 'id_teacher');
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
        Schema::dropIfExists('news');
    }
};
