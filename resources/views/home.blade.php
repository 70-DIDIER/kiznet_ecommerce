@extends('layouts.app')

@section('title', 'Archipel - DUTYFREE')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


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


        /* ============================================
                           BOUTON SCROLL TO TOP AVEC PROGRESSION
                           ============================================ */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #003d7a;
            border-radius: 50%;
            cursor: pointer;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 4px 20px rgba(0, 61, 122, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        .scroll-to-top:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(0, 61, 122, 0.5);
        }

        .scroll-to-top:active {
            transform: scale(0.95);
        }

        /* Icône flèche */
        .scroll-icon {
            position: absolute;
            color: #ffffff;
            font-size: 20px;
            z-index: 2;
            animation: bounceUp 2s infinite;
        }

        /* Cercle de progression SVG */
        .progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            transition: stroke-dashoffset 0.1s;
            stroke-linecap: round;
        }

        /* Animation de la flèche */
        @keyframes bounceUp {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        /* Responsive mobile */
        @media (max-width: 768px) {
            .scroll-to-top {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }

            .progress-ring {
                width: 50px;
                height: 50px;
            }

            .progress-ring-circle {
                r: 22;
                cx: 25;
                cy: 25;
            }

            .scroll-icon {
                font-size: 18px;
            }
        }

        /* Variante couleur alternative au scroll */
        .scroll-to-top.scrolled {
            background: #ff8c00;
        }

        .scroll-to-top.scrolled .scroll-icon {
            animation: bounceUp 1.5s infinite;
        }

        /* Fix dimensions for product images */
        .product-thumbnail {
            height: 250px;
            width: 100%;
            object-fit: contain;
        }
    </style>

    <!-- Start Hero Section -->
    <div class="hero"
        style="background: url('{{ asset('assets/images/pexels-tuurt-2954405.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>DutyFree Express <span class="d-block">Réservez avant votre vol</span></h1>
                        <p class="mb-4" style="font-size: 1.1rem; line-height: 1.1;">
                            {{ $siteInfos['site_description'] ?? 'Valeur par défaut' }}
                        </p>

                        <p>
                            <a href="{{ route('shop') }}" class="btn btn-secondary me-2"
                                style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1rem;">
                                Acheter maintenant
                            </a>
                        </p>

                    </div>
                </div>
                {{-- <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('assets/images/couch.png') }}" class="img-fluid" alt="Couch">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Des produits de marques prestigieuses.</h2>
                    <p class="mb-4">
                        Découvrez une sélection exclusive de parfums, alcools, chocolats et accessoires.
                        Qualité authentique, prix Duty Free et retrait rapide à l'aéroport.
                    </p>
                    <p><a href="{{ route('shop') }}" class="btn btn-explorer">Explorer</a></p>
                    <div class="mt-3">
                        <select class="form-select" id="currency-select-home">
                            <option value="XOF">FCFA (XOF)</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                </div>
                <!-- End Column 1 -->

                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="{{ route('cart') }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ asset($product->image_path) }}">
                            <img src="{{ asset($product->image_path) }}" class="img-fluid product-thumbnail"
                                alt="{{ $product->name }}">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <strong class="product-price">{{ $product->price }}F CFA</strong>
                            <span class="icon-cross">
                                <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid" alt="Cross">
                            </span>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Product Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            let TARGET_CURRENCY = localStorage.getItem('currency') || detectCurrency();
            const currencySelect = document.getElementById('currency-select-home');
            if (currencySelect) currencySelect.value = TARGET_CURRENCY;

            function formatProductPrice(value) {
                const converted = convertFromXOF(value, TARGET_CURRENCY);
                return formatCurrency(converted, TARGET_CURRENCY);
            }

            const CART_KEY = 'df_cart';
            function getCart() { try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; } }
            function saveCart(items) { localStorage.setItem(CART_KEY, JSON.stringify(items)); }
            function addToCart(product) {
                const cart = getCart();
                const idx = cart.findIndex(i => i.product_id === product.product_id);
                if (idx >= 0) { cart[idx].quantity += product.quantity; } else { cart.push(product); }
                saveCart(cart);
                if (window.dfUpdateCartBadge) window.dfUpdateCartBadge();
            }

            function attachAddToCart() {
                document.querySelectorAll('.product-item').forEach(el => {
                    el.addEventListener('click', (ev) => {
                        ev.preventDefault();
                        const d = el.dataset;
                        addToCart({ product_id: Number(d.id), name: d.name || '', price: Number(d.price) || 0, image: d.image || '', quantity: 1 });
                        window.location = '{{ route('cart') }}';
                    });
                });
            }

            function updateHomePrices() {
                document.querySelectorAll('.product-item').forEach(el => {
                    const p = Number(el.dataset.price) || 0;
                    const priceEl = el.querySelector('.product-price');
                    if (priceEl) priceEl.textContent = formatProductPrice(p);
                });
            }

            if (currencySelect) {
                currencySelect.addEventListener('change', () => {
                    TARGET_CURRENCY = currencySelect.value;
                    localStorage.setItem('currency', TARGET_CURRENCY);
                    updateHomePrices();
                });
            }

            window.addEventListener('storage', (e) => {
                if (e.key === 'currency') {
                    TARGET_CURRENCY = localStorage.getItem('currency') || TARGET_CURRENCY;
                    if (currencySelect) currencySelect.value = TARGET_CURRENCY;
                    updateHomePrices();
                }
            });

            updateHomePrices();
            attachAddToCart();
        });
    </script>

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Pourquoi nous choisir ?</h2>
                    <p>Précommandez vos produits Duty Free en ligne et récupérez-les directement à l'aéroport.
                        Simple, rapide et sécurisé – aucun paiement en ligne requis.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/truck.svg') }}" alt="Image" class="img-fluid">
                                </div>
                                <h3>Retrait rapide à l'aéroport</h3>
                                <p>Réservez vos produits en ligne et récupérez-les au comptoir sans attendre.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/bag.svg') }}" alt="Image" class="img-fluid">
                                </div>
                                <h3>Shopping simple & pratique</h3>
                                <p>Parcourez notre catalogue, ajoutez vos articles au panier et précommandez en quelques
                                    clics.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/support.svg') }}" alt="Image" class="img-fluid">
                                </div>
                                <h3>Assistance disponible</h3>
                                <p>Notre équipe est là pour répondre à vos questions sur les commandes et le retrait.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/return.svg') }}" alt="Image" class="img-fluid">
                                </div>
                                <h3>Flexibilité & tranquillité</h3>
                                <p>Vous pouvez modifier ou annuler vos commandes avant le retrait, facilement et rapidement.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('assets/images/pexels-magda-ehlers-pexels-2861656_1_cropped.png') }}"
                            alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1">
                            <img src="{{ asset('assets/images/bellboy-tipped-by-company-executives_cropped.jpg') }}"
                                alt="Untree.co" class="img-fluid">
                        </div>
                        <div class="grid grid-2">
                            <img src="{{ asset('assets/images/10945220_cropped.jpg') }}" alt="Untree.co" class="img-fluid">
                        </div>
                        <div class="grid grid-3">
                            <img src="{{ asset('assets/images/pexels-karola-g-5239881_cropped.jpg') }}" alt="Untree.co"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">Précommandez vos produits Duty Free facilement</h2>
                    <p>
                        Parcourez notre catalogue de parfums, alcools, chocolats et accessoires, sélectionnés pour
                        les voyageurs. Réservez vos articles en ligne et récupérez-les rapidement à l'aéroport,
                        sans paiement en ligne.
                    </p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Précommande simple et rapide en quelques clics</li>
                        <li>Retrait direct au comptoir à l'aéroport</li>
                        <li>Sélection des meilleures marques Duty Free</li>
                        <li>Flexibilité et modifications possibles avant le retrait</li>
                    </ul>
                    <p><a href="{{ route('shop') }}" class="btn btn-explorer">Explorer le catalogue</a></p>
                </div>

            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Ce que disent nos clients</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">
                            @forelse($testimonials as $testimonial)
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>&ldquo;{{ $testimonial->text }}&rdquo;</p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        @php
                                                            $imagePath =
                                                                $testimonial->image ?: 'assets/images/person-1.png';
                                                            // Si l'image commence par /storage/, c'est une URL complète
                                                            if (str_starts_with($imagePath, '/storage/')) {
                                                                $imageUrl = asset($imagePath);
                                                            } elseif (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                                // Si c'est déjà une URL complète
                                                                $imageUrl = $imagePath;
                                                            } else {
                                                                // Sinon, utiliser asset()
                                                                $imageUrl = asset($imagePath);
                                                            }
                                                        @endphp
                                                        <img src="{{ $imageUrl }}" alt="{{ $testimonial->name }}"
                                                            class="img-fluid"
                                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{ $testimonial->name }}</h3>
                                                    <span
                                                        class="position d-block mb-3">{{ $testimonial->position ?? 'Client' }}</span>

                                                    {{-- Affichage des étoiles --}}
                                                    <div class="stars mb-3">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $testimonial->stars)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END item -->
                            @empty
                                {{-- Message si aucun témoignage --}}
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <p class="text-muted">Aucun témoignage disponible pour le moment.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

    <!-- Bouton Scroll to Top avec indicateur de progression -->
    <div id="scrollToTop" class="scroll-to-top">
        <svg class="progress-ring" width="60" height="60">
            <circle class="progress-ring-circle" stroke="#ff8c00" stroke-width="3" fill="transparent" r="27"
                cx="30" cy="30" />
        </svg>
        <i class="fa fa-chevron-up scroll-icon"></i>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollBtn = document.getElementById('scrollToTop');
            const progressCircle = document.querySelector('.progress-ring-circle');

            // Calculer la circonférence du cercle
            const radius = progressCircle.r.baseVal.value;
            const circumference = 2 * Math.PI * radius;

            // Initialiser le stroke-dasharray
            progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
            progressCircle.style.strokeDashoffset = circumference;

            // Fonction pour mettre à jour la progression
            function updateProgress() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = scrollTop / docHeight;

                // Calculer l'offset du cercle
                const offset = circumference - (scrollPercent * circumference);
                progressCircle.style.strokeDashoffset = offset;

                // Afficher/masquer le bouton
                if (scrollTop > 300) {
                    scrollBtn.classList.add('show');
                } else {
                    scrollBtn.classList.remove('show');
                }

                // Changer la couleur après 50% du scroll
                if (scrollPercent > 0.5) {
                    scrollBtn.classList.add('scrolled');
                } else {
                    scrollBtn.classList.remove('scrolled');
                }
            }

            // Événement scroll
            window.addEventListener('scroll', updateProgress);

            // Clic sur le bouton - retour en haut smooth
            scrollBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Initialiser au chargement
            updateProgress();
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
