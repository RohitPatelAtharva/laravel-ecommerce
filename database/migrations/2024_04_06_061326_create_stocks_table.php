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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('mrp', 10, 2);
            $table->double('selling_price', 10, 2)->nullable();
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->string('alert_stock');
            $table->enum('track_qty',['Yes','No'])->default('Yes');
            $table->integer('qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
