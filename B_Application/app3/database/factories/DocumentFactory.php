<?php

// database/factories/DocumentFactory.php
namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'chemin' => $this->faker->url,
            'categorie_id' => Categorie::factory(),
            'user_id' => User::factory(),
        ];
    }
}
