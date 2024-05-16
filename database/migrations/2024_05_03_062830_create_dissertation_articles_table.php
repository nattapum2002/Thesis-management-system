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
        Schema::create('dissertation_articles', function (Blueprint $table) {
            $table->id('id_dissertation_article');
            $table->string('title');
            $table->text('details');
            $table->text('file_dissertation');
            $table->year('year_published');
            $table->foreignId('id_project')->constrained(table: 'projects', column: 'id_project');
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
        Schema::dropIfExists('dissertation_articles');
    }
};
