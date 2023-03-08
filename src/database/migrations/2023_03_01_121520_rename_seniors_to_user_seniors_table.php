<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_seniors', function (Blueprint $table) {
            Schema::rename('seniors', 'user_seniors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_seniors', function (Blueprint $table) {
            Schema::rename('user_seniors', 'seniors');
        });
    }
};
