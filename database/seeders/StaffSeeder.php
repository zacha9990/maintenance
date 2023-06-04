<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\User;
use App\Models\Position;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $positions = Position::all();

        // Create 5 staffs for each position
        foreach ($positions as $position) {
            for ($i = 0; $i < 5; $i++) {
                $user = User::create([
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'contact' => $faker->phoneNumber,
                    'password' => Hash::make('password'),
                    'type' => 'R',
                ]);

                $staff = new Staff();
                $staff->user_id = $user->id;
                $staff->work_schedule = $faker->sentence;
                $staff->specialty = $faker->sentence;
                $staff->position_id = $position->id;
                $staff->save();
            }
        }
    }
}
