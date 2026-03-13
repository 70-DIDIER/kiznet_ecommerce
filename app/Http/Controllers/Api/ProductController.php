<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    //
    public function index(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_id' => 'nullable|exists:categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation échouée.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $query = Product::with(['category', 'images'])->where('stock', '>', 0);

            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            $products = $query->latest()->paginate($request->get('per_page', 12));

            return response()->json([
                'success' => true,
                'data' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des produits.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = product::with('category')->find($id);

            if (! $product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produit non trouvé.',
                ], 404);
            }

            $isAvailable = $product->stock > 0;

            return response()->json([
                'success' => true,
                'data' => $product,
                'is_available' => $isAvailable,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du produit.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
