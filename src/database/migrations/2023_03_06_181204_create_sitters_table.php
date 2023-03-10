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
        Schema::create('sitters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title')->nullable();
            $table->text('contents')->nullable();
            $table->text('notes')->nullable();
            $table->text('experience')->nullable();
            $table->string('fee')->nullable();
            $table->string('plus_fee')->nullable();
            $table->integer('acceptable_number')->nullable();
            $table->string('childcare_min')->nullable();
            $table->string('childcare_max')->nullable();
            $table->string('min_support_hour')->nullable();
            $table->integer('option_id')->nullable();
            $table->integer('support_place_id')->nullable();
            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->string('photo_4')->nullable();
            $table->string('photo_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitters');
    }
};
