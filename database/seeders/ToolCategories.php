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
            "Mesin-Alat Proses Produksi",
            "Generator Set",
            "Gedung dan Sarana Lain",
            "Alat Pemadam Kebakaran",
            "Komputer"
        ];
        foreach ($categories as $category) {
            ToolCategory::create(['name' => $category]);
        }
    }
}
