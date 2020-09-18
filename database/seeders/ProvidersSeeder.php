<?php

namespace Database\Seeders;

use App\Models\Providers;
use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Providers::factory()->count(10)->create();
    }
}
