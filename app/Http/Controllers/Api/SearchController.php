<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    //
    public function search(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'input' => 'nullable|string|max:255',
                'category_id' => 'nullable|exists:categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation échouée.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $query = Product::with('category');

            if ($request->filled('input')) {
                $query->where('name', 'like', '%' . $request->input . '%');
            }

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $results = $query->get(['id', 'name', 'description', 'price', 'stock', 'image_path', 'category_id']);

            return response()->json([
                'success' => true,
                'data' => $results,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la recherche.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}