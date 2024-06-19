<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_title');
            $table->string('second_title')->nullable();
            $table->text('description')->nullable();
            $table->text('travel_info')->nullable();
            $table->text('health_info')->nullable();
            $table->bigInteger('days')->nullable();
            $table->decimal('price')->default(0);
            $table
                ->boolean('child_price')
                ->default(0)
                ->nullable();
            $table
                ->decimal('additional_per_adult_price')
                ->default(0)
                ->nullable();
            $table
                ->decimal('additional_per_day_price')
                ->default(0)
                ->nullable();
            $table->json('discount_shop_list')->nullable();
            $table->json('discount_service_list');
            $table->bigInteger('expire_days_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
