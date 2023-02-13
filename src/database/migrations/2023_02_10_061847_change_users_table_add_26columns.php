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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('no')->nullable()->after('id');
            $table->integer('state')->nullable();
            $table->integer('trash_user_id')->nullable()->default(0);
            $table->string('last_name')->nullable()->after('remember_token');
            $table->string('first_name')->nullable();
            $table->string('last_kana')->nullable();
            $table->string('first_kana')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('api_token')->nullable();
            $table->integer('identification')->nullable();
            $table->string('birthday')->nullable();
            $table->integer('sex')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('pref_id')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('tel')->nullable();
            $table->string('nearest_station')->nullable();
            $table->text('self_intro')->nullable();
            $table->string('photo')->nullable();
            $table->string('photo_name')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('emergency_contact_tel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
