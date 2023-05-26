<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tool;
use App\Models\Inventory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');

        // Get all tools
        $tools = Tool::all();

        // Create inventories for each tool
        foreach ($tools as $tool) {
            $inventory = new Inventory();
            $inventory->tool_id = $tool->id;
            $inventory->tool_quantity = $faker->numberBetween(1, 10);
            $inventory->tool_location = $faker->address;
            $inventory->tool_status = $faker->randomElement(['Available', 'In Use', 'Under Repair']);
            $inventory->save();
        }
    }
}
