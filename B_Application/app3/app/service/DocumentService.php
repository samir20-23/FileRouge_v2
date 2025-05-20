<?php 
// app/Services/DocumentService.php
namespace App\Services;

use App\Models\Document;

class DocumentService
{
    public function getAll()
    {
        return Document::with('categorie', 'user', 'validation')->latest()->get();
    }

    public function create(array $data)
    {
        return Document::create($data);
    }

    public function delete(Document $document)
    {
        return $document->delete();
    }
}
