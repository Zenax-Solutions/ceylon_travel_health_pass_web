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
        Schema::create('destination_ticket_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id');
            $table->integer('ticket_stock_count')->default(0);
            $table->integer('selling_ticket_count')->default(0);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_ticket_stock_histories');
    }
};
