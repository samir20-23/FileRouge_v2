<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Call individual seeders
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            DocumentsSeeder::class,
        ]);
    }
}
