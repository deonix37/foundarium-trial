<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Driver::factory(10)->create();
        \App\Models\Car::factory(10)->create();
    }
}
