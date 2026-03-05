@extends('admin.layouts.app')

@section('content')
    <div class="container py-4 mt-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Modifier un témoignage</h4>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">← Retour</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Éditer : {{ $testimonial->name }}</h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nom --}}
                    <div class="mb-3">
                        <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $testimonial->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Position --}}
                    <div class="mb-3">
                        <label class="form-label">Position / Titre</label>
                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                            value="{{ old('position', $testimonial->position) }}">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Témoignage --}}
                    <div class="mb-3">
                        <label class="form-label">Témoignage <span class="text-danger">*</span></label>
                        <textarea name="text" rows="5" class="form-control @error('text') is-invalid @enderror" required>{{ old('text', $testimonial->text) }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Étoiles --}}
                    <div class="mb-3">
                        <label class="form-label">Nombre d'étoiles <span class="text-danger">*</span></label>
                        <select name="stars" class="form-select @error('stars') is-invalid @enderror" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('stars', $testimonial->stars) == $i ? 'selected' : '' }}>
                                    {{ $i }} étoile{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('stars')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label class="form-label">Photo de profil <span class="text-danger">*</span></label>

                        {{-- Image actuelle --}}
                        <div class="mb-3">
                            <p class="text-muted small mb-2">Image actuelle :</p>
                            @php
                                $currentImage = $testimonial->image ?: 'admin/assets/images/users/default-avatar.png';
                                if (!filter_var($currentImage, FILTER_VALIDATE_URL)) {
                                    $currentImage = asset($currentImage);
                                }
                            @endphp
                            <img src="{{ $currentImage }}" alt="Image actuelle"
                                style="height: 70px; width: 70px; object-fit: cover; border-radius:50%;">
                        </div>

                        {{-- Choix du mode --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeKeep"
                                    value="keep" checked>
                                <label class="form-check-label" for="modeKeep">
                                    Garder l'image actuelle
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeUpload"
                                    value="upload">
                                <label class="form-check-label" for="modeUpload">
                                    Télécharger une nouvelle image
                                </label>
                            </div>
                            {{-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeExisting"
                                    value="existing">
                                <label class="form-check-label" for="modeExisting">
                                    Choisir une image existante
                                </label>
                            </div> --}}
                        </div>

                        {{-- Upload nouvelle image --}}
                        <div id="uploadSection" style="display: none;" class="mb-3">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg,image/webp">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sélectionner image existante --}}
                        <div id="existingSection" style="display: none;" class="mb-3">
                            <input type="text" name="image_path"
                                class="form-control @error('image_path') is-invalid @enderror"
                                placeholder="Exemple : /images/team/photo.jpg">
                            <small class="text-muted">Entrez le chemin de l'image existante</small>
                            @error('image_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('imageMode')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Script pour afficher/masquer les sections --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const uploadRadio = document.getElementById('modeUpload');
                            const existingRadio = document.getElementById('modeExisting');
                            const keepRadio = document.getElementById('modeKeep');
                            const uploadSection = document.getElementById('uploadSection');
                            const existingSection = document.getElementById('existingSection');

                            function updateSections() {
                                uploadSection.style.display = uploadRadio.checked ? 'block' : 'none';
                                existingSection.style.display = existingRadio.checked ? 'block' : 'none';
                            }

                            uploadRadio.addEventListener('change', updateSections);
                            existingRadio.addEventListener('change', updateSections);
                            keepRadio.addEventListener('change', updateSections);
                        });
                    </script>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
