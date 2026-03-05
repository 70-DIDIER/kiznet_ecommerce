@extends('layouts.app')

@section('title', 'Cart - Furni')

@section('content')

    <style>
        .btn-explorer {
            background: #ADD8E6 !important;
            border: 2px solid #ADD8E6 !important;
            color: #003d7a !important;
            transition: all 0.3s ease;
            /* transition plus rapide et discrète */
        }

        /* Effet hover plus subtil */
        .btn-explorer:hover {
            background: #003d7a !important;
            /* fond sombre pour contraste */
            color: #fff !important;
            /* texte blanc */
            transform: scale(1.05);
            /* léger agrandissement */
            box-shadow: 0 4px 10px rgba(0, 61, 122, 0.3);
            /* ombre plus douce */
        }
    </style>

    <!-- Start Hero Section -->
    <div class="hero"
        style="background: url('{{ asset('assets/images/front-view-cyber-monday-composition.jpg') }}') no-repeat center center !important; 
    background-size: cover !important; 
    padding: 120px 0 !important;
    min-height: 550px !important;
    height: 550px !important;
    max-height: 550px !important;">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Panier</h1>
                    </div>
                </div>

                <div class="col-lg-7">
                    <!-- Vide pour l'instant -->
                </div>

            </div>
        </div>
    </div>

    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Produit</th>
                                    <th class="product-price">Prix</th>
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

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-explorer">Mettre à jour le panier</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-explorer" onclick="window.location='{{ route('shop') }}'">
                                Continuer vos achats
                            </button>

                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-black">Apply Coupon</button>
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            {{-- <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div> --}}
                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$230.00</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$230.00</strong>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                            <button class="btn btn-explorer" id="proceed-checkout">
                                Passer à la caisse
                            </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            try { return new Intl.NumberFormat(locale, { style: "currency", currency: code, maximumFractionDigits: 2 }).format(value); } catch { return `${value.toFixed(2)} ${code}`; }
        }

        function getSelectedCurrency() { return localStorage.getItem('currency') || detectCurrency(); }
        let TARGET_CURRENCY = getSelectedCurrency();
        const CART_KEY = 'df_cart';

        function getCart() { try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; } }
        function saveCart(items) { localStorage.setItem(CART_KEY, JSON.stringify(items)); }

        function updateQty(id, qty) {
            const cart = getCart();
            const idx = cart.findIndex(i => i.product_id === id);
            if (idx >= 0) {
                cart[idx].quantity = Math.max(1, qty);
                saveCart(cart);
            }
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
            if (!items.length) { body.innerHTML = '<tr><td colspan="6" class="text-center py-5">Votre panier est vide</td></tr>'; return; }
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
                    <td><a href="#" class="btn btn-black btn-sm remove-item" data-id="${i.product_id}">X</a></td>
                </tr>
            `).join('');

            body.querySelectorAll('.decrease').forEach(b => b.addEventListener('click', () => { const id = Number(b.dataset.id); const cart = getCart(); const it = cart.find(x => x.product_id === id); if (!it) return; updateQty(id, it.quantity - 1); renderCart(); }));
            body.querySelectorAll('.increase').forEach(b => b.addEventListener('click', () => { const id = Number(b.dataset.id); const cart = getCart(); const it = cart.find(x => x.product_id === id); if (!it) return; updateQty(id, it.quantity + 1); renderCart(); }));
            body.querySelectorAll('.quantity-amount').forEach(inp => inp.addEventListener('change', () => { const id = Number(inp.dataset.id); const qty = Math.max(1, Number(inp.value) || 1); updateQty(id, qty); renderCart(); }));
            body.querySelectorAll('.remove-item').forEach(a => a.addEventListener('click', (e) => { e.preventDefault(); removeItem(Number(a.dataset.id)); renderCart(); }));
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderCart();
            const proceed = document.getElementById('proceed-checkout');
            proceed.addEventListener('click', () => { const items = getCart(); if (!items.length) { alert('Votre panier est vide'); } else { window.location = '{{ route('checkout') }}'; } });
        });

        window.addEventListener('storage', (e) => { if (e.key === 'currency') { TARGET_CURRENCY = getSelectedCurrency(); renderCart(); } });
    </script>

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
    </style>

@endsection
