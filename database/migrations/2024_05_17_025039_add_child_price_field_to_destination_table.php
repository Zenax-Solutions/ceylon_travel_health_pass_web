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
        Schema::table('destinations', function (Blueprint $table) {
            $table->decimal('child_south_asian_price')->default(0)->after('non_south_asian_price');
            $table->decimal('child_non_south_asian_price')->default(0)->after('child_south_asian_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('child_south_asian_price');
            $table->dropColumn('child_non_south_asian_price');
        });
    }
};
