<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'prix',
    ];

    // Relation avec les mouvements
    public function mouvements()
    {
        return $this->hasMany(Mouvement::class);
    }

    // Calcul du solde (stock disponible)
    public function solde()
    {
        $entrees = $this->mouvements()->where('type', 'entree')->sum('quantite');
        $sorties = $this->mouvements()->where('type', 'sortie')->sum('quantite');

        return $entrees - $sorties;
    }
}
