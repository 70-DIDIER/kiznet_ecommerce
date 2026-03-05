<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class SiteInfoController extends Controller
{
    /**
     * Tableau de bord principal avec sections
     */
    public function index()
    {
        // Récupérer toutes les infos organisées
        $sections = [
            'general' => [
                'title' => 'Informations générales',
                'icon' => 'ℹ️',
                'keys' => ['logo', 'phone', 'email', 'site_description']
            ],
            'location' => [
                'title' => 'Localisation',
                'icon' => '📍',
                'keys' => ['address', 'map_url']
            ],
            'social' => [
                'title' => 'Réseaux sociaux',
                'icon' => '🌐',
                'keys' => ['facebook_url', 'instagram_url', 'twitter_url']
            ],
        ];

        // Récupérer toutes les infos d'un coup
        $allInfos = SiteInfo::all()->keyBy('key');

        return view('admin.site-infos.index', compact('sections', 'allInfos'));
    }

    /**
     * Afficher/Éditer une section complète
     */
    public function editSection(string $section)
    {
        $sectionsConfig = [
            'general' => [
                'title' => 'Informations générales',
                'fields' => [
                    'logo' => ['label' => 'Logo du site', 'type' => 'image'],
                    'phone' => ['label' => 'Numéro de téléphone', 'type' => 'text', 'placeholder' => '+228 XX XX XX XX'],
                    'email' => ['label' => 'Email de contact', 'type' => 'email', 'placeholder' => 'contact@dutyfree.tg'],
                    'site_description' => ['label' => 'Description du site', 'type' => 'textarea', 'placeholder' => 'Décrivez votre site...'],
                ]
            ],
            'location' => [
                'title' => 'Localisation',
                'fields' => [
                    'address' => ['label' => 'Adresse complète', 'type' => 'textarea', 'placeholder' => 'Boulevard du 13 Janvier, Lomé, Togo'],
                    'map_url' => ['label' => 'URL Google Maps (iframe)', 'type' => 'textarea', 'placeholder' => 'https://www.google.com/maps/embed?pb=...'],
                ]
            ],
            'social' => [
                'title' => 'Réseaux sociaux',
                'fields' => [
                    'facebook_url' => ['label' => 'Page Facebook', 'type' => 'url', 'placeholder' => 'https://facebook.com/votreepage'],
                    'instagram_url' => ['label' => 'Compte Instagram', 'type' => 'url', 'placeholder' => 'https://instagram.com/votrecompte'],
                    'twitter_url' => ['label' => 'Compte Twitter/X', 'type' => 'url', 'placeholder' => 'https://twitter.com/votrecompte'],
                ]
            ],
        ];

        if (!isset($sectionsConfig[$section])) {
            abort(404);
        }

        $config = $sectionsConfig[$section];
        $keys = array_keys($config['fields']);
        $siteInfos = SiteInfo::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        return view('admin.site-infos.edit-section', compact('section', 'config', 'siteInfos'));
    }

    /**
     * Mettre à jour une section complète
     */
    public function updateSection(Request $request, string $section)
    {
        $sectionsConfig = [
            'general' => ['logo', 'phone', 'email', 'site_description'],
            'location' => ['address', 'map_url'],
            'social' => ['facebook_url', 'instagram_url', 'twitter_url'],
        ];

        if (!isset($sectionsConfig[$section])) {
            abort(404);
        }

        $allowedKeys = $sectionsConfig[$section];

        // Valider les champs
        $rules = [];
        foreach ($allowedKeys as $key) {
            if ($key === 'logo') {
                $rules['logo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'];
            } else {
                $rules[$key] = ['nullable', 'string'];
            }
        }

        $validated = $request->validate($rules);

        // Traiter chaque champ
        foreach ($allowedKeys as $key) {
            if ($key === 'logo' && $request->hasFile('logo')) {
                // Traiter l'image
                $existing = SiteInfo::where('key', 'logo')->first();
                
                // Supprimer l'ancienne image
                if ($existing && $existing->value && str_starts_with($existing->value, '/storage/site-infos/')) {
                    $oldPath = str_replace('/storage/', '', $existing->value);
                    Storage::disk('public')->delete($oldPath);
                }

                $value = ImageService::resizeAndStore(
                    $request->file('logo'),
                    'site-infos',
                    800,
                    800
                );

                SiteInfo::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => $value, 'type' => 'image']
                );
            } elseif ($key !== 'logo' && isset($validated[$key])) {
                // Déterminer le type
                $type = 'text';
                if (in_array($key, ['site_description', 'address', 'map_url'])) {
                    $type = 'textarea';
                } elseif (str_ends_with($key, '_url')) {
                    $type = 'url';
                } elseif ($key === 'email') {
                    $type = 'email';
                }

                SiteInfo::updateOrCreate(
                    ['key' => $key],
                    ['value' => $validated[$key] ?? '', 'type' => $type]
                );
            }
        }

        return redirect()
            ->route('admin.site-infos.edit-section', $section)
            ->with('success', 'Section mise à jour avec succès.');
    }

    /**
     * Initialiser les valeurs par défaut
     */
    public function initializeDefaults()
    {
        $defaults = [
            ['key' => 'logo', 'type' => 'image', 'value' => ''],
            ['key' => 'phone', 'type' => 'text', 'value' => '+228 XX XX XX XX'],
            ['key' => 'email', 'type' => 'email', 'value' => 'contact@dutyfree.tg'],
            ['key' => 'site_description', 'type' => 'textarea', 'value' => 'Votre boutique duty free au Togo'],
            ['key' => 'address', 'type' => 'textarea', 'value' => 'Boulevard du 13 Janvier, Lomé, Togo'],
            ['key' => 'map_url', 'type' => 'textarea', 'value' => ''],
            ['key' => 'facebook_url', 'type' => 'url', 'value' => ''],
            ['key' => 'instagram_url', 'type' => 'url', 'value' => ''],
            ['key' => 'twitter_url', 'type' => 'url', 'value' => ''],
        ];

        foreach ($defaults as $default) {
            SiteInfo::firstOrCreate(
                ['key' => $default['key']],
                ['type' => $default['type'], 'value' => $default['value']]
            );
        }

        return redirect()
            ->route('admin.site-infos.index')
            ->with('success', 'Valeurs par défaut initialisées avec succès.');
    }
}