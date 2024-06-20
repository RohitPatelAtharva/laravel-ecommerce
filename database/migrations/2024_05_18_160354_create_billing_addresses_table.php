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
        Schema::create('billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('b_name')->nullable();
            $table->string('b_email')->nullable();
            $table->string('b_phone')->nullable();
            $table->string('b_address')->nullable();
            $table->string('b_country')->nullable();
            $table->string('b_city')->nullable();
            $table->string('zip')->nullable();
            $table->string('b_company')->nullable();
            $table->string('s_name')->nullable();
            $table->string('s_email')->nullable();
            $table->string('s_phone')->nullable();
            $table->string('s_address')->nullable();
            $table->string('s_country')->nullable();
            $table->string('s_city')->nullable();
            $table->string('s_zip')->nullable();
            $table->string('s_company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_addresses');
    }
};
