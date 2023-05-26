<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToolCategory;
use App\Models\CategorySpecification;
use Faker\Factory as FakerFactory;

class CategorySpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        // Get all tool categories
        $toolCategories = ToolCategory::all();

        // Generate category specifications for each tool category
        foreach ($toolCategories as $toolCategory) {
            $numSpecifications = $faker->numberBetween(3, 5);

            for ($i = 0; $i < $numSpecifications; $i++) {
                $specification = new CategorySpecification();
                $specification->category_id = $toolCategory->id;
                $specification->name = $faker->word;
                $specification->save();
            }
        }
    }
}
