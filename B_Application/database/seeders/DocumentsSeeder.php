<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert documents data
        DB::table('documents')->insert([
            [
                'title' => 'Tech Article 1',
                'type' => 'PDF',
                'chemin_fichier' => Storage::url('documents/tech_article_1.pdf'),
                'categorie_id' => 1, // Assuming 'Technology' category ID is 1
                'user_id' => 1, // Assuming a user with ID 1 exists
            ],
            [
                'title' => 'Health Guide',
                'type' => 'Word',
                'chemin_fichier' => Storage::url('documents/health_guide.docx'),
                'categorie_id' => 2, // Assuming 'Health' category ID is 2
                'user_id' => 2, // Assuming a user with ID 2 exists
            ],
            [
                'title' => 'Business Strategy',
                'type' => 'Excel',
                'chemin_fichier' => Storage::url('documents/business_strategy.xlsx'),
                'categorie_id' => 5, // Assuming 'Business' category ID is 5
                'user_id' => 1, // Assuming a user with ID 1 exists
            ],
            [
                'title' => 'Educational Material',
                'type' => 'PDF',
                'chemin_fichier' => Storage::url('documents/educational_material.pdf'),
                'categorie_id' => 3, // Assuming 'Education' category ID is 3
                'user_id' => 3, // Assuming a user with ID 3 exists
            ],
            [
                'title' => 'Lifestyle Tips',
                'type' => 'Text',
                'chemin_fichier' => Storage::url('documents/lifestyle_tips.txt'),
                'categorie_id' => 4, // Assuming 'Lifestyle' category ID is 4
                'user_id' => 2, // Assuming a user with ID 2 exists
            ],
        ]);
    }
}
