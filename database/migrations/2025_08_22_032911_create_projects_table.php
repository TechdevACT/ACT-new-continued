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
        Schema::create('projects', function (Blueprint $table) {
            $table->id()->index();
            $table->foreignId('category_id')->constrained('project_categories')->cascadeOnDelete();
            $table->string('title')->required();
            $table->text('description')->required();
            $table->text('thumbnail')->required();
            $table->string('slug')->required();
            $table->text('project_overview')->required();
            $table->text('project_challenges')->nullable();
            $table->text('project_objectives')->nullable();
            $table->text('project_final_outcome')->nullable();
            $table->text('background')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
