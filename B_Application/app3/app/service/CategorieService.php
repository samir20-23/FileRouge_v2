<?php 
// app/Services/CategorieService.php
namespace App\Services;

use App\Models\Categorie;

class CategorieService
{
    public function getAll()
    {
        return Categorie::all();
    }

    public function create(array $data)
    {
        return Categorie::create($data);
    }
}
