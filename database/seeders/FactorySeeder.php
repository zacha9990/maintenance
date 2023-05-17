<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Factory;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factories = [
            ['name' => 'PGT CIMANGGU', 'location' => 'CIMANGGU'],
            ['name' => 'PGT SAPURAN', 'location' => 'SAPURAN'],
            ['name' => 'PGT WINDUAJI', 'location' => 'WINDUAJI'],
            ['name' => 'PPCI PEMALANG', 'location' => 'PEMALANG']
        ];

        foreach ($factories as $factory) {
            Factory::create($factory);
        }
    }
}
