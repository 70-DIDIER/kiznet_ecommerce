<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);

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
            'images.*' => ['nullable', 'image', 'max:2048'],
        ]);

        // Gestion de l'image principale: priorité à l'upload, sinon chemin fourni
        if ($request->hasFile('image')) {
            $validated['image_path'] = ImageService::resizeAndStore($request->file('image'));
        } elseif ($request->filled('image_path')) {
            $validated['image_path'] = (string) $request->input('image_path');
        }

        $product = Product::create($validated);

        // Gestion des images supplémentaires
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = ImageService::resizeAndStore($image);
                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function publicShow(string $id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

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
            'images.*' => ['nullable', 'image', 'max:2048'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['exists:product_images,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = ImageService::resizeAndStore($request->file('image'));
        } elseif ($request->filled('image_path')) {
            $validated['image_path'] = (string) $request->input('image_path');
        }

        $product->update($validated);

        // Supprimer les images sélectionnées
        if ($request->filled('delete_images')) {
            $imagesToDelete = \App\Models\ProductImage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $img) {
                // Supprimer le fichier physique si ce n'est pas une URL externe
                if (! Str::startsWith($img->image_path, 'http')) {
                    $relativePath = str_replace('/storage/', '', $img->image_path);
                    Storage::disk('public')->delete($relativePath);
                }
                $img->delete();
            }
        }

        // Ajouter de nouvelles images
        if ($request->hasFile('images')) {
            $lastOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = ImageService::resizeAndStore($image);
                $product->images()->create([
                    'image_path' => $path,
                    'sort_order' => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    public function randomProduit()
    {
        $products = Product::with('category')->latest()->limit(8)->get();
        $bestSellers = Product::with('category')->inRandomOrder()->limit(4)->get();
        $categories = Category::withCount('products')->get();
        $testimonials = Testimonial::latest()->get();

        return view('home', compact('products', 'bestSellers', 'categories', 'testimonials'));
    }

    // Pour la page ABOUT
    public function about()
    {
        $testimonials = Testimonial::latest()->get();

        return view('about', compact('testimonials'));
    }
}
