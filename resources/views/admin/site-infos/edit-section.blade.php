@extends('admin.layouts.app')

@section('content')
    <div class="container py-4 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">{{ $config['title'] }}</h4>
            <a href="{{ route('admin.site-infos.index') }}" class="btn btn-outline-secondary">← Retour</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.site-infos.update-section', $section) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @foreach ($config['fields'] as $key => $field)
                        <div class="mb-4">
                            <label class="form-label fw-bold">{{ $field['label'] }}</label>

                            @if ($field['type'] === 'image')
                                {{-- Image --}}
                                @if (isset($siteInfos[$key]) && $siteInfos[$key])
                                    <div class="mb-2">
                                        <img src="{{ asset($siteInfos[$key]) }}" alt="{{ $field['label'] }}"
                                            style="max-height:150px;max-width:300px;object-fit:contain;border:1px solid #ddd;padding:8px;border-radius:4px;">
                                    </div>
                                @endif
                                <input type="file" name="{{ $key }}"
                                    class="form-control @error($key) is-invalid @enderror" accept="image/*">
                                <small class="text-muted">
                                    {{ isset($siteInfos[$key]) && $siteInfos[$key] ? 'Laissez vide pour conserver l\'image actuelle' : 'Formats acceptés : JPG, PNG, SVG, WebP' }}
                                </small>
                            @elseif($field['type'] === 'textarea')
                                {{-- Textarea --}}
                                <textarea name="{{ $key }}" rows="4" class="form-control @error($key) is-invalid @enderror"
                                    placeholder="{{ $field['placeholder'] ?? '' }}">{{ old($key, $siteInfos[$key] ?? '') }}</textarea>

                                @if ($key === 'map_url')
                                    <small class="text-muted">
                                        💡 <strong>Comment obtenir l'URL de la carte :</strong><br>
                                        1. Allez sur <a href="https://www.google.com/maps" target="_blank">Google
                                            Maps</a><br>
                                        2. Recherchez votre adresse<br>
                                        3. Cliquez sur "Partager" → "Intégrer une carte"<br>
                                        4. Copiez l'URL qui se trouve dans <code>src="..."</code>
                                    </small>

                                    @if (isset($siteInfos[$key]) && $siteInfos[$key])
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#mapPreviewModal">
                                                🗺️ Voir l'aperçu de la carte
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            @else
                                {{-- Input normal (text, email, url) --}}
                                <input type="{{ $field['type'] }}" name="{{ $key }}"
                                    class="form-control @error($key) is-invalid @enderror"
                                    value="{{ old($key, $siteInfos[$key] ?? '') }}"
                                    placeholder="{{ $field['placeholder'] ?? '' }}">
                            @endif

                            @error($key)
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.site-infos.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal pour prévisualiser la carte Google Maps --}}
    @if ($section === 'location' && isset($siteInfos['map_url']) && $siteInfos['map_url'])
        <div class="modal fade" id="mapPreviewModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">🗺️ Aperçu de la carte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div style="position: relative; width: 100%; height: 450px;">
                            <iframe src="{{ $siteInfos['map_url'] }}" width="100%" height="100%" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
