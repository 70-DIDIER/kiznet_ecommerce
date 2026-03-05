@extends('admin.layouts.app')









@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Produits</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Créer un produit</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:80px;">Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th class="text-end" style="width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @php
                                    $src = $product->image_path ?: 'admin/assets/images/products/img-1.png';
                                    if (!filter_var($src, FILTER_VALIDATE_URL)) {
                                        $src = asset($src);
                                    }
                                @endphp
                                <img src="{{ $src }}" alt="{{ $product->name }}" style="height:48px;width:48px;object-fit:cover;border-radius:6px;">
                            </td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ optional($product->category)->name ?? '—' }}</td>
                            <td>{{ number_format($product->price, 2, ',', ' ') }} F</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Éditer</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Aucun produit trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @php($isPaginator = $products instanceof \Illuminate\Pagination\AbstractPaginator)
        @if ($isPaginator && $products->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $products->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
</div>
@endsection


 
