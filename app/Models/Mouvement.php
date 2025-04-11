<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mouvement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'produit_id',
        'type',
        'quantite',
        'date_mouvement',
    ];

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
