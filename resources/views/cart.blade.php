@extends('layouts.app')

@section('title', 'Panier — KIZNETservice')

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

    .hero,
    .product-section,
    .footer-section {
        font-family: 'DM Sans', sans-serif;
    }

    /* ============================================
       HERO
    ============================================ */
    .hero {
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,15,30,0.95) 0%, rgba(10,15,30,0.75) 55%, rgba(0,212,255,0.05) 100%);
        z-index: 1;
    }

    .hero-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0,212,255,0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,212,255,0.04) 1px, transparent 1px);
        background-size: 60px 60px;
        mask-image: radial-gradient(ellipse at 30% 50%, black 20%, transparent 75%);
        pointer-events: none;
        z-index: 2;
    }

    .hero .container {
        position: relative;
        z-index: 3;
    }

    .hero .intro-excerpt h1 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: clamp(2.2rem, 4vw, 3.2rem);
        color: #ffffff;
        margin-bottom: 10px;
    }

    .hero-breadcrumb {
        font-family: 'Space Mono', monospace;
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        margin-bottom: 14px;
    }

    .hero-breadcrumb span { color: var(--accent); }

    /* Étapes */
    .checkout-steps {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
    }

    .checkout-steps .step {
        padding: 4px 12px;
        border-radius: 100px;
        background: rgba(255,255,255,0.06);
        color: var(--text-muted);
        border: 1px solid rgba(255,255,255,0.08);
    }

    .checkout-steps .step.active {
        background: rgba(0,212,255,0.12);
        color: var(--accent);
        border-color: rgba(0,212,255,0.3);
    }

    .checkout-steps .sep {
        color: var(--text-muted);
        font-size: 0.6rem;
    }

    /* ============================================
       SECTION PANIER
    ============================================ */
    .untree_co-section {
        background: var(--primary);
        padding: 70px 0;
    }

    /* Table panier */
    .site-blocks-table {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .site-blocks-table::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
    }

    .site-blocks-table .table {
        margin: 0;
        border-collapse: collapse;
    }

    .site-blocks-table .table thead tr th {
        font-family: 'Space Mono', monospace;
        font-size: 0.68rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        background: var(--surface2);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding: 16px 20px;
        font-weight: 400;
        border-top: none;
    }

    .site-blocks-table .table tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.04);
        transition: background 0.2s;
    }

    .site-blocks-table .table tbody tr:hover {
        background: rgba(0,212,255,0.03);
    }

    .site-blocks-table .table tbody tr:last-child {
        border-bottom: none;
    }

    .site-blocks-table .table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        color: var(--text-muted);
        font-size: 0.9rem;
        border-top: none;
    }

    .site-blocks-table .table tbody td .h5 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--text) !important;
        margin: 0;
    }

    /* Image produit */
    .site-blocks-table .table tbody td img {
        border-radius: 8px;
        filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4));
        background: transparent;
    }

    /* Contrôles quantité */
    .quantity-container {
        background: var(--surface2);
        border: 1px solid rgba(0,212,255,0.15);
        border-radius: 8px;
        overflow: hidden;
        display: flex !important;
        align-items: center;
        max-width: 130px !important;
        margin: 0 !important;
    }

    .quantity-container .btn-outline-black {
        background: transparent;
        border: none;
        color: var(--accent);
        padding: 6px 12px;
        font-size: 1rem;
        line-height: 1;
        cursor: pointer;
        transition: background 0.2s;
        font-family: 'Space Mono', monospace;
    }

    .quantity-container .btn-outline-black:hover {
        background: rgba(0,212,255,0.1);
    }

    .quantity-container .quantity-amount {
        background: transparent !important;
        border: none !important;
        color: var(--text) !important;
        text-align: center;
        font-family: 'Space Mono', monospace;
        font-size: 0.88rem;
        width: 40px;
        padding: 6px 0;
        box-shadow: none !important;
    }

    .quantity-container .input-group-prepend,
    .quantity-container .input-group-append {
        margin: 0;
    }

    /* Bouton supprimer */
    .btn-black.remove-item {
        background: rgba(255,107,43,0.1) !important;
        border: 1px solid rgba(255,107,43,0.25) !important;
        color: var(--accent2) !important;
        border-radius: 6px;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        padding: 5px 10px;
        transition: all 0.2s;
    }

    .btn-black.remove-item:hover {
        background: var(--accent2) !important;
        color: #fff !important;
        border-color: var(--accent2) !important;
    }

    /* Total colonne */
    .site-blocks-table .table tbody td:nth-child(5) {
        font-family: 'Space Mono', monospace;
        font-size: 0.9rem;
        color: var(--accent);
        font-weight: 700;
    }

    /* Prix unitaire */
    .site-blocks-table .table tbody td:nth-child(3) {
        font-family: 'Space Mono', monospace;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    /* Panier vide */
    #cart-body td.text-center {
        color: var(--text-muted);
        font-family: 'Space Mono', monospace;
        font-size: 0.82rem;
        padding: 60px 20px;
    }

    /* ============================================
       BOUTONS D'ACTION
    ============================================ */
    .btn-explorer {
        background: transparent !important;
        border: 2px solid var(--accent) !important;
        color: var(--accent) !important;
        font-family: 'Space Mono', monospace !important;
        font-size: 0.78rem !important;
        letter-spacing: 0.04em;
        padding: 10px 20px !important;
        border-radius: 8px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-explorer:hover {
        background: var(--accent) !important;
        color: var(--primary) !important;
        box-shadow: 0 0 18px rgba(0, 212, 255, 0.25);
        transform: translateY(-1px);
    }

    /* Bouton "Passer à la caisse" — mis en valeur */
    #proceed-checkout {
        background: var(--accent) !important;
        border: 2px solid var(--accent) !important;
        color: var(--primary) !important;
        font-family: 'Space Mono', monospace !important;
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.04em;
        padding: 12px 24px !important;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(0,212,255,0.2);
    }

    #proceed-checkout:hover {
        background: transparent !important;
        color: var(--accent) !important;
        box-shadow: 0 0 25px rgba(0,212,255,0.35);
    }

    /* Note livraison */
    .cart-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: rgba(0,212,255,0.05);
        border: 1px solid rgba(0,212,255,0.12);
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 16px;
    }

    .cart-note p {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin: 0;
        line-height: 1.5;
    }

    .cart-note p strong {
        color: var(--accent);
    }
</style>

<!-- Start Hero Section -->
<div class="hero"
    style="background: url('{{ asset('assets/images/front-view-cyber-monday-composition.jpg') }}') no-repeat center center !important;
    background-size: cover !important;
    padding: 120px 0 !important;
    min-height: 380px !important;
    height: 380px !important;
    max-height: 380px !important;">

    <div class="hero-grid"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    <div class="hero-breadcrumb">Accueil / <span>Panier</span></div>
                    <h1>Mon panier</h1>
                    <div class="checkout-steps">
                        <span class="step active">Panier</span>
                        <span class="sep">›</span>
                        <span class="step">Informations</span>
                        <span class="sep">›</span>
                        <span class="step">Confirmation</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                <div style="font-family: 'Space Mono', monospace; font-size: 0.72rem; color: var(--text-muted); letter-spacing: 0.06em; line-height: 2.2; text-align: right;">
                    <div>✔ &nbsp;Paiement à la livraison</div>
                    <div>✔ &nbsp;Zéro avance requise</div>
                    <div>✔ &nbsp;Expédié depuis l'Europe</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">

        <!-- Tableau panier -->
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Produit</th>
                                <th class="product-price">Prix unitaire</th>
                                <th class="product-quantity">Quantité</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body"></tbody>
                    </table>
                </div>
            </form>
        </div>

        <!-- Boutons et actions -->
        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-explorer">↺ Mettre à jour</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-explorer" onclick="window.location='{{ route('shop') }}'">
                            ← Continuer les achats
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-8">
                        <div class="cart-note">
                            <span style="color: var(--accent); font-size: 0.9rem;">ℹ</span>
                            <p><strong>Paiement à la livraison.</strong> Aucun règlement en ligne — vous payez à la réception de votre colis.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn" id="proceed-checkout">
                                    Passer à la caisse →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===== SCRIPTS DYNAMIQUES INCHANGÉS ===== --}}
<script>
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
        try { return new Intl.NumberFormat(locale, { style: "currency", currency: code, maximumFractionDigits: 2 }).format(value); }
        catch { return `${value.toFixed(2)} ${code}`; }
    }

    function getSelectedCurrency() { return localStorage.getItem('currency') || detectCurrency(); }
    let TARGET_CURRENCY = getSelectedCurrency();
    const CART_KEY = 'df_cart';

    function getCart() { try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; } }
    function saveCart(items) { localStorage.setItem(CART_KEY, JSON.stringify(items)); }

    function updateQty(id, qty) {
        const cart = getCart();
        const idx = cart.findIndex(i => i.product_id === id);
        if (idx >= 0) { cart[idx].quantity = Math.max(1, qty); saveCart(cart); }
    }

    function removeItem(id) {
        const cart = getCart().filter(i => i.product_id !== id);
        saveCart(cart);
    }

    function formatUnitPrice(price) { return formatCurrency(convertFromXOF(price, TARGET_CURRENCY), TARGET_CURRENCY); }
    function formatTotal(price, qty) { return formatCurrency(convertFromXOF(price * qty, TARGET_CURRENCY), TARGET_CURRENCY); }

    function renderCart() {
        const body = document.getElementById('cart-body');
        const items = getCart();
        if (!items.length) {
            body.innerHTML = '<tr><td colspan="6" class="text-center py-5">Votre panier est vide</td></tr>';
            return;
        }
        body.innerHTML = items.map(i => `
            <tr>
                <td class="product-thumbnail"><img src="${i.image}" alt="Image" class="img-fluid" style="max-width: 80px"></td>
                <td class="product-name"><h2 class="h5 text-black">${i.name}</h2></td>
                <td>${formatUnitPrice(i.price)}</td>
                <td>
                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 140px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-black decrease" data-id="${i.product_id}" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center quantity-amount" data-id="${i.product_id}" value="${i.quantity}" aria-label="quantity">
                        <div class="input-group-append">
                            <button class="btn btn-outline-black increase" data-id="${i.product_id}" type="button">&plus;</button>
                        </div>
                    </div>
                </td>
                <td>${formatTotal(i.price, i.quantity)}</td>
                <td><a href="#" class="btn btn-black btn-sm remove-item" data-id="${i.product_id}">✕</a></td>
            </tr>
        `).join('');

        body.querySelectorAll('.decrease').forEach(b => b.addEventListener('click', () => {
            const id = Number(b.dataset.id); const cart = getCart(); const it = cart.find(x => x.product_id === id);
            if (!it) return; updateQty(id, it.quantity - 1); renderCart();
        }));
        body.querySelectorAll('.increase').forEach(b => b.addEventListener('click', () => {
            const id = Number(b.dataset.id); const cart = getCart(); const it = cart.find(x => x.product_id === id);
            if (!it) return; updateQty(id, it.quantity + 1); renderCart();
        }));
        body.querySelectorAll('.quantity-amount').forEach(inp => inp.addEventListener('change', () => {
            const id = Number(inp.dataset.id); const qty = Math.max(1, Number(inp.value) || 1);
            updateQty(id, qty); renderCart();
        }));
        body.querySelectorAll('.remove-item').forEach(a => a.addEventListener('click', (e) => {
            e.preventDefault(); removeItem(Number(a.dataset.id)); renderCart();
        }));
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderCart();
        const proceed = document.getElementById('proceed-checkout');
        proceed.addEventListener('click', () => {
            const items = getCart();
            if (!items.length) { alert('Votre panier est vide'); }
            else { window.location = '{{ route('checkout') }}'; }
        });
    });

    window.addEventListener('storage', (e) => {
        if (e.key === 'currency') { TARGET_CURRENCY = getSelectedCurrency(); renderCart(); }
    });
</script>

@endsection