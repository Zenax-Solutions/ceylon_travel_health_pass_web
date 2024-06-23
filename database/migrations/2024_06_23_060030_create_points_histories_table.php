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
        Schema::create('points_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->bigInteger('points')->default(0);
            $table->date('date');
            $table->string('paid_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_histories');
    }
};
