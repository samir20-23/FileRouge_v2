<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    // Specify the table name if it's not the plural form of the model name
    protected $table = 'Categories';

    // Define the fillable properties (fields you can mass assign)
    protected $fillable = [
        'name',         // Document title
        'description',          // Document type (e.g., PDF, DOCX)
        'created_at', // File path (where the document is stored)
        'updated_at', 
    ];

}
