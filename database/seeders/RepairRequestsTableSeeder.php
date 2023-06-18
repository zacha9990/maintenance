<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\RepairRequest;
use App\Models\Staff;
use App\Models\Tool;

class RepairRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $statuses = ['reported', 'working', 'finished', 'cancelled'];

        for ($i = 0; $i < 100; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 year');
            $approved = $faker->randomElement([0, 1, 99]);
            $approvedAt = null;

            if ($approved == 1) {
                $approvedAt = $faker->dateTimeBetween($createdAt, 'now');
            }

            $status = $faker->randomElement($statuses);

            $staffId = Staff::inRandomOrder()->first()->id;
            $toolId = Tool::inRandomOrder()->first()->id;

            RepairRequest::create([
                'staff_id' => $staffId,
                'tool_id' => $toolId,
                'description' => $faker->text,
                'status' => $status,
                'approved' => $approved,
                'approved_at' => $approvedAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
