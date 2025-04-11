<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mouvement;
use App\Models\Produit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MouvementController extends Controller
{
    // Liste des mouvements
    public function index()
    {
        return response()->json(Mouvement::with('produit')->get());
    }

    // Création d'un mouvement (entrée ou sortie)
    public function store(Request $request):JsonResponse
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'date_mouvement' => 'required|date',
        ]);

        // Vérification du stock disponible pour les sorties
        if ($request->type === "sortie") {
            $produit = Produit::findOrFail($request->produit_id);
            if ($produit->solde() < $request->quantite) {
                return response()->json(['message' => "Stock insuffisant pour effectuer cette sortie."], 400);
            }
        }

        $mouvement = Mouvement::create($request->all());

        return response()->json(['message' => "Mouvement enregistré avec succès.", "mouvement" => $mouvement], 201);
    }

    // Affichage d'un mouvement spécifique
    public function show(Mouvement $mouvement):JsonResponse
    {
        return response()->json($mouvement);
    }

    // Mise à jour d'un mouvement (optionnel)
    public function update(Request $request, Mouvement $mouvement)
    {
        return response()->json(['message' => "Mise à jour non autorisée pour les mouvements."]);
    }

    // Suppression d'un mouvement
    public function destroy(Mouvement $mouvement):JsonResponse
    {
        $mouvement->delete();

        return response()->json(['message' => "Mouvement supprimé avec succès."]);
    }
}
