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
            $table->integer('childcare_min_year')->after('acceptable_number')->nullable();
            $table->integer('childcare_min_month')->after('childcare_min_year')->nullable();
            $table->integer('childcare_max_year')->after('childcare_min_month')->nullable();
            $table->integer('childcare_max_month')->after('childcare_max_year')->nullable();
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
