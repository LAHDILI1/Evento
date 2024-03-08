<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
           'name' => 'Business',
        ]);
        Category::create([
            'name' => 'Incentives',
        ]);
        Category::create([
            'name' => 'Sports',
        ]);

        Category::create([
            'name' => 'Political',
        ]);

        Category::create([
            'name' => 'Religious',
        ]);
        Category::create([
            'name' => 'Lifecycle & Milestones',
        ]);
        Category::create([
            'name' => 'Social',
        ]);
        Category::create([
            'name' => 'Cultural',
        ]);
        Category::create([
            'name' => 'Corporate',
        ]);
        Category::create([
            'name' => 'Educational',
        ]);

        Category::create([
            'name' => 'Fundraising',
        ]);


    }
}
