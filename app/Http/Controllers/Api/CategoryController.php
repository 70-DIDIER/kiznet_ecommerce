<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(): JsonResponse
    {
        try {
            $categories = category::withCount('products')->get(['id', 'name', 'description']);

            return response()->json([
                'success' => true,
                'data' => $categories,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des catégories.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}