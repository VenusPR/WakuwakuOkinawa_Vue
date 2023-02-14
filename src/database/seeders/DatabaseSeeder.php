<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();

        $this->call(RegionsSeeder::class);
        $this->call(PrefecturesSeeder::class);

        // \App\Models\User::factory()->create([
        //     'last_name' => $faker->lastName,
        //     'first_name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => 'testhello@'
        // ]);
    }
}
