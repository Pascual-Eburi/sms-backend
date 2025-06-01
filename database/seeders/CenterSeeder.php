<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 5; $i++) {
            $mainCenter = Center::factory()->create();

            Center::factory()
                ->count(rand(1, 5))
                ->branch($mainCenter)
                ->create();
        }
    }
}
