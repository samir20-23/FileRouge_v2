<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert categories data
        DB::table('categories')->insert([
            [
                'name' => 'Technology',
                'description' => 'Articles and resources related to technology.',
            ],
            [
                'name' => 'Health',
                'description' => 'Resources on health and wellness.',
            ],
            [
                'name' => 'Education',
                'description' => 'Educational articles and guides.',
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Articles and resources related to lifestyle.',
            ],
            [
                'name' => 'Business',
                'description' => 'Business-related articles and case studies.',
            ],
        ]);
    }
}
