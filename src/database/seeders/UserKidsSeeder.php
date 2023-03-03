<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator;

class UserKidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        DB::table('user_kids')->insert([
            'user_id' => 11,
            'last_name' => $faker->lastName(),
            'first_name' => $faker->firstName(),
            'last_kana' => $faker->lastKanaName(),
            'first_kana' => $faker->firstKanaName(),
            'birthday' => $faker->date(),
            'sex' => 0,
            'allergy' => '',
            'other_notes' => '',
            'photo_name' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
