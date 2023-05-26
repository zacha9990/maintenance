<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sparepart;
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

        // Create spareparts
        for ($i = 0; $i < 50; $i++) {
            $sparepart = new Sparepart();
            $sparepart->sparepart_name = $faker->word;
            $sparepart->sparepart_quantity = $faker->numberBetween(1, 100);
            $sparepart->sparepart_availability = $faker->randomElement(['In Stock', 'Out of Stock']);
            $sparepart->save();
        }
    }
}
