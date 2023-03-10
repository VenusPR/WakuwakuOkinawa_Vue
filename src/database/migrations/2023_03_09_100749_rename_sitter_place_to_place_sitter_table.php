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
        Schema::table('place_sitter', function (Blueprint $table) {
            Schema::rename('sitter_place', 'place_sitter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('place_sitter', function (Blueprint $table) {
            Schema::rename('place_sitter', 'sitter_place');
        });
    }
};
