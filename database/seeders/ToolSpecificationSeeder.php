<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\CategorySpecification;
use App\Models\ToolSpecification;
use Faker\Factory as FakerFactory;

class ToolSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $tools = Tool::all();
        $categorySpecifications = CategorySpecification::all();

        $tools->each(function ($tool) use ($faker, $categorySpecifications) {
            $categorySpecification = $categorySpecifications->where('category_id', $tool->tool_type_id)->first();

            $specificationKeys = $faker->randomElements(['Spec 1', 'Spec 2', 'Spec 3'], $faker->numberBetween(1, 3));

            foreach ($specificationKeys as $key) {
                ToolSpecification::create([
                    'tool_id' => $tool->id,
                    'spec_id' => $categorySpecification->id,
                    'specification_key' => $key,
                    'unit' => $faker->randomElement(['cm', 'kg', 'mm']),
                    'specification_value' => $faker->randomNumber(2),
                ]);
            }
        });
    }
}
