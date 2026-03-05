

@extends('admin.layouts.app')


@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Créer un nouveau produit</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">← Retour à la liste</a>
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

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Ex: Chanel N°5" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Décrivez le produit...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="price" class="form-label">Prix <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" id="price" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}" placeholder="0.00" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                <input type="number" min="0" id="stock" name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock') }}" placeholder="0" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="category_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
                                <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Choisissez une catégorie</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-2">
                            <span class="form-label d-block">Image du produit</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeUpload" value="upload" checked>
                                <label class="form-check-label" for="modeUpload">Téléverser un fichier</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="imageMode" id="modeExisting" value="existing">
                                <label class="form-check-label" for="modeExisting">Choisir une image existante</label>
                            </div>
                        </div>

                        <div id="uploadBlock" class="mb-3">
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Les images uploadées seront servies depuis /storage/products.</small>
                        </div>

                        <div id="existingBlock" class="mb-3" style="display:none;">
                            <label for="image_path" class="form-label">Choisissez une image</label>
                            <select id="image_path" name="image_path" class="form-select @error('image_path') is-invalid @enderror">
                                <option value="">— Aucune —</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    @php $filename = "admin/assets/images/products/img-{$i}.png"; @endphp
                                    <option value="{{ $filename }}" {{ old('image_path') === $filename ? 'selected' : '' }}>
                                        {{ $filename }}
                                    </option>
                                @endfor
                            </select>
                            @error('image_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Images sous public/admin/assets/images/products.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Annuler</a>
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
            preview.src = '{{ asset('admin/assets/images/products/img-1.png') }}';
        } else {
            fileInput.value = '';
            const val = selectPath.value;
            preview.src = val ? `{{ asset('') }}${val}` : '{{ asset('admin/assets/images/products/img-1.png') }}';
        }
    }

    function updatePreviewFromFile() {
        const file = fileInput.files && fileInput.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    }

    function updatePreviewFromSelect() {
        const val = selectPath.value;
        preview.src = val ? `{{ asset('') }}${val}` : '{{ asset('admin/assets/images/products/img-1.png') }}';
    }

    modeUpload.addEventListener('change', toggleMode);
    modeExisting.addEventListener('change', toggleMode);
    fileInput.addEventListener('change', updatePreviewFromFile);
    selectPath.addEventListener('change', updatePreviewFromSelect);
</script>
@endpush
@endsection