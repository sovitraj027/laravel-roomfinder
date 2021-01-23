<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::create([
            'name' => 'Multiple Rooms'
        ]);

        Category::create([
            'name' => 'Apartment'
        ]);

        Category::create([
            'name' => 'Flat'
        ]);

        Category::create([
            'name' => 'Office Space'
        ]);

        Category::create([
            'name' => 'House'
        ]);

    }
}
