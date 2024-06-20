<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->string('phone')->unique()->after('email');
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });
    }
};
