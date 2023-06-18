<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Staff,
    Position,
};
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Perhutani',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::where('name', 'SuperAdmin')->first();
        $positionRole = Position::where('name', 'SuperAdmin')->first();

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $staff = new Staff();
        $staff->user_id = $user->id;
        $staff->position_id = $positionRole->id;
        $staff->work_schedule = "";
        // Set other fields as needed
        $staff->save();

        // --------------------------------

        $userOperator = User::create([
            'name' => 'Operator Perhutani',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $operatorRole = Role::create(['name' => 'Operator']);

        $userOperator->assignRole([$operatorRole->id]);

        // --------------------------------

        $userManager = User::create([
            'name' => 'Manager Perhutani',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $managerRole = Role::create(['name' => 'Manager']);

        $userManager->assignRole([$managerRole->id]);

        // --------------------------------

        $userTeknisi = User::create([
            'name' => 'Teknisi Perhutani',
            'email' => 'teknisi@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $teknisiRole = Role::where('name', 'Teknisi')->first();
        $positionRole = Position::where('name', 'Teknisi')->first();

        $userTeknisi->assignRole([$teknisiRole->id]);

        $staff = new Staff();
        $staff->user_id = $userTeknisi->id;
        $staff->position_id = $positionRole->id;
        $staff->work_schedule = "";
        // Set other fields as needed
        $staff->save();
    }
}
