<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Liste paginée des catégories avec nombre de produits.
     * (Affiche aussi le formulaire de création sur la même page)
     */
    public function index()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->paginate(12);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Le formulaire est sur la page index: on redirige vers index.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie depuis le formulaire présent sur index.
     * Supporte à la fois un submit classique et un submit AJAX (JSON).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
        ]);

        $category = Category::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie créée avec succès.',
                'data' => $category,
            ], 201);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche une catégorie avec ses produits.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Affiche le formulaire d’édition.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Met à jour une catégorie.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'description' => ['nullable', 'string'],
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime (soft delete) une catégorie.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
