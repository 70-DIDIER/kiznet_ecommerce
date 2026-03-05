@extends('layouts.app')

@section('title', 'Validation de commande — KIZNETservice')

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

    .hero .intro-excerpt h1 .brand {
        color: var(--accent);
        font-family: 'Space Mono', monospace;
    }

    .hero-breadcrumb {
        font-family: 'Space Mono', monospace;
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        margin-bottom: 14px;
    }

    .hero-breadcrumb span { color: var(--accent); }

    /* Hero steps indicator */
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
       SECTION PRINCIPALE
    ============================================ */
    .untree_co-section {
        background: var(--primary);
        padding: 70px 0;
    }

    /* Titres de section */
    .untree_co-section .h3 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff !important;
        margin-bottom: 20px;
    }

    /* ============================================
       CARTE FORMULAIRE
    ============================================ */
    .form-card {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 32px 28px;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
    }

    /* Champs */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label,
    .form-group .text-black {
        font-family: 'Space Mono', monospace !important;
        font-size: 0.7rem !important;
        letter-spacing: 0.07em;
        color: var(--text-muted) !important;
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
    }

    .form-group .form-control {
        background: var(--surface2) !important;
        border: 1px solid rgba(0, 212, 255, 0.12) !important;
        color: var(--text) !important;
        border-radius: 8px;
        padding: 10px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-group .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.5;
    }

    .form-group .form-control:focus {
        outline: none;
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1) !important;
        background: var(--surface2) !important;
        color: var(--text) !important;
    }

    /* Autocomplete liste pays */
    #country-results {
        background: var(--surface2);
        border: 1px solid rgba(0,212,255,0.2);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }

    #country-results .list-group-item {
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        color: var(--text);
        font-size: 0.88rem;
        padding: 10px 14px;
        transition: background 0.15s;
    }

    #country-results .list-group-item:hover {
        background: rgba(0,212,255,0.08);
        color: var(--accent);
    }

    /* Checkbox livraison domicile */
    .livraison-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--surface2);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        padding: 14px 16px;
        cursor: pointer;
        transition: border-color 0.2s;
        margin-top: 4px;
    }

    .livraison-toggle:hover {
        border-color: rgba(0,212,255,0.2);
    }

    .livraison-toggle input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
        cursor: pointer;
    }

    .livraison-toggle span {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    /* Bloc livraison étendu */
    #bloc_livraison {
        background: var(--surface2) !important;
        border: 1px solid rgba(0,212,255,0.15) !important;
        border-radius: 10px;
        padding: 20px !important;
        margin-top: 12px;
    }

    #bloc_livraison h5 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--accent) !important;
        margin-bottom: 16px;
    }

    /* ============================================
       RÉCAP COMMANDE
    ============================================ */
    .order-card {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 32px 28px;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent2), var(--accent));
    }

    /* Table commande */
    .site-block-order-table {
        width: 100%;
        border-collapse: collapse;
    }

    .site-block-order-table thead th {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding: 0 0 12px;
        font-weight: 400;
    }

    .site-block-order-table tbody tr td {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        font-size: 0.88rem;
        color: var(--text-muted);
    }

    .site-block-order-table tbody tr:last-child td {
        border-bottom: none;
        color: #fff !important;
        font-weight: 600;
        font-size: 0.95rem;
        padding-top: 16px;
    }

    .site-block-order-table tbody tr:last-child td:last-child {
        color: var(--accent) !important;
        font-family: 'Space Mono', monospace;
    }

    /* Note paiement à la livraison */
    .paiement-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: rgba(0,212,255,0.06);
        border: 1px solid rgba(0,212,255,0.15);
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 20px;
    }

    .paiement-note .note-icon {
        color: var(--accent);
        font-size: 1rem;
        margin-top: 2px;
    }

    .paiement-note p {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin: 0;
        line-height: 1.5;
    }

    .paiement-note p strong {
        color: var(--accent);
    }

    /* Bouton valider */
    .btn-explorer {
        background: transparent !important;
        border: 2px solid var(--accent) !important;
        color: var(--accent) !important;
        font-family: 'Space Mono', monospace !important;
        font-size: 0.82rem !important;
        letter-spacing: 0.05em;
        padding: 12px 28px !important;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-explorer:hover {
        background: var(--accent) !important;
        color: var(--primary) !important;
        box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
    }

    .btn-explorer:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<!-- Start Hero Section -->
<div class="hero"
    style="background: url('{{ asset('assets/images/showing-cart-trolley-shopping-online-sign-graphic.jpg') }}') no-repeat center center !important;
    background-size: cover !important;
    padding: 120px 0 !important;
    min-height: 400px !important;
    height: 400px !important;
    max-height: 400px !important;">

    <div class="hero-grid"></div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    <div class="hero-breadcrumb">Accueil / Panier / <span>Validation</span></div>
                    <h1>Valider ma commande</h1>
                    <div class="checkout-steps">
                        <span class="step">Panier</span>
                        <span class="sep">›</span>
                        <span class="step active">Informations</span>
                        <span class="sep">›</span>
                        <span class="step">Confirmation</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-end">
                <div style="font-family: 'Space Mono', monospace; font-size: 0.72rem; color: var(--text-muted); letter-spacing: 0.06em; line-height: 2.2; text-align: right;">
                    <div>✔ &nbsp;Aucun paiement en ligne</div>
                    <div>✔ &nbsp;Vous payez à la livraison</div>
                    <div>✔ &nbsp;Expédition depuis l'Europe</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">
        <div class="row">

            <!-- Gauche : Détails de facturation -->
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3">Informations de livraison</h2>
                <div class="form-card">

                    <div class="form-group">
                        <label for="c_country_search">Pays <span style="color: var(--accent2);">*</span></label>
                        <div class="position-relative">
                            <input type="text" id="c_country_search" class="form-control"
                                placeholder="Rechercher un pays...">
                            <select id="c_country" class="form-control mt-2" style="display:none">
                                <option value="">Sélectionnez un pays</option>
                            </select>
                            <div id="country-results" class="list-group position-absolute w-100"
                                style="max-height: 240px; overflow: auto; z-index: 1050; display: none;"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_fname">Prénom <span style="color: var(--accent2);">*</span></label>
                            <input type="text" class="form-control" id="c_fname" placeholder="Jean">
                        </div>
                        <div class="col-md-6">
                            <label for="c_lname">Nom <span style="color: var(--accent2);">*</span></label>
                            <input type="text" class="form-control" id="c_lname" placeholder="Dupont">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address">Adresse <span style="color: var(--accent2);">*</span></label>
                            <input type="text" class="form-control" id="c_address" placeholder="Rue, numéro...">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-6">
                            <label for="c_email_address">Adresse e-mail</label>
                            <input type="email" class="form-control" id="c_email_address" placeholder="vous@exemple.com">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone">Téléphone <span style="color: var(--accent2);">*</span></label>
                            <input type="text" class="form-control" id="c_phone" placeholder="+228 ...">
                        </div>
                    </div>

                    <!-- Toggle livraison domicile -->
                    <div class="form-group mt-3">
                        <label class="livraison-toggle">
                            <input type="checkbox" id="livraison_domicile">
                            <span>Souhaitez-vous une livraison à domicile ?</span>
                        </label>
                    </div>

                    <!-- Bloc livraison étendu -->
                    <div id="bloc_livraison" style="display: none;">
                        <h5>Précisez votre adresse de livraison</h5>

                        <div class="form-group">
                            <label for="adresse_livraison">Ville</label>
                            <input type="text" class="form-control" id="adresse_livraison" placeholder="Ex : Lomé">
                        </div>

                        <div class="form-group">
                            <label for="ville_livraison">Quartier</label>
                            <input type="text" class="form-control" id="ville_livraison" placeholder="Ex : Adidogomé">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Droite : Récap commande -->
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3">Récapitulatif</h2>
                        <div class="order-card">

                            <!-- Note paiement -->
                            <div class="paiement-note">
                                <span class="note-icon">ℹ</span>
                                <p><strong>Paiement à la livraison uniquement.</strong> Aucun paiement en ligne n'est requis — vous réglez à la réception de votre colis expédié depuis l'Europe.</p>
                            </div>

                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <tr>
                                        <th>Produit(s)</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="order-body"></tbody>
                            </table>

                            <button class="btn btn-explorer" id="place-order">
                                Confirmer la commande →
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===== SCRIPTS DYNAMIQUES INCHANGÉS ===== --}}
<script>
    const EU_COUNTRIES = ["AT", "BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "DE", "GR", "HU", "IE", "IT",
        "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE"
    ];
    const XOF_COUNTRIES = ["BJ", "BF", "CI", "GW", "ML", "NE", "SN", "TG"];
    const XAF_COUNTRIES = ["CM", "CF", "CG", "GA", "GQ", "TD"];

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
            return new Intl.NumberFormat(locale, {
                style: "currency",
                currency: code,
                maximumFractionDigits: 2
            }).format(value);
        } catch {
            return `${value.toFixed(2)} ${code}`;
        }
    }

    function getSelectedCurrency() {
        return localStorage.getItem('currency') || detectCurrency();
    }
    let TARGET_CURRENCY = getSelectedCurrency();
    const CART_KEY = 'df_cart';

    function getCart() {
        try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; }
    }

    function clearCart() {
        localStorage.removeItem(CART_KEY);
    }

    function renderOrderSummary() {
        const body = document.getElementById('order-body');
        const items = getCart();
        if (!items.length) {
            body.innerHTML = '<tr><td colspan="2" class="text-center py-5">Votre panier est vide</td></tr>';
            return;
        }
        let totalXOF = 0;
        body.innerHTML = items.map(i => {
            const lineXOF = i.price * i.quantity;
            totalXOF += lineXOF;
            const lineFormatted = formatCurrency(convertFromXOF(lineXOF, TARGET_CURRENCY), TARGET_CURRENCY);
            return `<tr><td>${i.name} × ${i.quantity}</td><td>${lineFormatted}</td></tr>`;
        }).join('') +
        `<tr><td class="text-black font-weight-bold">Montant total de la commande</td><td class="text-black font-weight-bold">${formatCurrency(convertFromXOF(totalXOF, TARGET_CURRENCY), TARGET_CURRENCY)}</td></tr>`;
    }

    function validateFields() {
        const fname = document.getElementById('c_fname').value.trim();
        const lname = document.getElementById('c_lname').value.trim();
        const phone = document.getElementById('c_phone').value.trim();
        const address = document.getElementById('c_address').value.trim();
        if (!fname || !lname || !phone || !address) return false;
        return true;
    }

    async function placeOrder() {
        const btn = document.getElementById('place-order');
        if (btn && btn.disabled) return;
        let originalText = btn ? btn.textContent : '';
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Validation en cours...';
            btn.setAttribute('aria-busy', 'true');
        }
        const items = getCart();
        if (!items.length) {
            alert('Votre panier est vide');
            return;
        }
        if (!validateFields()) {
            alert('Veuillez remplir les champs requis');
            if (btn) { btn.disabled = false; btn.textContent = originalText; btn.removeAttribute('aria-busy'); }
            return;
        }

        const fname = document.getElementById('c_fname').value.trim();
        const lname = document.getElementById('c_lname').value.trim();
        const phone = document.getElementById('c_phone').value.trim();
        const email = document.getElementById('c_email_address').value.trim();
        const address = document.getElementById('c_address').value.trim();
        const livraison = document.getElementById('livraison_domicile').checked;
        const ville = document.getElementById('adresse_livraison').value.trim();
        const quartier = document.getElementById('ville_livraison').value.trim();

        const payload = {
            customer_name: `${fname} ${lname}`.trim(),
            customer_phone: phone,
            customer_email: email || null,
            customer_address: address,
            notes: livraison ? `Ville: ${ville}; Quartier: ${quartier}` : '',
            items: items.map(i => ({
                product_id: i.product_id,
                quantity: i.quantity
            }))
        };

        try {
            const res = await fetch('/api/v1/orders', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            if (!json.success) {
                alert(json.message || 'Erreur de validation');
                if (btn) { btn.disabled = false; btn.textContent = originalText; btn.removeAttribute('aria-busy'); }
                return;
            }
            clearCart();
            alert('Commande enregistrée avec succès');
            window.location = '{{ route('shop') }}';
        } catch (e) {
            alert('Erreur lors de l\'enregistrement de la commande');
            if (btn) { btn.disabled = false; btn.textContent = originalText; btn.removeAttribute('aria-busy'); }
        }
    }

    document.getElementById('livraison_domicile').addEventListener('change', function() {
        document.getElementById('bloc_livraison').style.display = this.checked ? 'block' : 'none';
    });

    document.addEventListener('DOMContentLoaded', () => {
        renderOrderSummary();
        document.getElementById('place-order').addEventListener('click', placeOrder);
        const sel = document.getElementById('c_country');
        const search = document.getElementById('c_country_search');
        const results = document.getElementById('country-results');
        const locale = (navigator.languages && navigator.languages[0]) || navigator.language || 'fr-FR';
        const region = (locale.split('-')[1] || '').toUpperCase();
        try {
            if (Intl.DisplayNames && Intl.supportedValuesOf) {
                const dn = new Intl.DisplayNames([locale], { type: 'region' });
                const codes = Intl.supportedValuesOf('region').filter(c => /^[A-Z]{2}$/.test(c));
                const arr = codes.map(c => ({ code: c, name: dn.of(c) })).filter(x => x.name);
                arr.sort((a, b) => a.name.localeCompare(b.name));
                const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x => `<option value="${x.code}">${x.name}</option>`));
                sel.innerHTML = opts.join('');
                COUNTRY_LIST = arr;
                if (codes.includes(region)) sel.value = region;
                const selected = COUNTRY_LIST.find(x => x.code === sel.value);
                if (selected) search.value = selected.name;
                else search.value = '';
            } else {
                throw new Error('intl unsupported');
            }
        } catch (e) {
            fetch('https://unpkg.com/world-countries/countries.json', { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    const arr = Array.isArray(data) ? data.map(c => {
                        const code = c.cca2 || '';
                        const name = (c.translations && c.translations.fra && c.translations.fra.common) || (c.name && c.name.common) || '';
                        return { code, name };
                    }).filter(x => /^[A-Z]{2}$/.test(x.code) && x.name) : [];
                    arr.sort((a, b) => a.name.localeCompare(b.name));
                    const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x => `<option value="${x.code}">${x.name}</option>`));
                    sel.innerHTML = opts.join('');
                    COUNTRY_LIST = arr;
                    const codes = arr.map(x => x.code);
                    if (codes.includes(region)) sel.value = region;
                    const selected = COUNTRY_LIST.find(x => x.code === sel.value);
                    if (selected) search.value = selected.name;
                    else search.value = '';
                })
                .catch(() => {
                    const arr = [{"code":"FR","name":"France"},{"code":"US","name":"États-Unis"},{"code":"GB","name":"Royaume-Uni"},{"code":"DE","name":"Allemagne"},{"code":"IT","name":"Italie"},{"code":"ES","name":"Espagne"},{"code":"CA","name":"Canada"},{"code":"CN","name":"Chine"},{"code":"JP","name":"Japon"},{"code":"BR","name":"Brésil"},{"code":"IN","name":"Inde"},{"code":"NG","name":"Nigéria"},{"code":"ZA","name":"Afrique du Sud"},{"code":"RU","name":"Russie"},{"code":"AU","name":"Australie"},{"code":"SE","name":"Suède"},{"code":"NL","name":"Pays-Bas"},{"code":"BE","name":"Belgique"},{"code":"CH","name":"Suisse"},{"code":"AT","name":"Autriche"},{"code":"CI","name":"Côte d'Ivoire"},{"code":"SN","name":"Sénégal"},{"code":"CM","name":"Cameroun"},{"code":"TD","name":"Tchad"},{"code":"TG","name":"Togo"},{"code":"ML","name":"Mali"},{"code":"BF","name":"Burkina Faso"},{"code":"BJ","name":"Bénin"},{"code":"NE","name":"Niger"},{"code":"GW","name":"Guinée-Bissau"},{"code":"GA","name":"Gabon"},{"code":"GQ","name":"Guinée équatoriale"},{"code":"CF","name":"République centrafricaine"},{"code":"CG","name":"Congo"}];
                    const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x => `<option value="${x.code}">${x.name}</option>`));
                    sel.innerHTML = opts.join('');
                    COUNTRY_LIST = arr;
                    const codes = arr.map(x => x.code);
                    if (codes.includes(region)) sel.value = region;
                    const selected = COUNTRY_LIST.find(x => x.code === sel.value);
                    if (selected) search.value = selected.name;
                    else search.value = '';
                });
        }

        function renderCountryResults(q) {
            const term = (q || '').toLowerCase();
            const data = COUNTRY_LIST.filter(x => x.name.toLowerCase().includes(term)).slice(0, 50);
            if (!data.length) { results.style.display = 'none'; results.innerHTML = ''; return; }
            results.innerHTML = data.map(x =>
                `<a href="#" class="list-group-item list-group-item-action" data-code="${x.code}">${x.name}</a>`
            ).join('');
            results.style.display = 'block';
        }

        search.addEventListener('input', () => { renderCountryResults(search.value); });
        search.addEventListener('focus', () => { renderCountryResults(search.value); });
        search.addEventListener('blur', () => { setTimeout(() => { results.style.display = 'none'; }, 150); });
        results.addEventListener('click', (e) => {
            const target = e.target.closest('.list-group-item');
            if (!target) return;
            e.preventDefault();
            const code = target.getAttribute('data-code');
            const item = COUNTRY_LIST.find(x => x.code === code);
            if (item) { sel.value = item.code; search.value = item.name; }
            results.style.display = 'none';
        });
    });

    window.addEventListener('storage', (e) => {
        if (e.key === 'currency') {
            TARGET_CURRENCY = getSelectedCurrency();
            renderOrderSummary();
        }
    });
</script>

@endsection