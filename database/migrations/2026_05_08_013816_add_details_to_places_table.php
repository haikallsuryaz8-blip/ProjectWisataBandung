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
        Schema::table('places', function (Blueprint $table) {
            $table->decimal('ticket_price', 10, 2)->nullable()->after('visitors');
            $table->string('opening_hours')->nullable()->after('ticket_price');
            $table->string('maps_url')->nullable()->after('opening_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn(['ticket_price', 'opening_hours', 'maps_url']);
        });
    }
};
