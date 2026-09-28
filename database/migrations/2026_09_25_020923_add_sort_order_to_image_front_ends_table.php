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
        Schema::table('image_front_ends', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('image_front_ends', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
