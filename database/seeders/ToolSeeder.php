<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ToolCategory;
use App\Models\Factory;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $toolCategories = ToolCategory::pluck('id');
        $factories = Factory::pluck('id');

        for ($i = 0; $i < 100; $i++) {
            $tool = [
                'name' => $faker->word,
                'serial_number' => $faker->unique()->numberBetween(1000, 9999),
                'function' => $faker->sentence,
                'brand' => $faker->word,
                'serial_type' => $faker->word,
                'purchase_date' => $faker->date(),
                'technical_specification' => $faker->paragraph,
                'tool_type_id' => $toolCategories->random(),
                'factory_id' => $factories->random(),
            ];

            Tool::create($tool);
        }
    }
}
