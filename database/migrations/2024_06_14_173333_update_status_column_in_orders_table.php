<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Ensure all existing rows have valid status values
        DB::table('orders')
            ->whereNotIn('status', ['pending', 'shipped', 'delivered'])
            ->update(['status' => 'pending']);
        
        // Now, safely modify the ENUM column
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending'");
    }

    public function down()
    {
        // Revert the change if needed
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'shipped', 'delivered') DEFAULT 'pending'");
    }
};
