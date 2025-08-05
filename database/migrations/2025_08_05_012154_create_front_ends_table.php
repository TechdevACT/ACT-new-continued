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
        Schema::create('front_ends', function (Blueprint $table) {
            $table->id()->index();
            $table->string('hero_title')->required();
            $table->string('hero_title2')->required();
            $table->string('hero_description')->required();
            $table->string('about_title')->required();
            $table->string('about_description')->required();
            $table->string('expertise_title')->required();
            $table->string('expertise_heading')->required();
            $table->string('expertise_description')->required();
            $table->string('industry_title')->required();
            $table->string('industry_heading')->required();
            $table->string('industry_description')->required();
            $table->string('blog_title')->required();
            $table->string('blog_heading')->required();
            $table->string('blog_description')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_ends');
    }
};
