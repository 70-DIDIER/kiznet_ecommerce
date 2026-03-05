@extends('admin.layouts.app')

@section('content')
<div class="container py-4 mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Modifier un produit</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">← Retour</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Éditer : {{ $product->name }}</h5>
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

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nom --}}
                <div class="mb-3">
                    <label class="form-label">Nom du produit <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $product->name) }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Catégorie --}}
                <div class="mb-3">
                    <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Sélectionnez --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prix --}}
                <div class="mb-3">
                    <label class="form-label">Prix (F CFA) <span class="text-danger">*</span></label>
                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price', $product->price) }}"
                        required
                    >
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input
                        type="number"
                        name="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', $product->stock) }}"
                    >
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label class="form-label">Image du produit</label>
                    <div class="mb-2">
                        <img src="{{ $product->image_path ? asset($product->image_path) : asset('admin/assets/images/products/img-1.png') }}"
                             alt="Image actuelle"
                             style="height: 70px; width: 70px; object-fit: cover; border-radius:6px;">
                    </div>
                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
