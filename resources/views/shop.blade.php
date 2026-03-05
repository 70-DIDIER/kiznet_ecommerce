@extends('layouts.app')

@section('title', 'Page Boutique')

@section('content')

<style>
    /* Définir la police de tout le site */
        body {
            font-family: 'Poppins', sans-serif;
            /* ou une autre police */
        }

        /* Si tu veux juste une section précise */
        .hero,
        .product-section,
        .footer-section {
            font-family: 'Poppins', sans-serif;
        }

    .shop-hero-offset { padding-top: 160px; }
    @media (max-width: 991px) { .shop-hero-offset { padding-top: 120px; } }
    .product-thumbnail { width: 100%; height: 260px; object-fit: contain; object-position: center top; background-color: #ffffff; }
    @media (min-width: 1200px) { .product-thumbnail { height: 300px; } }
</style>
 <div class="hero"
        style="background: url('{{ asset('assets/images/pexels-mikhail-nilov-6969962.jpg') }}') no-repeat center center !important; 
        background-size: cover !important; 
        padding: 120px 0 !important;
        min-height: 550px !important;
        height: 550px !important;
        max-height: 550px !important;">
        <div class="container">
            <div class="row justify-content-between align-items-start">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Boutique</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Start Hero Section -->

    <div class="container shop-hero-offset">
        <div class="row justify-content-between align-items-center">
           
            <div class="col-lg-12 text-center text-lg-start">
                <div class="row g-3 mt-3 mt-lg-0 justify-content-between align-items-center">
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="search-input" placeholder="Rechercher un produit...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="category-select">
                            <option value="">Toutes les catégories</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="currency-select">
                            <option value="XOF">FCFA (XOF)</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <button class="btn btn-primary w-100" id="reset-filters">Réinitialiser</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End Hero Section -->



<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row" id="product-list">
            <!-- L'espace reservé à l'affichage des produits-->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('product-list');
    const searchInput = document.getElementById('search-input');
    const categorySelect = document.getElementById('category-select');
    const currencySelect = document.getElementById('currency-select');
    const resetBtn = document.getElementById('reset-filters');

    const params = new URLSearchParams(window.location.search);
    const categoryId = params.get('category_id');
    const initialQuery = params.get('input') || '';

    if (initialQuery) {
        searchInput.value = initialQuery;
    }

    loadCategories(categoryId);
    loadProducts(categoryId, initialQuery);

    let debounceTimer;
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const q = searchInput.value.trim();
            const cat = categorySelect.value || '';
            updateQueryParams(q, cat);
            loadProducts(cat || null, q);
        }, 300);
    });

    categorySelect.addEventListener('change', () => {
        const q = searchInput.value.trim();
        const cat = categorySelect.value || '';
        updateQueryParams(q, cat);
        loadProducts(cat || null, q);
    });

    resetBtn.addEventListener('click', () => {
        searchInput.value = '';
        categorySelect.value = '';
        TARGET_CURRENCY = 'XOF';
        localStorage.setItem('currency', TARGET_CURRENCY);
        currencySelect.value = TARGET_CURRENCY;
        updateQueryParams('', '');
        loadProducts(null, '');
    });
    currencySelect.addEventListener('change', () => {
        TARGET_CURRENCY = currencySelect.value;
        localStorage.setItem('currency', TARGET_CURRENCY);
        loadProducts(categorySelect.value || null, searchInput.value.trim());
    });

    window.addEventListener('storage', (e) => {
        if (e.key === 'currency') {
            TARGET_CURRENCY = localStorage.getItem('currency') || TARGET_CURRENCY;
            currencySelect.value = TARGET_CURRENCY;
            loadProducts(categorySelect.value || null, searchInput.value.trim());
        }
    });

    async function loadProducts(categoryId, query) {
        const useSearch = (query && query.length > 0) || (categoryId && categoryId.length > 0);
        const url = useSearch
            ? `/api/v1/search${buildQuery({ input: query || '', category_id: categoryId || '' })}`
            : `/api/v1/products`;

        container.innerHTML = '<div class="col-12 text-center py-5">Chargement des produits...</div>';

        try {
            const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();

            if (!json.success) {
                throw new Error(json.message || 'Erreur lors de la récupération des produits.');
            }

            let products = json.data || [];

            products = products.filter(p => Number(p.stock) > 0);

            if (!products.length) {
                container.innerHTML = '<div class="col-12 text-center py-5">Aucun produit trouvé pour cette catégorie.</div>';
                return;
            }

            container.innerHTML = products.map(p => renderProductCard(p)).join('');

            attachAddToCart();
        } catch (e) {
            container.innerHTML = `<div class="col-12 text-center text-danger py-5">Erreur: ${e.message}</div>`;
        }
    }

    async function loadCategories(selectedId) {
        try {
            const res = await fetch('/api/v1/categories', { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            if (!json.success) return;
            const cats = json.data || [];
            const options = ['<option value="">Toutes les catégories</option>']
                .concat(cats.map(c => `<option value="${c.id}">${escapeHtml(c.name || '')}</option>`));
            categorySelect.innerHTML = options.join('');
            if (selectedId) {
                categorySelect.value = String(selectedId);
            }
        } catch {}
    }

    function buildQuery(obj) {
        const params = new URLSearchParams();
        Object.entries(obj).forEach(([k, v]) => {
            if (v) params.append(k, v);
        });
        const qs = params.toString();
        return qs ? `?${qs}` : '';
    }

    function updateQueryParams(input, categoryId) {
        const params = new URLSearchParams();
        if (input) params.set('input', input);
        if (categoryId) params.set('category_id', categoryId);
        const qs = params.toString();
        const newUrl = `${window.location.pathname}${qs ? `?${qs}` : ''}`;
        window.history.replaceState({}, '', newUrl);
    }

    const EU_COUNTRIES = ["AT","BE","BG","HR","CY","CZ","DK","EE","FI","FR","DE","GR","HU","IE","IT","LV","LT","LU","MT","NL","PL","PT","RO","SK","SI","ES","SE"];
    const XOF_COUNTRIES = ["BJ","BF","CI","GW","ML","NE","SN","TG"];
    const XAF_COUNTRIES = ["CM","CF","CG","GA","GQ","TD"];

    function detectCurrency() {
        const loc = (navigator.languages && navigator.languages[0]) || navigator.language || "";
        const region = (loc.split("-")[1] || "").toUpperCase();
        if (EU_COUNTRIES.includes(region)) return "EUR";
        if (region === "US") return "USD";
        if (XOF_COUNTRIES.includes(region) || XAF_COUNTRIES.includes(region)) return "XOF";
        return "XOF";
    }

    function convertFromXOF(value, target) {
        const amount = Number(value) || 0;
        if (target === "EUR") return amount / 655.957;
        if (target === "USD") return amount / 610;
        return amount;
    }

    function formatCurrency(value, code) {
        const locale = (navigator.languages && navigator.languages[0]) || navigator.language || "fr-FR";
        try {
            return new Intl.NumberFormat(locale, { style: "currency", currency: code, maximumFractionDigits: 2 }).format(value);
        } catch {
            return `${value.toFixed(2)} ${code}`;
        }
    }

    let TARGET_CURRENCY = (localStorage.getItem('currency') || detectCurrency());
    currencySelect.value = TARGET_CURRENCY;

    function formatProductPrice(value) {
        const converted = convertFromXOF(value, TARGET_CURRENCY);
        return formatCurrency(converted, TARGET_CURRENCY);
    }

    const CART_KEY = 'df_cart';

    function getCart() {
        try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; }
    }

    function saveCart(items) {
        localStorage.setItem(CART_KEY, JSON.stringify(items));
    }

    function addToCart(product) {
        const cart = getCart();
        const idx = cart.findIndex(i => i.product_id === product.product_id);
        if (idx >= 0) {
            cart[idx].quantity += product.quantity;
        } else {
            cart.push(product);
        }
        saveCart(cart);
        if (window.dfUpdateCartBadge) window.dfUpdateCartBadge();
    }

    function attachAddToCart() {
        document.querySelectorAll('.product-item').forEach(el => {
            el.addEventListener('click', (ev) => {
                ev.preventDefault();
                const d = el.dataset;
                addToCart({
                    product_id: Number(d.id),
                    name: d.name || '',
                    price: Number(d.price) || 0,
                    image: d.image || '',
                    quantity: 1
                });
                window.location = '{{ route('cart') }}';
            });
        });
    }

    function renderProductCard(p) {
        // Fallback image si non défini
        const defaultImage = '{{ asset('assets/images/product-3.png') }}';
        const imgSrc = (p.image_path && typeof p.image_path === 'string') ? p.image_path : defaultImage;

        return `
            <div class="col-12 col-md-4 col-lg-3 mb-5">
                <a class="product-item" href="{{ route('cart') }}" data-id="${p.id}" data-name="${escapeHtml(p.name || '')}" data-price="${p.price}" data-image="${imgSrc}">
                    <img src="${imgSrc}" class="img-fluid product-thumbnail" alt="${escapeHtml(p.name || 'Produit')}">
                    <h3 class="product-title">${escapeHtml(p.name || '')}</h3>
                    <strong class="product-price">${formatProductPrice(p.price)}</strong>
                    <span class="icon-cross">
                        <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid" alt="Add to cart">
                    </span>
                </a>
            </div>
        `;
    }

    function formatPrice(value) {
        const num = Number(value);
        return isNaN(num) ? '0.00' : num.toFixed(2);
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
});
</script>

@endpush
