# Gestion Stock API

Cette API est conçue pour gérer les stocks de produits et les mouvements associés. Elle utilise Laravel comme framework et est conçue pour être facilement intégrée dans des applications web.
Introduction à l'API

Cette API permet de gérer les produits et leurs mouvements de stock. Elle inclut des fonctionnalités pour créer, lire, mettre à jour et supprimer des produits et des mouvements. De plus, elle permet de vérifier le stock disponible d'un produit.
Authentification

L'authentification est gérée via le package Laravel Sanctum. Vous devez vous connecter pour accéder à la plupart des routes.

- Inscription : POST /api/auth/register

        Corps de la requête : name, email, password, password_confirmation

- Connexion : POST /api/auth/login

        Corps de la requête : email, password

Une fois connecté, vous obtiendrez un token d'authentification que vous devrez inclure dans le header Authorization: Bearer votre_token_api pour toutes les requêtes protégées.

## Choix des tables

Pour gérer efficacement le magasin, nous avons choisi de travailler avec deux tables principales : produits et mouvements.

### Table produits

La table produits stocke les informations de base sur chaque produit, comme le nom, la description et le prix. Elle permet de gérer facilement les produits et sert de référence pour les mouvements.
Table mouvements

La table mouvements permet de suivre toutes les transactions de produits, qu'il s'agisse d'entrées ou de sorties. Elle est essentielle pour calculer le stock disponible et analyser les mouvements passés.
Relation entre les tables

La relation entre ces deux tables permet de consolider les données pour chaque produit et d'analyser les performances de vente ou d'approvisionnement.
Avantages

Cette structure est flexible, scalable et simple, ce qui la rend idéale pour gérer les opérations courantes d'un magasin.
Routes API


# Procédures de gestion des produits

1. Afficher la liste des produits : GET /api/produits

2. Créer un produit : POST /api/produits

    Corps de la requête : nom, description, prix

3. Détail d'un produit : GET /api/produits/{id}

4. Mettre à jour un produit : PUT /api/produits/{id}

    Corps de la requête : nom, description, prix

5. Supprimer un produit : DELETE /api/produits/{id}

# Procédure de gestion des mouvements

- Afficher la liste des mouvements : GET /api/mouvements

- Créer un mouvement : POST /api/mouvements

    Corps de la requête : produit_id, type, quantite, date_mouvement

    Types possibles : entree, sortie

- Détail d'un mouvement : GET /api/mouvements/{id}

- Mettre à jour un mouvement : PUT /api/mouvements/{id}

    Corps de la requête : produit_id, type, quantite, date_mouvement

- Supprimer un mouvement : DELETE /api/mouvements/{id}


# Stock Disponible

- Vérifier le stock disponible : GET /api/stock/{produit}

# Exemples de requêtes

- Créer un produit

    json
    POST /api/produits
    Content-Type: application/json

    {
        "nom": "Produit de test",
        "description": "Description du produit",
        "prix": inserer le prix sans guillemets
    }

- Créer un mouvement

    json
    POST /api/mouvements 
    Content-Type: application/json

    {
        "produit_id": 1,
        "type": "entree",
        "quantite": 10,
        "date_mouvement": "2025-04-11"
    }

- Vérifier le stock disponible

bash
GET /api/stock/{id}

# Sécurité

Toutes les routes, sauf celles d'authentification, nécessitent un token d'authentification valide.

Utilisez le header Authorization: Bearer votre_token_api pour authentifier vos requêtes.

# Dépannage

- Erreurs de migration : Assurez-vous que vos migrations sont correctes et exécutez php artisan migrate:fresh si nécessaire.

- Problèmes d'authentification : Vérifiez que votre token est valide et bien inclus dans les requêtes.

- Erreurs de requêtes : Consultez les logs Laravel pour identifier les erreurs.
