<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ToolCategory;
use App\Models\MaintenanceCriteria;
use Faker\Factory as FakerFactory;

class MaintenanceCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        // Mendapatkan tool categories yang tidak memiliki maintenance criteria
        $toolCategories = ToolCategory::has('maintenanceCriteria', '=', 0)->get();

        foreach ($toolCategories as $toolCategory) {
            $numCriteria = $faker->numberBetween(1, 5);

            // Menambahkan maintenance criteria ke tool category
            for ($i = 0; $i < $numCriteria; $i++) {
                MaintenanceCriteria::create([
                    'category_id' => $toolCategory->id,
                    'name' => $faker->word,
                    'description' => $faker->sentence
                ]);
            }
        }
    }
}
