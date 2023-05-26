<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Factory;
use App\Models\ToolCategory;
use Faker\Factory as FakerFactory;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $factories = Factory::all();

        $factories->each(function ($factory) use ($faker) {
            $category = ToolCategory::inRandomOrder()->first();

            for ($i = 0; $i < 20; $i++) {
                Tool::create([
                    'name' => $faker->word,
                    'serial_number' => $faker->unique()->numerify('SN#####'),
                    'function' => $faker->sentence,
                    'brand' => $faker->company,
                    'serial_type' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                    'purchase_date' => $faker->date(),
                    'technical_specification' => $faker->paragraph,
                    'tool_type_id' => $category->id,
                    'factory_id' => $factory->id,
                ]);
            }
        });
    }
}
