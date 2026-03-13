@extends('layouts.app')

@section('title', $product->name . ' — Archipel Tech')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #0a0f1e;
        --accent: #00d4ff;
        --accent2: #ff6b2b;
        --surface: #111827;
        --surface2: #1e2a3a;
        --text: #e2e8f0;
        --text-muted: #94a3b8;
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--primary);
        color: var(--text);
    }

    .product-detail-section {
        padding: 120px 0 80px;
    }

    .image-gallery {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        padding: 20px;
    }

    #main-image {
        width: 100%;
        height: 450px;
        object-fit: contain;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5));
        transition: transform 0.3s ease;
    }

    .thumb-item {
        width: 80px;
        height: 80px;
        border: 2px solid transparent;
        border-radius: 10px;
        cursor: pointer;
        object-fit: contain;
        background: var(--surface2);
        padding: 5px;
        transition: all 0.2s ease;
    }

    .thumb-item.active {
        border-color: var(--accent);
        box-shadow: 0 0 15px rgba(0, 212, 255, 0.3);
    }

    .product-info h1 {
        font-weight: 700;
        font-size: 2.5rem;
        color: #fff;
        margin-bottom: 10px;
    }

    .product-category {
        font-family: 'Space Mono', monospace;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.85rem;
    }

    .product-price {
        font-family: 'Space Mono', monospace;
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        margin: 20px 0;
    }

    .product-description {
        color: var(--text-muted);
        line-height: 1.8;
        font-size: 1.05rem;
        margin-bottom: 30px;
    }

    .btn-add-cart {
        background: var(--accent) !important;
        border: none !important;
        color: var(--primary) !important;
        font-family: 'Space Mono', monospace !important;
        font-weight: 700 !important;
        padding: 15px 40px !important;
        border-radius: 12px !important;
        font-size: 1rem !important;
        transition: all 0.3s ease !important;
    }

    .btn-add-cart:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 212, 255, 0.4);
    }

    .stock-status {
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .stock-status.in-stock { color: #10b981; }
    .stock-status.low-stock { color: #f59e0b; }
    .stock-status.out-of-stock { color: #ef4444; }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255,255,255,0.1);
        background: var(--surface2);
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    #qty-input {
        width: 60px;
        text-align: center;
        background: transparent;
        border: none;
        color: #fff;
        font-family: 'Space Mono', monospace;
        font-size: 1.2rem;
    }
</style>

<div class="product-detail-section">
    <div class="container">
        <div class="row g-5">
            <!-- Galerie Images -->
            <div class="col-lg-6">
                <div class="image-gallery">
                    <div class="main-image-container mb-4 text-center">
                        <img id="main-image" src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <img class="thumb-item active" 
                             src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" 
                             onclick="changeImage(this.src, this)">
                        
                        @foreach($product->images as $image)
                            <img class="thumb-item" 
                                 src="{{ Str::startsWith($image->image_path, 'http') ? $image->image_path : asset($image->image_path) }}" 
                                 onclick="changeImage(this.src, this)">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Infos Produit -->
            <div class="col-lg-6">
                <div class="product-info">
                    <div class="product-category mb-2">{{ $product->category->name }}</div>
                    <h1>{{ $product->name }}</h1>
                    
                    <div class="stock-status {{ $product->stock > 10 ? 'in-stock' : ($product->stock > 0 ? 'low-stock' : 'out-of-stock') }}">
                        @if($product->stock > 0)
                            ● En stock ({{ $product->stock }} disponibles)
                        @else
                            ● En rupture de stock
                        @endif
                    </div>

                    <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} F CFA</div>
                    
                    <div class="product-description">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    @if($product->stock > 0)
                        <div class="quantity-control">
                            <button class="qty-btn" onclick="updateQty(-1)">-</button>
                            <input type="text" id="qty-input" value="1" readonly>
                            <button class="qty-btn" onclick="updateQty(1)">+</button>
                        </div>

                        <button class="btn btn-add-cart w-100" onclick="handleAddToCart()">
                            Ajouter au panier — {{ number_format($product->price, 0, ',', ' ') }} F CFA
                        </button>
                    @endif

                    <div class="mt-5 p-4 rounded-4" style="background: rgba(0,212,255,0.05); border: 1px solid rgba(0,212,255,0.1);">
                        <div class="d-flex gap-3 mb-3">
                            <div class="text-accent" style="color: var(--accent);">✔</div>
                            <div>Expédié depuis l'Europe</div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <div class="text-accent" style="color: var(--accent);">✔</div>
                            <div>Paiement à la réception (zéro avance)</div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="text-accent" style="color: var(--accent);">✔</div>
                            <div>Qualité certifiée & Testé avant envoi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <div class="row mt-5 pt-5">
            <div class="col-12 mb-4">
                <h2 class="h3 fw-bold">Produits similaires</h2>
            </div>
            @foreach($relatedProducts as $rel)
            <div class="col-6 col-md-3">
                <a href="{{ route('product.show', $rel->id) }}" class="product-item d-block p-3 rounded-4 text-decoration-none" style="background: var(--surface); border: 1px solid rgba(255,255,255,0.05);">
                    <img src="{{ Str::startsWith($rel->image_path, 'http') ? $rel->image_path : asset($rel->image_path) }}" class="img-fluid mb-3 rounded-3" style="height: 150px; width: 100%; object-fit: contain;">
                    <h3 class="h6 text-white mb-1">{{ Str::limit($rel->name, 25) }}</h3>
                    <strong style="color: var(--accent);">{{ number_format($rel->price, 0, ',', ' ') }} F CFA</strong>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
    function changeImage(src, thumb) {
        document.getElementById('main-image').src = src;
        document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }

    function updateQty(delta) {
        const input = document.getElementById('qty-input');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > {{ $product->stock }}) val = {{ $product->stock }};
        input.value = val;
    }

    function handleAddToCart() {
        const qty = parseInt(document.getElementById('qty-input').value);
        const product = {
            product_id: {{ $product->id }},
            name: "{{ $product->name }}",
            price: {{ $product->price }},
            image: "{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}",
            quantity: qty
        };

        const CART_KEY = 'df_cart';
        let cart = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
        const idx = cart.findIndex(i => i.product_id === product.product_id);
        
        if (idx >= 0) {
            cart[idx].quantity += product.quantity;
        } else {
            cart.push(product);
        }
        
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
        if (window.dfUpdateCartBadge) window.dfUpdateCartBadge();
        
        // Rediriger vers le panier
        window.location = '{{ route('cart') }}';
    }
</script>
@endsection
