<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dom\Document; 
class Validation extends Model
{
    protected $fillable = ['document_id','validated_by','status','commentaire','validated_at'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'categorie_id');
    }
}
