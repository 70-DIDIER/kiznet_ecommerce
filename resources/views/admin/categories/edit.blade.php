@extends('admin.layouts.app')

@section('content')
    <div class="container py-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Modifier la catégorie</h5>
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

                        <form method="POST" action="{{ route('admin.categories.update', $category) }}" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Nom de la catégorie <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Entrez le nom de la catégorie"
                                    value="{{ old('name', $category->name) }}"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Entrez une description"
                                >{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
                        ← Retour à la liste des catégories
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
