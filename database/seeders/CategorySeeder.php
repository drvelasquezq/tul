<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantityCategories = 100;
        for ($i = 0; $i < $quantityCategories; $i++) {
            Category::factory(1)->create();
        }
    }
}
