@extends('admin.layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Paramètres du site</h4>
        @if($allInfos->isEmpty())
            <a href="{{ route('admin.site-infos.initialize') }}" class="btn btn-primary">
                ✨ Initialiser les valeurs par défaut
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($sections as $sectionKey => $section)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <div class="d-flex align-items-center mb-3">
                            <div class="fs-1 me-3">{{ $section['icon'] }}</div>
                            <h5 class="mb-0">{{ $section['title'] }}</h5>
                        </div>

                        <ul class="list-unstyled mb-3 flex-grow-1">
                            @foreach($section['keys'] as $key)
                                @php
                                    $info = $allInfos->get($key);
                                    $labels = [
                                        'logo' => 'Logo',
                                        'phone' => 'Téléphone',
                                        'email' => 'Email',
                                        'site_description' => 'Description',
                                        'address' => 'Adresse',
                                        'map_url' => 'Carte Google Maps',
                                        'facebook_url' => 'Facebook',
                                        'instagram_url' => 'Instagram',
                                        'twitter_url' => 'Twitter/X',
                                    ];
                                @endphp
                                <li class="mb-2">
                                    <strong>{{ $labels[$key] ?? $key }}:</strong>
                                    @if($info)
                                        @if($info->type === 'image')
                                            @if($info->value)
                                                <div class="mt-1">
                                                    <img src="{{ asset($info->value) }}" 
                                                         alt="Logo" 
                                                         style="height:40px;max-width:100px;object-fit:contain;border:1px solid #ddd;padding:4px;border-radius:4px;">
                                                </div>
                                            @else
                                                <small class="text-muted d-block">Non défini</small>
                                            @endif
                                        @else
                                            <small class="text-muted d-block">
                                                {{ $info->value ? Str::limit($info->value, 50) : 'Non défini' }}
                                            </small>
                                        @endif
                                    @else
                                        <small class="text-muted d-block">Non défini</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        {{-- Bouton fixé en bas --}}
                        <div class="mt-auto pt-3">
                            <a href="{{ route('admin.site-infos.edit-section', $sectionKey) }}" 
                               class="btn btn-primary w-100">
                                <i class="fas fa-edit"></i> Modifier cette section
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Aperçu rapide --}}
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-eye"></i> Aperçu rapide</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fas fa-address-book text-primary"></i> Contact</h6>
                    <p class="mb-2">
                        <i class="fas fa-phone text-success"></i> 
                        <strong>Téléphone:</strong> {{ $allInfos->get('phone')?->value ?? 'Non défini' }}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-envelope text-danger"></i> 
                        <strong>Email:</strong> {{ $allInfos->get('email')?->value ?? 'Non défini' }}
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt text-warning"></i> 
                        <strong>Adresse:</strong> {{ Str::limit($allInfos->get('address')?->value ?? 'Non défini', 80) }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fas fa-share-alt text-primary"></i> Réseaux sociaux</h6>
                    @if($allInfos->get('facebook_url')?->value)
                        <p class="mb-2">
                            <a href="{{ $allInfos->get('facebook_url')->value }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-facebook text-primary"></i> Facebook
                            </a>
                        </p>
                    @endif
                    @if($allInfos->get('instagram_url')?->value)
                        <p class="mb-2">
                            <a href="{{ $allInfos->get('instagram_url')->value }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-instagram text-danger"></i> Instagram
                            </a>
                        </p>
                    @endif
                    @if($allInfos->get('twitter_url')?->value)
                        <p class="mb-0">
                            <a href="{{ $allInfos->get('twitter_url')->value }}" target="_blank" class="text-decoration-none">
                                <i class="fab fa-twitter text-info"></i> Twitter/X
                            </a>
                        </p>
                    @endif
                    @if(!$allInfos->get('facebook_url')?->value && !$allInfos->get('instagram_url')?->value && !$allInfos->get('twitter_url')?->value)
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle"></i> Aucun réseau social configuré
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Assurer que les cartes ont la même hauteur et le bouton est en bas */
.card.h-100 {
    display: flex;
    flex-direction: column;
}

.card-body.d-flex.flex-column {
    flex: 1;
}

.flex-grow-1 {
    flex-grow: 1;
}

.mt-auto {
    margin-top: auto;
}
</style>
@endsection