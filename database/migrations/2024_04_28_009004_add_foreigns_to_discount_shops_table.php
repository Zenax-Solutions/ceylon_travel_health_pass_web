<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('discount_shops', function (Blueprint $table) {
            $table
                ->foreign('agent_id')
                ->references('id')
                ->on('agents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discount_shops', function (Blueprint $table) {
            $table->dropForeign(['agent_id']);
        });
    }
};
