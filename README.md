NB: une fois le projet telecharger, installer les plugins composer necessaire (composer install) , il faudra faire la migration (php artisan migrate).
ensuite faire l'insersion des données préenregistrées seedings, par (php artisan db:seed)

compte User (role superadmin)
pseudo: admin | password: admin1234

Documentation des API – ARCHIPEL DUTY-FREE
Version : v1
Base URL : https://domaine.com/api/v1
Méthodes d’accès : Public (aucune authentification requise)
Format des réponses : JSON
Méthodes HTTP supportées : GET, POST

1. Récupérer toutes les catégories
   Endpoint : GET /categories
   Description : Retourne la liste de toutes les catégories de produits avec le nombre de produits associés.
   {
   "success": true,
   "data": [
   {
   "id": 1,
   "name": "Parfums",
   "description": "Large sélection de parfums de luxe...",
   "products_count": 8
   },
   {
   "id": 2,
   "name": "Cosmétiques",
   "description": "Maquillage, soins et produits de beauté...",
   "products_count": 12
   }
   ]
   }

2. Récupérer les produits disponibles
   Endpoint : GET /products
   Description : Retourne tous les produits en stock (stock > 0).
   Paramètres optionnels :

category_id : Filtrer par catégorie
Exemples :

GET /api/v1/products
GET /api/v1/products?category_id=2

{
"success": true,
"data": [
{
"id": 1,
"name": "Chanel N°5",
"description": "Un parfum iconique...",
"price": 120.00,
"stock": 50,
"image_path": "images/products/chanel-n5.jpg",
"category_id": 1
}
]
}

3. Récupérer un produit par ID
   Endpoint : GET /products/{id}
   Description : Retourne les détails d’un produit spécifique + statut de disponibilité.

Exemple :
GET /api/v1/products/1

{
"success": true,
"data": {
"id": 1,
"name": "Chanel N°5",
"description": "Un parfum iconique...",
"price": 120.00,
"stock": 50,
"image_path": "images/products/chanel-n5.jpg",
"category_id": 1
},
"is_available": true
}

4. Rechercher des produits par nom ou catégorie
   Endpoint : GET /search
   Description : Recherche de produits par nom (q) et/ou par catégorie (category_id).
   Paramètres :

input (optionnel) : mot-clé dans le nom du produit
category_id (optionnel) : ID de la catégorie
Exemples :

GET /api/v1/search?input=chanel
GET /api/v1/search?category_id=1
GET /api/v1/search?input=mac&category_id=3
{
"success": true,
"data": [
{
"id": 1,
"name": "Chanel N°5",
"price": 120.00,
"stock": 50,
"category_id": 1
}
]
}

5. Créer une commande (sans compte client)
   Endpoint : POST /orders
   Description : Enregistre une commande client avec les produits, quantités et coordonnées.
   Validation : Vérifie le stock avant validation.

Corps de la requête (JSON)
{
"customer_name": "Jean Dupont",
"customer_phone": "+2250123456789",
"customer_email": "jean@example.com",
"customer_address": "Abidjan, Cocody",
"notes": "Livraison rapide s'il vous plaît",
"items": [
{
"product_id": 1,
"quantity": 2
},
{
"product_id": 5,
"quantity": 1
}
]
}

Réponse réussie (201 Created)
{
"success": true,
"message": "Commande enregistrée avec succès.",
}
