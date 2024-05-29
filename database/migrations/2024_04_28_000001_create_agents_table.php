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
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('name');
            $table->string('profile_image')->nullable();
            $table->string('email');
            $table->string('password');
            $table->text('contact_no');
            $table->string('id_no')->nullable();
            $table->string('license_no')->nullable();
            $table->text('bank_details')->nullable();
            $table->bigInteger('points')->default(0);
            $table->bigInteger('commission')->nullable();
            $table->string('commission_payment_status')->nullable();
            $table->date('commission_payment_date')->nullable();
            $table->date('recent_commission_payment_date')->nullable();
            $table->text('recent_info')->nullable();
            $table->string('coupon_code')->nullable();
            $table
                ->string('status')
                ->default('pending')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
