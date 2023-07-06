<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sparepart;
use App\Models\Factory;
use Faker\Factory as FakerFactory;

class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');

        $factories = Factory::all();

        foreach ($factories as $factory) {
            $sparePartsCount = $faker->numberBetween(1, 5);

            for ($i = 0; $i < $sparePartsCount; $i++) {
                $sparePart = SparePart::create([
                    'sparepart_name' => $faker->word,
                ]);

                $quantity = $faker->numberBetween(10, 100);

                $factory->spareParts()->attach($sparePart, ['quantity' => $quantity]);
            }
        }
    }
}
