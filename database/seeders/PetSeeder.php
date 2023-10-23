<?php

namespace Database\Seeders;

use App\Models\Pets;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pets::factory()->count(50)->create();
    }
}
