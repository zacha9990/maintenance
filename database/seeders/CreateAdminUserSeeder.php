<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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

        $role = Role::create(['name' => 'SuperAdmin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

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

        $teknisiRole = Role::create(['name' => 'Teknisi']);

        $userTeknisi->assignRole([$teknisiRole->id]);
    }
}
