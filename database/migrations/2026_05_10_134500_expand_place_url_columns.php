<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE places MODIFY maps_url TEXT NULL');
        DB::statement('ALTER TABLE places MODIFY video_url TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE places MODIFY maps_url VARCHAR(255) NULL');
        DB::statement('ALTER TABLE places MODIFY video_url VARCHAR(255) NULL');
    }
};
