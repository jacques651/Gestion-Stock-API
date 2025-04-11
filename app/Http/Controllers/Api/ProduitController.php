<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Liste des produits
    public function index()
    {
        return response()->json(Produit::all());
    }

    // Création d'un produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ]);

        $produit = Produit::create($request->all());

        return response()->json(['message' => 'Produit créé avec succès.', 'produit' => $produit], 201);
    }

    // Affichage d'un produit spécifique
    public function show(Produit $produit)
    {
        return response()->json($produit);
    }

    // Mise à jour d'un produit
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'sometimes|required|numeric|min:0',
        ]);

        $produit->update($request->all());

        return response()->json(['message' => 'Produit mis à jour avec succès.', 'produit' => $produit]);
    }

    // Suppression logique d'un produit
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès.']);
    }

    // Vérification du stock d'un produit
    public function checkStock(Produit $produit)
    {
        return response()->json(['stock_disponible' => $produit->solde()]);
    }
}
