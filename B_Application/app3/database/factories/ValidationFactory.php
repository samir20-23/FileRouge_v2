<?php

// database/factories/ValidationFactory.php
namespace Database\Factories;

use App\Models\Validation;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValidationFactory extends Factory
{
    protected $model = Validation::class;

    public function definition()
    {
        return [
            'document_id' => Document::factory(),
            'valide' => $this->faker->boolean,
            'formateur_id' => User::factory(),
        ];
    }
}
