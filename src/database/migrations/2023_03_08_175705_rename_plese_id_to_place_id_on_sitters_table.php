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
        Schema::table('sitter_place', function (Blueprint $table) {
            $table->renameColumn('plase_id', 'place_id');
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
            $table->renameColumn('place_id', 'plase_id');
        });
    }
};
