<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MouvementController;
use App\Http\Controllers\Api\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produits', ProduitController::class);
    Route::apiResource('mouvements', MouvementController::class);

    Route::get('/stock/{produit}', [ProduitController::class, 'checkStock']);
});
