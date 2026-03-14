<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends Controller
{
    //
    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'customer_name' => 'required|string|max:255',
                'customer_phone' => 'required|string|max:20',
                'customer_email' => 'nullable|email|max:255',
                'customer_address' => 'required|string|max:500',
                'notes' => 'nullable|string',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation échouée.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $items = $request->items;
            $total = 0;

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    return response()->json([
                        'success' => false,
                        'message' => "Produit introuvable : ID {$item['product_id']}.",
                    ], 404);
                }

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stock insuffisant pour le produit : {$product->name}.",
                    ], 422);
                }

                $total += $product->price * $item['quantity'];
            }

            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'notes' => $request->notes,
                'total' => $total,
                'status' => 'confirmed',
            ]);

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'sub_total' => $product->price * $item['quantity'],
                ]);
                $orderItem->save();

                // Mettre à jour le stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            try {
                if ($order->customer_email) {
                    $emailItems = [];
                    foreach ($items as $it) {
                        $prod = Product::find($it['product_id']);
                        if ($prod) {
                            $emailItems[] = [
                                'name' => $prod->name,
                                'quantity' => $it['quantity'],
                                'unit_price' => $prod->price,
                                'sub_total' => $prod->price * $it['quantity'],
                            ];
                        }
                    }
                    Mail::to($order->customer_email)->send(new OrderConfirmation($order, $emailItems));
                }
            } catch (Exception $mailEx) {}

            return response()->json([
                'success' => true,
                'message' => 'Commande enregistrée avec succès.',
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
