<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\Testimonial;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::with('category')
            ->latest()
            ->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::orderBy('name')->get(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_path' => ['nullable', 'string'],
        ]);

        // Gestion de l'image: priorité à l'upload, sinon chemin fourni
        if ($request->hasFile('image')) {
            $validated['image_path'] = ImageService::resizeAndStore($request->file('image'));
        } elseif ($request->filled('image_path')) {
            $validated['image_path'] = (string) $request->input('image_path');
        }

        product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = product::with('category')->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::findOrFail($id);
        $categories = category::orderBy('name')->get(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = product::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id),
            ],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_path' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = ImageService::resizeAndStore($request->file('image'));
        } elseif ($request->filled('image_path')) {
            $validated['image_path'] = (string) $request->input('image_path');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    public function randomProduit()
    {
        $products = Product::inRandomOrder()->limit(3)->get();
        $testimonials = Testimonial::latest()->get();

        return view('home', compact('products', 'testimonials'));
    }

    // Pour la page ABOUT
    public function about()
    {
        $testimonials = Testimonial::latest()->get();

        return view('about', compact('testimonials'));
    }
}
