<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = Product::all();

        $orders = [
            [
                'customer_name' => 'Jean Dupont',
                'customer_phone' => '+22890000000',
                'customer_email' => 'jean@example.com',
                'customer_address' => 'Lomé, TOGO',
                'notes' => 'Livraison express souhaitée.',
                'total' => 215.00,
                'status' => 'pending',
            ],
            [
                'customer_name' => 'Marie Curie',
                'customer_phone' => '+2250987654321',
                'customer_email' => 'marie@example.com',
                'customer_address' => 'Attiégou, Lomé',
                'notes' => 'Emballage cadeau souhaité.',
                'total' => 120.00,
                'status' => 'pending',
            ],
        ];

        foreach ($orders as $orderData) {
            $order = Order::create($orderData);

            // Créer des items de commande
            $selectedProducts = $products->random(rand(1, 3));
            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'sub_total' => $quantity * $product->price,
                ]);
            }
        }
    }
}