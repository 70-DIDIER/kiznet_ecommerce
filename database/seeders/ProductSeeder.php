<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = category::all();

        $products = [
            [
                'name' => 'Chanel N°5',
                'description' => 'Un parfum iconique et intemporel.',
                'price' => 120.00,
                'stock' => 50,
                'category_id' => $categories->random()->id,
                'image_path' => 'images/products/chanel-n5.jpg',
            ],
            [
                'name' => 'Dior Sauvage',
                'description' => 'Un parfum masculin audacieux et élégant.',
                'price' => 95.00,
                'stock' => 30,
                'category_id' => $categories->random()->id,
                'image_path' => 'images/products/dior-sauvage.jpg',
            ],
            [
                'name' => 'iPhone 15 Pro Case',
                'description' => 'Coque résistante pour iPhone 15 Pro.',
                'price' => 45.00,
                'stock' => 100,
                'category_id' => $categories->random()->id,
                'image_path' => 'images/products/iphone-case.jpg',
            ],
            [
                'name' => 'MacBook Air 13" Bag',
                'description' => 'Sac élégant pour MacBook Air 13 pouces.',
                'price' => 80.00,
                'stock' => 20,
                'category_id' => $categories->random()->id,
                'image_path' => 'images/products/macbook-bag.jpg',
            ],
            [
                'name' => 'Whisky Macallan 18 ans',
                'description' => 'Whisky single malt exceptionnel.',
                'price' => 250.00,
                'stock' => 15,
                'category_id' => $categories->random()->id,
                'image_path' => 'images/products/macallan.jpg',
            ],
        ];

        foreach ($products as $data) {
            product::create($data);
        }
    }
}