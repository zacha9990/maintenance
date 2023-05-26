<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\User;
use App\Models\Position;
use Faker\Factory as FakerFactory;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('id_ID');

        // Get all users and positions
        $users = User::all();
        $positions = Position::all();

        // Create 5 staffs for each position
        foreach ($positions as $position) {
            for ($i = 0; $i < 5; $i++) {
                $staff = new Staff();
                $staff->user_id = $users->random()->id;
                $staff->name = $faker->name;
                $staff->contact = $faker->phoneNumber;
                $staff->work_schedule = $faker->sentence;
                $staff->specialty = $faker->sentence;
                $staff->position_id = $position->id;
                $staff->save();
            }
        }
    }
}
