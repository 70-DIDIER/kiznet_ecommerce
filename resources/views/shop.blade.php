@extends('layouts.app')

@section('title', 'Catalogue — TechShop Europe')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #0d1117;
        --accent: #4F90F0;
        --accent2: #F97316;
        --surface: #161b27;
        --surface2: #1e2537;
        --text: #E5E7EB;
        --text-muted: #9CA3AF;
    }

    body {
        font-family: 'Inter', 'DM Sans', sans-serif;
        background: var(--primary);
        color: var(--text);
    }

    .hero,
    .product-section,
    .footer-section {
        font-family: 'DM Sans', sans-serif;
    }

    .shop-hero-offset { padding-top: 60px; }
    @media (max-width: 991px) { .shop-hero-offset { padding-top: 40px; } }

    /* ============================================
       HERO BOUTIQUE
    ============================================ */
    .hero {
        position: relative;
        overflow: hidden;
        background: var(--primary) !important;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 60% 40%, rgba(79, 144, 240, 0.06) 0%, transparent 60%);
        pointer-events: none;
        z-index: 1;
    }

    /* Grille décorative supprimée */
    .hero-grid {
        display: none;
    }

    .hero .container {
        position: relative;
        z-index: 2;
    }

    .hero .intro-excerpt h1 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        color: var(--text);
        margin: 0;
    }

    .hero .intro-excerpt h1 span.accent {
        color: var(--accent);
    }

    .hero-sub-p {
        color: var(--text-muted);
    }

    .hero-checklist {
        color: var(--text-muted);
    }

    .hero-breadcrumb {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 16px;
        font-weight: 500;
    }

    .hero-breadcrumb span {
        color: var(--accent);
    }

    /* ============================================
       BARRE DE FILTRES
    ============================================ */
    .filters-bar {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 40px;
    }

    .filters-bar .form-control,
    .filters-bar .form-select {
        background: var(--surface2);
        border: 1px solid rgba(0, 212, 255, 0.15);
        color: var(--text);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        padding: 10px 14px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .filters-bar .form-control::placeholder {
        color: var(--text-muted);
    }

    .filters-bar .form-control:focus,
    .filters-bar .form-select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        background: var(--surface2);
        color: var(--text);
    }

    .filters-bar .form-select option {
        background: var(--surface2);
        color: var(--text);
    }

    /* Bouton reset */
    #reset-filters {
        background: transparent;
        border: 1px solid rgba(255, 107, 43, 0.35);
        color: var(--accent2);
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 8px;
        padding: 10px 14px;
        transition: all 0.2s ease;
    }

    #reset-filters:hover {
        background: var(--accent2);
        color: var(--text);
        border-color: var(--accent2);
    }

    /* Label "Rechercher" discret */
    .filter-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
        display: block;
    }

    /* ============================================
       PRODUCT SECTION
    ============================================ */
    .untree_co-section.product-section {
        background: var(--primary);
        padding: 0 0 80px;
    }

    /* Chargement */
    #product-list .col-12.text-center {
        color: var(--text-muted);
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
    }

    /* Cards produits */
    .product-item {
        display: block;
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none !important;
        cursor: pointer;
    }

    .product-item::before {
        display: none;
    }

    .product-item:hover {
        border-color: rgba(79, 144, 240, 0.2);
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
    }

    .product-thumbnail {
        width: 100%;
        height: 220px;
        object-fit: contain;
        object-position: center;
        background: transparent;
        filter: drop-shadow(0 8px 16px rgba(0,0,0,0.5));
        transition: transform 0.3s ease;
    }

    @media (min-width: 1200px) {
        .product-thumbnail { height: 260px; }
    }

    .product-item:hover .product-thumbnail {
        transform: scale(1.04);
    }

    .product-title {
        font-family: 'DM Sans', sans-serif !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        color: var(--text) !important;
        margin-top: 14px !important;
        margin-bottom: 6px !important;
        line-height: 1.4 !important;
    }

    .product-price {
        font-size: 1rem !important;
        color: var(--accent) !important;
        font-weight: 700 !important;
        display: block !important;
        font-variant-numeric: tabular-nums;
    }

    .icon-cross {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 32px;
        height: 32px;
        background: rgba(0, 212, 255, 0.12);
        border: 1px solid rgba(0, 212, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: rotate(-45deg) scale(0.8);
        transition: all 0.3s ease;
    }

    .product-item:hover .icon-cross {
        opacity: 1;
        transform: rotate(0) scale(1);
    }

    .icon-cross img {
        width: 14px;
        filter: invert(1) sepia(1) saturate(5) hue-rotate(170deg);
    }

    /* Message vide / erreur */
    #product-list .text-danger {
        color: #f87171 !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
    }

    /* Badge stock */
    .product-item .stock-badge {
        position: absolute;
        bottom: 14px;
        right: 14px;
        font-family: 'Inter', sans-serif;
        font-size: 0.62rem;
        background: rgba(0, 212, 255, 0.08);
        color: var(--accent);
        border: 1px solid rgba(0, 212, 255, 0.2);
        border-radius: 4px;
        padding: 2px 7px;
        letter-spacing: 0.05em;
    }

    /* ============================================
       MOBILE
    ============================================ */
    @media (max-width: 768px) {
        .untree_co-section { padding: 40px 0 !important; }

        /* Barre de filtres : empiler les champs */
        .filters-bar .row > [class*="col-"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-bottom: 8px;
        }

        /* Titre hero shop */
        .hero .intro-excerpt h1 { font-size: clamp(1.5rem, 5vw, 2rem) !important; }

        /* Checklist droite masquée (déjà d-none d-lg-block) */
    }

    @media (max-width: 576px) {
        /* Titres produits compacts */
        .product-item .product-title { font-size: 0.78rem !important; }
        .product-item .product-price { font-size: 0.85rem !important; }
        .product-item .product-thumbnail { height: 130px !important; }
        .product-item { padding: 12px !important; }

        /* Badge stock : sortir du positionnement absolu pour éviter le chevauchement avec le prix */
        .product-item .stock-badge {
            position: static !important;
            display: inline-block;
            margin-top: 6px;
        }
    }

    /* ============================================
       LIGHT THEME OVERRIDES
    ============================================ */
    html[data-theme="light"] .hero {
        background: #F5F7FA !important;
        padding-top: 180px !important;
    }

    html[data-theme="light"] .hero::before {
        background: radial-gradient(ellipse at 60% 40%, rgba(37, 99, 235, 0.06) 0%, transparent 60%) !important;
    }

    html[data-theme="light"] .hero .intro-excerpt h1 {
        color: #0D1117 !important;
        text-shadow: none !important;
    }

    html[data-theme="light"] .hero .intro-excerpt h1 span.accent {
        color: #2563EB !important;
    }

    html[data-theme="light"] .hero-sub-p,
    html[data-theme="light"] .hero-checklist {
        color: #374151 !important;
        text-shadow: none !important;
    }

    html[data-theme="light"] .hero-breadcrumb {
        color: #6B7280 !important;
    }

    html[data-theme="light"] .hero-breadcrumb span {
        color: #2563EB !important;
    }
</style>

<!-- Hero Boutique -->
<div class="hero"
    style="padding: 155px 0 50px !important;
    min-height: 380px !important;">
    <div class="hero-grid"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    {{-- <div class="hero-breadcrumb">Accueil / <span>Catalogue</span></div> --}}
                    <h1><span class="accent">KIZNET</span>Shop — Catalogue</h1>
                    <p class="hero-sub-p" style="margin-top: 14px; font-size: 0.95rem; max-width: 460px; line-height: 1.7;">
                        Ordinateurs, composants &amp; électronique expédiés depuis l'Europe.
                        Payez uniquement à la livraison.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div class="hero-checklist" style="font-family: 'Inter', sans-serif; font-size: 0.72rem; letter-spacing: 0.06em; line-height: 2;">
                    <div>✔ &nbsp;Livraison depuis l'Europe</div>
                    <div>✔ &nbsp;Paiement à la réception</div>
                    <div>✔ &nbsp;Gros &amp; détail disponibles</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Barre de filtres -->
<div class="container shop-hero-offset">
    <div class="filters-bar">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="filter-label">Rechercher un produit</label>
                <input type="text" class="form-control" id="search-input" placeholder="Ex: laptop, GPU, RAM, SSD...">
            </div>
            <div class="col-md-3">
                <label class="filter-label">Catégorie</label>
                <select class="form-select" id="category-select">
                    <option value="">Toutes les catégories</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="filter-label">Devise</label>
                <select class="form-select" id="currency-select">
                    <option value="XOF">FCFA (XOF)</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn w-100" id="reset-filters">↺ Réinitialiser</button>
            </div>
        </div>
    </div>
</div>

<!-- Grille produits -->
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row" id="product-list">
            <!-- Produits chargés dynamiquement -->
        </div>
        
        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center" id="pagination-container">
                <!-- Pagination dynamique -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('product-list');
    const paginationContainer = document.getElementById('pagination-container');
    const searchInput = document.getElementById('search-input');
    const categorySelect = document.getElementById('category-select');
    const currencySelect = document.getElementById('currency-select');
    const resetBtn = document.getElementById('reset-filters');

    let currentPage = 1;

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
            currentPage = 1;
            const q = searchInput.value.trim();
            const cat = categorySelect.value || '';
            updateQueryParams(q, cat);
            loadProducts(cat || null, q);
        }, 300);
    });

    categorySelect.addEventListener('change', () => {
        currentPage = 1;
        const q = searchInput.value.trim();
        const cat = categorySelect.value || '';
        updateQueryParams(q, cat);
        loadProducts(cat || null, q);
    });

    resetBtn.addEventListener('click', () => {
        currentPage = 1;
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

    async function loadProducts(categoryId, query, page = 1) {
        const useSearch = (query && query.length > 0) || (categoryId && categoryId.length > 0);
        const baseUrl = useSearch ? `/api/v1/search` : `/api/v1/products`;
        const url = `${baseUrl}${buildQuery({ input: query || '', category_id: categoryId || '', page: page })}`;

        container.innerHTML = '<div class="col-12 text-center py-5">Chargement des produits...</div>';
        paginationContainer.innerHTML = '';

        try {
            const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();

            if (!json.success) {
                throw new Error(json.message || 'Erreur lors de la récupération des produits.');
            }

            let products = json.data || [];
            // products = products.filter(p => Number(p.stock) > 0); // L'API le fait déjà maintenant

            if (!products.length) {
                container.innerHTML = '<div class="col-12 text-center py-5">Aucun produit trouvé pour cette catégorie.</div>';
                return;
            }

            container.innerHTML = products.map(p => renderProductCard(p)).join('');
            renderPagination(json.meta);
        } catch (e) {
            container.innerHTML = `<div class="col-12 text-center text-danger py-5">Erreur: ${e.message}</div>`;
        }
    }

    function renderPagination(meta) {
        if (!meta || meta.last_page <= 1) return;

        let html = '<nav><ul class="pagination">';
        
        // Précédent
        html += `<li class="page-item ${meta.current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${meta.current_page - 1})">Précédent</a>
                </li>`;

        for (let i = 1; i <= meta.last_page; i++) {
            html += `<li class="page-item ${meta.current_page === i ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>`;
        }

        // Suivant
        html += `<li class="page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${meta.current_page + 1})">Suivant</a>
                </li>`;

        html += '</ul></nav>';
        paginationContainer.innerHTML = html;
    }

    window.changePage = (page) => {
        event.preventDefault();
        currentPage = page;
        loadProducts(categorySelect.value || null, searchInput.value.trim(), page);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

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

    function renderProductCard(p) {
        const defaultImage = '{{ asset('assets/images/product-3.png') }}';
        const imgSrc = (p.image_path && typeof p.image_path === 'string') ? 
            (p.image_path.startsWith('http') ? p.image_path : `/${p.image_path.replace(/^\//, '')}`) : 
            defaultImage;

        return `
            <div class="col-6 col-md-4 col-lg-3 mb-5">
                <a class="product-item" href="/product/${p.id}">
                    <img src="${imgSrc}" class="img-fluid product-thumbnail" alt="${escapeHtml(p.name || 'Produit')}">
                    <h3 class="product-title">${escapeHtml(p.name || '')}</h3>
                    <strong class="product-price">${formatProductPrice(p.price)}</strong>
                    <span class="icon-cross">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                    <span class="stock-badge">${p.stock > 0 ? 'EN STOCK' : 'RUPTURE'}</span>
                </a>
            </div>
        `;
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