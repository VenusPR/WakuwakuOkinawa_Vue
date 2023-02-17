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
        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_kana')->nullable();
            $table->string('first_kana')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('sex')->nullable();
            $table->string('allergy')->nullable();
            $table->string('other_notes')->nullable();
            $table->string('photo_name')->nullable();
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
        Schema::dropIfExists('kids');
    }
};
