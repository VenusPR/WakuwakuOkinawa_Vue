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
        Schema::table('sitters', function (Blueprint $table) {
            $table->dropColumn('option_id');
            $table->dropColumn('support_place_id');
            $table->dropColumn('childcare_min');
            $table->dropColumn('childcare_max');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sitters', function (Blueprint $table) {
            //
        });
    }
};
