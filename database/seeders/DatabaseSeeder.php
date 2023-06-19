<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategorySpecification;
use App\Models\ToolCategory;
use App\Models\ToolSpecification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // PermissionTableSeeder::class,
            PositionSeeder::class, //
            CreateAdminUserSeeder::class,
            ToolCategories::class,
            FactorySeeder::class,
            // ToolSeeder::class,
            // CategorySpecificationSeeder::class, //
            // ToolSpecificationSeeder::class, ///
            // StaffSeeder::class,
            // SparepartSeeder::class,
            // ToolSparepartSeeder::class, //
            // InventorySeeder::class, //
            // StaffSeeder::class, //
        ]);
    }
}
