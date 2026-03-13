@extends('layouts.app')

@section('title', 'Archipel - TechShop Europe')

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

        .btn-explorer {
            background: transparent !important;
            border: 2px solid var(--accent) !important;
            color: var(--accent) !important;
            font-family: 'Space Mono', monospace !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-explorer::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--accent);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: -1;
        }

        .btn-explorer:hover {
            color: var(--primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.4);
        }

        .btn-explorer:hover::before {
            transform: translateX(0);
        }

        /* ============================================
                           HERO SECTION
                           ============================================ */
        .hero {
            background: linear-gradient(135deg, #0a0f1e 0%, #0d1b35 40%, #0a1628 100%) !important;
            position: relative;
            overflow: hidden;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 70% 50%, rgba(0, 212, 255, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 80%, rgba(255, 107, 43, 0.06) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 55%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='600'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2300d4ff' stop-opacity='0.05'/%3E%3Cstop offset='100%25' stop-color='%230a0f1e' stop-opacity='0'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g)' width='600' height='600'/%3E%3C/svg%3E") no-repeat center;
            background-size: cover;
        }

        /* Grid décoratif en arrière-plan */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0,212,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,212,255,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
            pointer-events: none;
        }

        .hero .intro-excerpt h1 {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.15;
            color: #ffffff;
            position: relative;
        }

        .hero .intro-excerpt h1 .accent-word {
            color: var(--accent);
            font-family: 'Space Mono', monospace;
        }

        .hero .intro-excerpt h1 span {
            color: var(--text-muted);
            font-size: 0.75em;
            font-weight: 300;
        }

        .hero .intro-excerpt p {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 480px;
        }

        /* Badge "Livraison depuis l'Europe" */
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.25);
            color: var(--accent);
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.78rem;
            font-family: 'Space Mono', monospace;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
        }

        .hero-badge::before {
            content: '▶';
            font-size: 0.6em;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* Stats rapides dans le hero */
        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .hero-stat-item .stat-num {
            font-family: 'Space Mono', monospace;
            font-size: 1.4rem;
            color: var(--accent);
            font-weight: 700;
        }

        .hero-stat-item .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ============================================
                           PRODUCT SECTION
                           ============================================ */
        .product-section {
            background: var(--primary);
            padding: 80px 0;
            position: relative;
        }

        .product-section::before {
            content: 'TECH';
            position: absolute;
            top: 20px;
            right: 40px;
            font-family: 'Space Mono', monospace;
            font-size: 8rem;
            color: rgba(0, 212, 255, 0.03);
            font-weight: 700;
            pointer-events: none;
            letter-spacing: -0.05em;
        }

        .product-section .section-title {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: #fff;
            line-height: 1.3;
        }

        .product-section p {
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.7;
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
        }

        .product-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            border-color: rgba(0, 212, 255, 0.2);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(0, 212, 255, 0.1);
        }

        .product-item:hover::before {
            transform: scaleX(1);
        }

        .product-item .product-thumbnail {
            height: 200px;
            width: 100%;
            object-fit: contain;
            filter: drop-shadow(0 8px 16px rgba(0,0,0,0.5));
            transition: transform 0.3s ease;
        }

        .product-item:hover .product-thumbnail {
            transform: scale(1.04);
        }

        .product-item .product-title {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            color: #e2e8f0 !important;
            margin-top: 12px !important;
            margin-bottom: 6px !important;
        }

        .product-item .product-price {
            font-family: 'Space Mono', monospace !important;
            font-size: 1rem !important;
            color: #00d4ff !important;
            font-weight: 700 !important;
            display: block !important;
        }

        .product-item .icon-cross {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 32px;
            height: 32px;
            background: rgba(0, 212, 255, 0.1);
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

        .product-item .icon-cross img {
            width: 14px;
            filter: invert(1) sepia(1) saturate(5) hue-rotate(170deg);
        }

        /* Select devise */
        #currency-select-home {
            background: var(--surface2);
            border: 1px solid rgba(0, 212, 255, 0.2);
            color: var(--text);
            border-radius: 8px;
            padding: 8px 12px;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
        }

        #currency-select-home:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        }

        /* ============================================
                           WHY CHOOSE US
                           ============================================ */
        .why-choose-section {
            background: var(--surface);
            padding: 90px 0;
            position: relative;
        }

        .why-choose-section::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--accent), var(--accent2), transparent);
        }

        .why-choose-section .section-title {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #fff;
        }

        .why-choose-section > .container > .row > .col-lg-6 > p {
            color: var(--text-muted);
        }

        .feature {
            background: var(--surface2);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 12px;
            padding: 20px;
            height: 100%;
            transition: border-color 0.3s ease;
        }

        .feature:hover {
            border-color: rgba(0, 212, 255, 0.25);
        }

        .feature .icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(255,107,43,0.1));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .feature .icon img {
            width: 22px;
            filter: invert(1) sepia(1) saturate(5) hue-rotate(170deg) brightness(1.2);
        }

        .feature h3 {
            font-family: 'DM Sans', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            color: #fff;
            margin-bottom: 8px;
        }

        .feature p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin: 0;
        }

        /* ============================================
                           WE HELP SECTION
                           ============================================ */
        .we-help-section {
            background: var(--primary);
            padding: 90px 0;
        }

        .we-help-section .section-title {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #fff;
        }

        .we-help-section p {
            color: var(--text-muted);
            line-height: 1.7;
        }

        .we-help-section .custom-list li {
            color: var(--text-muted);
            padding: 8px 0 8px 28px;
            position: relative;
            font-size: 0.92rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }

        .we-help-section .custom-list li::before {
            content: '→';
            position: absolute;
            left: 0;
            color: var(--accent);
            font-family: 'Space Mono', monospace;
        }

        .we-help-section .imgs-grid .grid img {
            border-radius: 12px;
            filter: brightness(0.7) saturate(0.8);
            transition: filter 0.3s ease;
        }

        .we-help-section .imgs-grid .grid img:hover {
            filter: brightness(0.85) saturate(1);
        }

        /* ============================================
                           TESTIMONIALS
                           ============================================ */
        .testimonial-section {
            background: var(--surface);
            padding: 90px 0;
        }

        .testimonial-section .section-title {
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #fff;
        }

        .testimonial-block blockquote p {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.8;
            font-style: italic;
        }

        .testimonial-block .author-info h3 {
            color: #fff;
            font-weight: 600;
        }

        .testimonial-block .author-info .position {
            color: var(--accent);
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
        }

        /* ============================================
                           SCROLL TO TOP
                           ============================================ */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 56px;
            height: 56px;
            background: var(--surface2);
            border: 1px solid rgba(0, 212, 255, 0.3);
            border-radius: 50%;
            cursor: pointer;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(0, 212, 255, 0.35);
            background: var(--accent);
            border-color: var(--accent);
        }

        .scroll-to-top:hover .scroll-icon {
            color: var(--primary);
        }

        .scroll-to-top:active {
            transform: scale(0.95);
        }

        .scroll-icon {
            position: absolute;
            color: var(--accent);
            font-size: 18px;
            z-index: 2;
            animation: bounceUp 2s infinite;
            transition: color 0.2s;
        }

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

        @keyframes bounceUp {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        @media (max-width: 768px) {
            .scroll-to-top {
                width: 48px;
                height: 48px;
                bottom: 20px;
                right: 20px;
            }

            .progress-ring {
                width: 48px;
                height: 48px;
            }

            .hero-stats {
                flex-wrap: wrap;
                gap: 20px;
            }
        }

        /* Boutons hero */
        .btn-secondary {
            background: var(--accent) !important;
            border: 2px solid var(--accent) !important;
            color: var(--primary) !important;
            font-family: 'Space Mono', monospace !important;
            font-weight: 700 !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.04em;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: transparent !important;
            color: var(--accent) !important;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
        }

        /* Overrides globaux */
        .product-section .row > .col-md-12.col-lg-3 p {
            color: var(--text-muted);
        }
    </style>

    <style>
        /* ============================================
           HERO PRODUCTS GRID
        ============================================ */
        .hero-products {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .hero-product-card {
            display: block;
            background: rgba(17, 24, 39, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 212, 255, 0.12);
            border-radius: 12px;
            padding: 14px;
            text-decoration: none !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .hero-product-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, #00d4ff, #ff6b2b);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .hero-product-card:hover {
            border-color: rgba(0, 212, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,212,255,0.1);
        }

        .hero-product-card:hover::before {
            transform: scaleX(1);
        }

        .hero-product-card img.hero-product-img {
            width: 100%;
            height: 110px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5));
            transition: transform 0.3s ease;
        }

        .hero-product-card:hover img.hero-product-img {
            transform: scale(1.06);
        }

        .hero-product-card .hero-product-name {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            color: #e2e8f0 !important;
            margin: 8px 0 4px !important;
            line-height: 1.3 !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hero-product-card .hero-product-price {
            font-family: 'Space Mono', monospace !important;
            font-size: 0.82rem !important;
            color: #00d4ff !important;
            font-weight: 700 !important;
            display: block !important;
        }

        /* Carousel Styles */
        .hero-carousel {
            position: relative;
            z-index: 1;
        }

        .hero-carousel .item {
            padding: 10px;
        }

        .hero-carousel-card {
            display: block;
            background: rgba(17, 24, 39, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 212, 255, 0.12);
            border-radius: 20px;
            padding: 30px;
            text-decoration: none !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .hero-carousel-card:hover {
            border-color: rgba(0, 212, 255, 0.4);
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(0, 212, 255, 0.2);
        }

        .hero-carousel-card img {
            width: 100%;
            height: 250px;
            object-fit: contain;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.5));
            margin-bottom: 20px;
            transition: transform 0.5s ease;
        }

        .hero-carousel-card:hover img {
            transform: scale(1.1) rotate(2deg);
        }

        .hero-carousel-card h3 {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 1.1rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin-bottom: 10px !important;
        }

        .hero-carousel-card .price {
            font-family: 'Space Mono', monospace !important;
            font-size: 1.2rem !important;
            color: var(--accent) !important;
            font-weight: 700 !important;
        }

        .hero-carousel-nav {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        .hero-carousel-nav button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .hero-carousel-nav button:hover {
            background: var(--accent);
            color: var(--primary);
            border-color: var(--accent);
        }

        @media (max-width: 991px) {
            .hero-carousel-container { margin-top: 50px; }
        }

        /* N'afficher que les 4 premiers produits dans le hero */
        .hero-products .hero-product-col:nth-child(n+5) {
            display: none;
        }

        @media (max-width: 991px) {
            .hero-products { display: none; }
        }
    </style>

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="hero-grid"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row justify-content-between align-items-center">

                <!-- Gauche : texte -->
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <div class="hero-badge">LIVRAISON DEPUIS L'EUROPE</div>
                        <h1>
                            <span class="accent-word">KIZNET</span>Shop
                            <span class="d-block" style="color: var(--text-muted); font-size: 0.7em; font-weight: 300; letter-spacing: 0.01em;">Commandez, recevez, payez à la livraison</span>
                        </h1>
                        <p class="mb-4">
                            L'excellence technologique européenne à votre portée. Trouvez les meilleurs ordinateurs et composants avec une garantie de qualité et un paiement sécurisé à la réception.
                        </p>
                        <div class="d-flex gap-3 mb-5">
                            <a href="{{ route('shop') }}" class="btn btn-secondary px-4 py-3"
                                style="font-family: 'Space Mono', monospace; font-weight: 700; font-size: 0.85rem;">
                                Voir le catalogue →
                            </a>
                            <a href="#categories" class="btn btn-explorer px-4 py-3">Explorer par catégorie</a>
                        </div>
                        <div class="hero-stats">
                            <div class="hero-stat-item">
                                <div class="stat-num">500+</div>
                                <div class="stat-label">Produits</div>
                            </div>
                            <div class="hero-stat-item">
                                <div class="stat-num">100%</div>
                                <div class="stat-label">Sécurisé</div>
                            </div>
                            <div class="hero-stat-item">
                                <div class="stat-num">EU</div>
                                <div class="stat-label">Stock Europe</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Droite : Carousel de produits dynamique -->
                <div class="col-lg-5 col-xl-5 offset-xl-1 d-none d-lg-block hero-carousel-container">
                    <div class="hero-carousel-wrap">
                        <div class="hero-carousel">
                            @foreach ($bestSellers as $product)
                                <div class="item">
                                    <a href="{{ route('product.show', $product->id) }}" class="hero-carousel-card">
                                        {{-- <div class="badge-featured" style="position: absolute; top: 20px; right: 20px; background: var(--accent); color: var(--primary); padding: 5px 15px; border-radius: 100px; font-family: 'Space Mono', monospace; font-size: 0.7rem; font-weight: 700; z-index: 2;">
                                            BEST SELLER
                                        </div> --}}
                                        <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" 
                                             class="img-fluid" alt="{{ $product->name }}">
                                        <h3>{{ Str::limit($product->name, 40) }}</h3>
                                        <div class="price product-price" data-price="{{ $product->price }}">
                                            {{ number_format($product->price, 0, ',', ' ') }} F CFA
                                        </div>
                                        <div class="mt-3">
                                            <span class="btn btn-secondary btn-sm px-4">Voir Détails</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="hero-carousel-nav">
                            <button id="hero-prev"><i class="fas fa-chevron-left"></i></button>
                            <button id="hero-next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Categories Section -->
    <div id="categories" class="product-section" style="padding: 100px 0 50px;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title mb-3">Nos Catégories</h2>
                    <p class="text-muted">Parcourez notre sélection par type de matériel</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $cat)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <a href="{{ route('shop', ['category' => $cat->id]) }}" class="category-card text-center d-flex flex-column align-items-center justify-content-center p-4 rounded-4 text-decoration-none h-100" style="background: var(--surface2); border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; min-height: 180px;">
                        <div class="category-icon mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(0,212,255,0.1); border-radius: 50%; flex-shrink: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        </div>
                        <h3 class="h6 text-white mb-1" style="word-break: break-word;">{{ $cat->name }}</h3>
                        <span class="text-muted small">{{ $cat->products_count }} produits</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="product-section">
        <div class="container">
            <div class="row mb-5 align-items-end">
                <div class="col-md-6">
                    <h2 class="section-title">Nos Nouveautés</h2>
                    <p class="text-muted">Les derniers arrivages de nos fournisseurs européens.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('shop') }}" class="btn btn-explorer">Voir tout le catalogue</a>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3">
                        <a class="product-item" href="{{ route('product.show', $product->id) }}" 
                           data-id="{{ $product->id }}" 
                           data-name="{{ $product->name }}" 
                           data-price="{{ $product->price }}" 
                           data-image="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}">
                            <div class="position-relative">
                                <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" class="img-fluid product-thumbnail mb-3" alt="{{ $product->name }}">
                                @if($product->stock < 5 && $product->stock > 0)
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-2">Plus que {{ $product->stock }}!</span>
                                @elseif($product->stock == 0)
                                    <span class="position-absolute top-0 start-0 badge bg-secondary m-2">Rupture</span>
                                @endif
                            </div>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <strong class="product-price">{{ number_format($product->price, 0, ',', ' ') }} F CFA</strong>
                                <span class="icon-cross">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Best Sellers Section -->
    <div class="product-section" style="background: var(--surface);">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-md-12">
                    <h2 class="section-title">Meilleures Ventes</h2>
                    <p class="text-muted">Les produits les plus plébiscités par nos clients.</p>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($bestSellers as $product)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="product-item-horizontal p-3 rounded-4 h-100" style="background: var(--primary); border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease;">
                            <div class="row g-2 align-items-center h-100">
                                <div class="col-4">
                                    <div style="width: 100%; aspect-ratio: 1/1; overflow: hidden; border-radius: 8px; background: var(--surface2); padding: 5px;">
                                        <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" 
                                             class="img-fluid w-100 h-100" style="object-fit: contain;" alt="{{ $product->name }}">
                                    </div>
                                </div>
                                <div class="col-8 d-flex flex-column justify-content-center">
                                    <h4 class="h6 text-white mb-1" style="font-size: 0.85rem; line-height: 1.3; min-height: 2.6em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->name }}
                                    </h4>
                                    <strong class="text-accent d-block mb-2" style="color: var(--accent); font-family: 'Space Mono', monospace; font-size: 0.9rem;">
                                        {{ number_format($product->price, 0, ',', ' ') }} F CFA
                                    </strong>
                                    <div>
                                        <a href="{{ route('product.show', $product->id) }}" class="text-accent small text-decoration-none" style="color: var(--accent); font-weight: 600;">Détails →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== SCRIPT DYNAMIQUE INCHANGÉ ===== --}}
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
                // Pour la section Nouveautés, on laisse le lien naturel aller vers la page détail
                // On n'ajoute pas de preventDefault() ici
            }

            function updateHomePrices() {
                // Section produits principale
                document.querySelectorAll('.product-item').forEach(el => {
                    const p = Number(el.dataset.price) || 0;
                    const priceEl = el.querySelector('.product-price');
                    if (priceEl) priceEl.textContent = formatProductPrice(p);
                });
                // Cards hero
                document.querySelectorAll('.hero-product-card').forEach(el => {
                    const p = Number(el.dataset.price) || 0;
                    const priceEl = el.querySelector('.hero-product-price');
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

            // Initialisation du Carousel Hero (Best Sellers)
            if (document.querySelector('.hero-carousel')) {
                const heroSlider = tns({
                    container: '.hero-carousel',
                    items: 1,
                    slideBy: 'page',
                    autoplay: true,
                    autoplayButtonOutput: false,
                    controls: false,
                    nav: false,
                    mouseDrag: true,
                    gutter: 20,
                    edgePadding: 0,
                    autoplayTimeout: 5000,
                    speed: 800,
                    mode: 'carousel'
                });

                document.getElementById('hero-prev').onclick = () => heroSlider.goTo('prev');
                document.getElementById('hero-next').onclick = () => heroSlider.goTo('next');
            }
        });
    </script>

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Pourquoi commander chez nous ?</h2>
                    <p style="color: var(--text-muted); margin-bottom: 32px;">
                        Commandez vos équipements informatiques en ligne — en gros ou au détail —
                        et payez uniquement à la livraison. Zéro risque, 100% fiable.
                    </p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/truck.svg') }}" alt="Livraison" class="img-fluid">
                                </div>
                                <h3>Livraison à domicile</h3>
                                <p>Vos commandes partent d'Europe et sont livrées directement chez vous, partout.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/bag.svg') }}" alt="Shopping" class="img-fluid">
                                </div>
                                <h3>Commande gros &amp; détail</h3>
                                <p>Particulier ou revendeur, commandez la quantité qui vous convient sans minimum imposé.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/support.svg') }}" alt="Support" class="img-fluid">
                                </div>
                                <h3>Support technique dédié</h3>
                                <p>Notre équipe vous aide à choisir les bons composants selon vos besoins et budget.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/return.svg') }}" alt="Paiement" class="img-fluid">
                                </div>
                                <h3>Paiement à la livraison</h3>
                                <p>Aucun paiement en ligne requis. Vous payez seulement quand vous recevez votre colis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('assets/images/pexels-magda-ehlers-pexels-2861656_1_cropped.png') }}"
                            alt="Image" class="img-fluid" style="border-radius: 16px; filter: brightness(0.75) saturate(0.7);">
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
                                alt="Tech" class="img-fluid">
                        </div>
                        <div class="grid grid-2">
                            <img src="{{ asset('assets/images/10945220_cropped.jpg') }}" alt="Tech" class="img-fluid">
                        </div>
                        <div class="grid grid-3">
                            <img src="{{ asset('assets/images/pexels-karola-g-5239881_cropped.jpg') }}" alt="Tech"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">Commandez votre matériel tech depuis l'Europe, simplement</h2>
                    <p>
                        Parcourez notre catalogue d'ordinateurs portables, PC de bureau, composants
                        (GPU, CPU, RAM, SSD) et périphériques. Sélectionnés chez des fournisseurs européens
                        réputés, livrés chez vous — aucun paiement requis à la commande.
                    </p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Catalogue complet : laptops, desktops, composants, accessoires</li>
                        <li>Expédition depuis l'Europe avec suivi en temps réel</li>
                        <li>Disponible en gros (revendeurs) et au détail (particuliers)</li>
                        <li>Paiement à la livraison — zéro risque, zéro avance</li>
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
                                                            $imagePath = $testimonial->image ?: 'assets/images/person-1.png';
                                                            if (str_starts_with($imagePath, '/storage/')) {
                                                                $imageUrl = asset($imagePath);
                                                            } elseif (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                                                $imageUrl = $imagePath;
                                                            } else {
                                                                $imageUrl = asset($imagePath);
                                                            }
                                                        @endphp
                                                        <img src="{{ $imageUrl }}" alt="{{ $testimonial->name }}"
                                                            class="img-fluid"
                                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid rgba(0,212,255,0.3);">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{ $testimonial->name }}</h3>
                                                    <span class="position d-block mb-3">{{ $testimonial->position ?? 'Client' }}</span>

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
                            @empty
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

    <!-- Bouton Scroll to Top -->
    <div id="scrollToTop" class="scroll-to-top">
        <svg class="progress-ring" width="56" height="56">
            <circle class="progress-ring-circle" stroke="var(--accent)" stroke-width="2" fill="transparent" r="25"
                cx="28" cy="28" />
        </svg>
        <i class="fa fa-chevron-up scroll-icon"></i>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollBtn = document.getElementById('scrollToTop');
            const progressCircle = document.querySelector('.progress-ring-circle');

            const radius = progressCircle.r.baseVal.value;
            const circumference = 2 * Math.PI * radius;

            progressCircle.style.strokeDasharray = `${circumference} ${circumference}`;
            progressCircle.style.strokeDashoffset = circumference;

            function updateProgress() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = scrollTop / docHeight;

                const offset = circumference - (scrollPercent * circumference);
                progressCircle.style.strokeDashoffset = offset;

                if (scrollTop > 300) {
                    scrollBtn.classList.add('show');
                } else {
                    scrollBtn.classList.remove('show');
                }
            }

            window.addEventListener('scroll', updateProgress);

            scrollBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            updateProgress();
        });
    </script>

@endsection