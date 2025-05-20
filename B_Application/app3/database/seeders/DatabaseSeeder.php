<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Document;
use App\Models\Validation;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Categorie::factory(5)->create();
        Document::factory(10)->create();
        Validation::factory(10)->create();
    }
}
