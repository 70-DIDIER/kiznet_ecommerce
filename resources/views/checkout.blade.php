@extends('layouts.app')

@section('title', 'Checkout - Furni')

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
        style="background: url('{{ asset('assets/images/showing-cart-trolley-shopping-online-sign-graphic.jpg') }}') no-repeat center center !important; 
    background-size: cover !important; 
    padding: 120px 0 !important;
    min-height: 550px !important;
    height: 550px !important;
    max-height: 550px !important;">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Validation</h1>
                    </div>
                </div>

                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>

    <!-- End Hero Section -->


    <div class="untree_co-section">
        <div class="container">

            {{-- <div class="row mb-5">
            <div class="col-md-12">
                <div class="border p-4 rounded" role="alert">
                    Returning customer? <a href="#">Click here</a> to login
                </div>
            </div>
        </div> --}}

            <div class="row">

                <!-- Left : Billing Details -->
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Détails de facture</h2>
                    <div class="p-3 p-lg-5 border bg-white">

                        <div class="form-group">
                            <label for="c_country_search" class="text-black">Pays <span class="text-danger">*</span></label>
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
                                <label class="text-black" for="c_fname">Prénom </label>
                                <input type="text" class="form-control" id="c_fname">
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="c_lname">Nom </label>
                                <input type="text" class="form-control" id="c_lname">
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                        <div class="col-md-12">
                            <label class="text-black" for="c_companyname">Company Name</label>
                            <input type="text" class="form-control" id="c_companyname">
                        </div>
                    </div> --}}

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="text-black" for="c_address">Addresse </label>
                                <input type="text" class="form-control" id="c_address" placeholder="">
                            </div>
                        </div>

                        {{-- <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div> --}}

                        {{-- <div class="form-group row">
                        <div class="col-md-6">
                            <label class="text-black" for="c_state_country">State / Country *</label>
                            <input type="text" class="form-control" id="c_state_country">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="c_postal_zip">Postal / Zip *</label>
                            <input type="text" class="form-control" id="c_postal_zip">
                        </div>
                    </div> --}}

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label class="text-black" for="c_email_address">Adresse e-mail </label>
                                <input type="email" class="form-control" id="c_email_address">
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="c_phone">Téléphone </label>
                                <input type="text" class="form-control" id="c_phone">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="text-black d-flex align-items-center">
                                <input type="checkbox" id="livraison_domicile" class="mr-2"
                                    style="transform: scale(1.6); margin-right: 10px;">
                                Se faire livrer à domicile ?
                            </label>
                        </div>



                        <!-- Section qui apparaît si on coche -->
                        <div id="bloc_livraison" class="p-3 border bg-light mt-3" style="display: none;">
                            <h5 class="text-black mb-3">Informations de livraison</h5>

                            <div class="form-group">
                                <label class="text-black" for="adresse_livraison">Ville</label>
                                <input type="text" class="form-control" id="adresse_livraison" placeholder="">
                            </div>

                            <div class="form-group">
                                <label class="text-black" for="ville_livraison">Quartier</label>
                                <input type="text" class="form-control" id="ville_livraison">
                            </div>

                            {{-- <div class="form-group">
                                <label class="text-black" for="code_postal">Code postal</label>
                                <input type="text" class="form-control" id="code_postal">
                            </div> --}}
                        </div>


                    </div>
                </div>

                <!-- Right : Order Summary -->
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Votre commande</h2>
                            <div class="p-3 p-lg-5 border bg-white">

                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Produit(s)</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody id="order-body"></tbody>
                                </table>

                                <button class="btn btn-explorer" id="place-order">
                                    Valider la commande
                                </button>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

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
            try {
                return JSON.parse(localStorage.getItem(CART_KEY) || '[]');
            } catch {
                return [];
            }
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
                btn.textContent = 'Validation...';
                btn.setAttribute('aria-busy', 'true');
            }
            const items = getCart();
            if (!items.length) {
                alert('Votre panier est vide');
                return;
            }
            if (!validateFields()) {
                alert('Veuillez remplir les champs requis');
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
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                const json = await res.json();
                if (!json.success) {
                    alert(json.message || 'Erreur de validation');
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = originalText;
                        btn.removeAttribute('aria-busy');
                    }
                    return;
                }
                clearCart();
                alert('Commande enregistrée avec succès');
                window.location = '{{ route('shop') }}';
            } catch (e) {
                alert('Erreur lors de l\'enregistrement de la commande');
                if (btn) {
                    btn.disabled = false;
                    btn.textContent = originalText;
                    btn.removeAttribute('aria-busy');
                }
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
                    const dn = new Intl.DisplayNames([locale], {
                        type: 'region'
                    });
                    const codes = Intl.supportedValuesOf('region').filter(c => /^[A-Z]{2}$/.test(c));
                    const arr = codes.map(c => ({
                        code: c,
                        name: dn.of(c)
                    })).filter(x => x.name);
                    arr.sort((a, b) => a.name.localeCompare(b.name));
                    const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x =>
                        `<option value="${x.code}">${x.name}</option>`));
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
                fetch('https://unpkg.com/world-countries/countries.json', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        const arr = Array.isArray(data) ? data.map(c => {
                            const code = c.cca2 || '';
                            const name = (c.translations && c.translations.fra && c.translations.fra
                                .common) || (c.name && c.name.common) || '';
                            return {
                                code,
                                name
                            };
                        }).filter(x => /^[A-Z]{2}$/.test(x.code) && x.name) : [];
                        arr.sort((a, b) => a.name.localeCompare(b.name));
                        const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x =>
                            `<option value="${x.code}">${x.name}</option>`));
                        sel.innerHTML = opts.join('');
                        COUNTRY_LIST = arr;
                        const codes = arr.map(x => x.code);
                        if (codes.includes(region)) sel.value = region;
                        const selected = COUNTRY_LIST.find(x => x.code === sel.value);
                        if (selected) search.value = selected.name;
                        else search.value = '';
                    })
                    .catch(() => {
                        const arr = [{
                            code: 'FR',
                            name: 'France'
                        }, {
                            code: 'US',
                            name: 'États-Unis'
                        }, {
                            code: 'GB',
                            name: 'Royaume-Uni'
                        }, {
                            code: 'DE',
                            name: 'Allemagne'
                        }, {
                            code: 'IT',
                            name: 'Italie'
                        }, {
                            code: 'ES',
                            name: 'Espagne'
                        }, {
                            code: 'CA',
                            name: 'Canada'
                        }, {
                            code: 'CN',
                            name: 'Chine'
                        }, {
                            code: 'JP',
                            name: 'Japon'
                        }, {
                            code: 'BR',
                            name: 'Brésil'
                        }, {
                            code: 'IN',
                            name: 'Inde'
                        }, {
                            code: 'NG',
                            name: 'Nigéria'
                        }, {
                            code: 'ZA',
                            name: 'Afrique du Sud'
                        }, {
                            code: 'RU',
                            name: 'Russie'
                        }, {
                            code: 'AU',
                            name: 'Australie'
                        }, {
                            code: 'SE',
                            name: 'Suède'
                        }, {
                            code: 'NL',
                            name: 'Pays-Bas'
                        }, {
                            code: 'BE',
                            name: 'Belgique'
                        }, {
                            code: 'CH',
                            name: 'Suisse'
                        }, {
                            code: 'AT',
                            name: 'Autriche'
                        }, {
                            code: 'CI',
                            name: 'Côte d’Ivoire'
                        }, {
                            code: 'SN',
                            name: 'Sénégal'
                        }, {
                            code: 'CM',
                            name: 'Cameroun'
                        }, {
                            code: 'TD',
                            name: 'Tchad'
                        }, {
                            code: 'TG',
                            name: 'Togo'
                        }, {
                            code: 'ML',
                            name: 'Mali'
                        }, {
                            code: 'BF',
                            name: 'Burkina Faso'
                        }, {
                            code: 'BJ',
                            name: 'Bénin'
                        }, {
                            code: 'NE',
                            name: 'Niger'
                        }, {
                            code: 'GW',
                            name: 'Guinée‑Bissau'
                        }, {
                            code: 'GA',
                            name: 'Gabon'
                        }, {
                            code: 'GQ',
                            name: 'Guinée équatoriale'
                        }, {
                            code: 'CF',
                            name: 'République centrafricaine'
                        }, {
                            code: 'CG',
                            name: 'Congo'
                        }];
                        const opts = ['<option value="">Sélectionnez un pays</option>'].concat(arr.map(x =>
                            `<option value="${x.code}">${x.name}</option>`));
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
                if (!data.length) {
                    results.style.display = 'none';
                    results.innerHTML = '';
                    return;
                }
                results.innerHTML = data.map(x =>
                    `<a href="#" class="list-group-item list-group-item-action" data-code="${x.code}">${x.name}</a>`
                ).join('');
                results.style.display = 'block';
            }

            search.addEventListener('input', () => {
                renderCountryResults(search.value);
            });
            search.addEventListener('focus', () => {
                renderCountryResults(search.value);
            });
            search.addEventListener('blur', () => {
                setTimeout(() => {
                    results.style.display = 'none';
                }, 150);
            });
            results.addEventListener('click', (e) => {
                const target = e.target.closest('.list-group-item');
                if (!target) return;
                e.preventDefault();
                const code = target.getAttribute('data-code');
                const item = COUNTRY_LIST.find(x => x.code === code);
                if (item) {
                    sel.value = item.code;
                    search.value = item.name;
                }
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

{{-- <script>
    
    document.getElementById("livraison_domicile").addEventListener("change", function () {
        document.getElementById("bloc_livraison").style.display = this.checked ? "block" : "none";
    });
</script> --}}
{{-- let COUNTRY_LIST = []; --}}
