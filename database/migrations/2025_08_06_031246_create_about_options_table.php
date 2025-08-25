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
        Schema::create('about_options', function (Blueprint $table) {
            $table->id()->index();
            $table->string('heading_big')->required();
            $table->string('heading_big2')->required();
            $table->string('heading')->required();
            $table->text('description')->required();
            $table->string('approach_title')->required();
            $table->string('approach_heading')->required();
            $table->text('approach_description')->required();
            $table->string('expertise_title')->required();
            $table->string('emphasis_title')->required();
            $table->string('emphasis_heading')->required();
            $table->text('emphasis_description')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_options');
    }
};
