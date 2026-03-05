<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Parfums',
                'description' => 'Large sélection de parfums de luxe pour hommes et femmes.',
            ],
            [
                'name' => 'Cosmétiques',
                'description' => 'Maquillage, soins et produits de beauté des marques internationales.',
            ],
            [
                'name' => 'Électronique',
                'description' => 'Accessoires électroniques et gadgets pour les voyageurs.',
            ],
            [
                'name' => 'Alcools',
                'description' => 'Vins, whiskies, rhums et spiritueux du monde entier.',
            ],
            [
                'name' => 'Chocolats & Gourmandises',
                'description' => 'Spécialités gourmandes et chocolats fins.',
            ],
        ];

        foreach ($categories as $data) {
            category::create($data);
        }
    }
}