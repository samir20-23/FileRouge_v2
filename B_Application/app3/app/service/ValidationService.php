<?php 
// app/Services/ValidationService.php
namespace App\Services;

use App\Models\Validation;

class ValidationService
{
    public function getAll()
    {
        return Validation::with('document', 'formateur')->get();
    }

    public function validateDocument($documentId, $formateurId)
    {
        return Validation::updateOrCreate(
            ['document_id' => $documentId],
            ['valide' => true, 'formateur_id' => $formateurId]
        );
    }
}
