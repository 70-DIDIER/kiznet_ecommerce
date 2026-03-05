@extends('admin.layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Créer un nouveau témoignage</h4>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">← Retour à la liste</a>
    </div>

    <div class="card">
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

            <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Ex: Jean Dupont" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position / Titre</label>
                            <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror"
                                   value="{{ old('position') }}" placeholder="Ex: PDG de Tech Corp">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label">Témoignage <span class="text-danger">*</span></label>
                            <textarea id="text" name="text" rows="5"
                                      class="form-control @error('text') is-invalid @enderror"
                                      placeholder="Écrivez le témoignage..." required>{{ old('text') }}</textarea>
                            @error('text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="stars" class="form-label">Nombre d'étoiles <span class="text-danger">*</span></label>
                                <select id="stars" name="stars"
                                        class="form-select @error('stars') is-invalid @enderror" required>
                                    <option value="" disabled selected>Choisissez le nombre d'étoiles</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('stars') == $i ? 'selected' : '' }}>
                                            {{ $i }} étoile{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('stars')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-2">
                            <span class="form-label d-block">Photo de profil</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeUpload" value="upload" checked>
                                <label class="form-check-label" for="modeUpload">Téléverser un fichier</label>
                            </div>
                            {{-- <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeExisting" value="existing">
                                <label class="form-check-label" for="modeExisting">Choisir une image existante</label>
                            </div> --}}
                        </div>

                        <div id="uploadBlock" class="mb-3">
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Les images uploadées seront servies depuis /storage/testimonials.</small>
                        </div>

                        <div id="existingBlock" class="mb-3" style="display:none;">
                            <label for="image_path" class="form-label">Choisissez une image</label>
                            <select id="image_path" name="image_path" class="form-select @error('image_path') is-invalid @enderror">
                                <option value="">— Aucune —</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    @php $filename = "admin/assets/images/users/avatar-{$i}.jpg"; @endphp
                                    <option value="{{ $filename }}" {{ old('image_path') === $filename ? 'selected' : '' }}>
                                        {{ $filename }}
                                    </option>
                                @endfor
                            </select>
                            @error('image_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Images sous public/admin/assets/images/users.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>

                    
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const modeUpload = document.getElementById('modeUpload');
    const modeExisting = document.getElementById('modeExisting');
    const uploadBlock = document.getElementById('uploadBlock');
    const existingBlock = document.getElementById('existingBlock');
    const fileInput = document.getElementById('image');
    const selectPath = document.getElementById('image_path');
    const preview = document.getElementById('imagePreview');

    function toggleMode() {
        const isUpload = modeUpload.checked;
        uploadBlock.style.display = isUpload ? 'block' : 'none';
        existingBlock.style.display = isUpload ? 'none' : 'block';
        if (isUpload) {
            selectPath.value = '';
            if (preview) preview.src = '{{ asset('admin/assets/images/users/default-avatar.png') }}';
        } else {
            fileInput.value = '';
            const val = selectPath.value;
            if (preview) preview.src = val ? `{{ asset('') }}${val}` : '{{ asset('admin/assets/images/users/default-avatar.png') }}';
        }
    }

    function updatePreviewFromFile() {
        const file = fileInput.files && fileInput.files[0];
        if (!file || !preview) return;
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    }

    function updatePreviewFromSelect() {
        if (!preview) return;
        const val = selectPath.value;
        preview.src = val ? `{{ asset('') }}${val}` : '{{ asset('admin/assets/images/users/default-avatar.png') }}';
    }

    modeUpload.addEventListener('change', toggleMode);
    modeExisting.addEventListener('change', toggleMode);
    fileInput.addEventListener('change', updatePreviewFromFile);
    selectPath.addEventListener('change', updatePreviewFromSelect);
</script>
@endpush
@endsection