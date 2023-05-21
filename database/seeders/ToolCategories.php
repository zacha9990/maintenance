<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToolCategory;

class ToolCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Bangunan",
            "Komputer",
            "Alat Ukur",
            "Pompa Proses Produksi",
            "Alat Proses Produksi"
        ];
        foreach ($categories as $category) {
            ToolCategory::create(['name' => $category]);
        }
    }
}
