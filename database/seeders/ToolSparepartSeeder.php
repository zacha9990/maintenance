<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tool;
use App\Models\Sparepart;
use App\Models\ToolSparepart;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class ToolSparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');

        // Get all tools and spareparts
        $tools = Tool::all();
        $spareparts = Sparepart::all();

        // Create tool_spareparts
        foreach ($tools as $tool) {
            // Randomly select spareparts for each tool
            $selectedSpareparts = $spareparts->random(rand(0, 5));

            foreach ($selectedSpareparts as $sparepart) {
                $toolSparepart = new ToolSparepart();
                $toolSparepart->tool_id = $tool->id;
                $toolSparepart->sparepart_id = $sparepart->id;
                $toolSparepart->quantity = $faker->numberBetween(1, 10);
                $toolSparepart->save();
            }
        }
    }
}
