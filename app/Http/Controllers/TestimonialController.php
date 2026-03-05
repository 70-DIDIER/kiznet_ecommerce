<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()
            ->paginate(12);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'imageMode' => ['required', 'in:upload,existing'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_path' => ['nullable', 'string'],
        ]);

        $imagePath = null;

        // Mode upload avec fichier
        if ($request->imageMode === 'upload' && $request->hasFile('image')) {
            $imagePath = ImageService::resizeAndStore(
                $request->file('image'),
                'testimonials',
                600,
                600
            );
        }
        // Mode image existante
        elseif ($request->imageMode === 'existing' && $request->filled('image_path')) {
            $imagePath = $request->input('image_path');
        }

        Testimonial::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'text' => $validated['text'],
            'stars' => $validated['stars'],
            'image' => $imagePath,  // ← Colonne 'image' dans la BDD
        ]);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Témoignage créé avec succès.');
    }

    public function show(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'imageMode' => ['required', 'in:upload,existing,keep'], // ← Ajout de 'keep'
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'image_path' => ['nullable', 'string'],
        ]);

        $imagePath = $testimonial->image; // Garder l'ancienne par défaut

        // Mode upload avec fichier
        if ($request->imageMode === 'upload' && $request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe dans storage/testimonials
            if ($testimonial->image && str_starts_with($testimonial->image, '/storage/testimonials/')) {
                $oldPath = str_replace('/storage/', '', $testimonial->image);
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = ImageService::resizeAndStore(
                $request->file('image'),
                'testimonials',
                600,
                600
            );
        }
        // Mode image existante
        elseif ($request->imageMode === 'existing' && $request->filled('image_path')) {
            // Supprimer l'ancienne image uploadée
            if ($testimonial->image && str_starts_with($testimonial->image, '/storage/testimonials/')) {
                $oldPath = str_replace('/storage/', '', $testimonial->image);
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = $request->input('image_path');
        }
        // Mode keep : on ne change rien, $imagePath garde déjà la valeur actuelle

        $testimonial->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'text' => $validated['text'],
            'stars' => $validated['stars'],
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Supprimer l'image si elle est dans storage/testimonials
        if ($testimonial->image && str_starts_with($testimonial->image, '/storage/testimonials/')) {
            $path = str_replace('/storage/', '', $testimonial->image);
            Storage::disk('public')->delete($path);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Témoignage supprimé avec succès.');
    }

    public function randomTestimonials()
    {
        $testimonials = Testimonial::inRandomOrder()->take(3)->get();

        return view('home', compact('testimonials'));
    }
}
