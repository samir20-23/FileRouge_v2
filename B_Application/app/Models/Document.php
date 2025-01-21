<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    // Specify the table name if it's not the plural form of the model name
    protected $table = 'documents';

    // Define the fillable properties (fields you can mass assign)
    protected $fillable = [
        'title',         // Document title
        'type',          // Document type (e.g., PDF, DOCX)
        'chemin_fichier', // File path (where the document is stored)
    ];

    // Optionally, you can define the relationship to other models (like Category)
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

