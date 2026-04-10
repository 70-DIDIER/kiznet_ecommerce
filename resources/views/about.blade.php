@extends('layouts.app')

@section('title', 'À propos — KIZNETservice')

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

    /* Overlay sombre + teinte tech sur la photo */
    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(10,15,30,0.92) 0%, rgba(10,15,30,0.70) 50%, rgba(0,212,255,0.06) 100%);
        z-index: 1;
    }

    /* Grille décorative */
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
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        color: var(--text);
        margin-bottom: 16px;
    }

    .hero .intro-excerpt h1 .brand {
        color: var(--accent);
        font-family: 'Inter', sans-serif;
    }

    .hero .intro-excerpt p {
        font-size: 1rem;
        line-height: 1.75;
        color: var(--text-muted);
        max-width: 460px;
    }

    .hero-breadcrumb {
        font-family: 'Inter', sans-serif;
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 0.08em;
        margin-bottom: 14px;
    }

    .hero-breadcrumb span { color: var(--accent); }

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
        color: var(--text);
        margin-bottom: 16px;
    }

    .why-choose-section > .container > .row > .col-lg-6 > p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .feature {
        background: var(--surface2);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .feature:hover {
        border-color: rgba(0, 212, 255, 0.25);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
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
        color: var(--text);
        margin-bottom: 8px;
    }

    .feature p {
        font-size: 0.84rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin: 0;
    }

    /* Image aside */
    .why-choose-section .img-wrap img {
        border-radius: 16px;
        filter: brightness(0.7) saturate(0.7);
        transition: filter 0.3s;
    }

    .why-choose-section .img-wrap img:hover {
        filter: brightness(0.85) saturate(1);
    }

    /* ============================================
       MISSION BANNER
    ============================================ */
    .mission-banner {
        background: var(--primary);
        padding: 70px 0;
        position: relative;
        overflow: hidden;
    }

    .mission-banner::before {
        content: 'KIZNET';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: 'Inter', sans-serif;
        font-size: 10rem;
        font-weight: 700;
        color: rgba(0,212,255,0.025);
        white-space: nowrap;
        pointer-events: none;
        letter-spacing: -0.04em;
    }

    .mission-banner .mission-card {
        background: var(--surface2);
        border: 1px solid rgba(0,212,255,0.1);
        border-radius: 14px;
        padding: 32px 28px;
        text-align: center;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .mission-banner .mission-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0,212,255,0.3);
    }

    .mission-banner .mission-card .mission-num {
        font-family: 'Inter', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent);
        line-height: 1;
        margin-bottom: 8px;
    }

    .mission-banner .mission-card h4 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text);
        margin-bottom: 8px;
    }

    .mission-banner .mission-card p {
        font-size: 0.83rem;
        color: var(--text-muted);
        margin: 0;
        line-height: 1.6;
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
        color: var(--text);
    }

    .testimonial-block blockquote p {
        color: var(--text-muted);
        font-size: 1.05rem;
        line-height: 1.8;
        font-style: italic;
    }

    .testimonial-block .author-info h3 {
        color: var(--text);
        font-weight: 600;
    }

    .testimonial-block .author-info .position {
        color: var(--accent);
        font-family: 'Inter', sans-serif;
        font-size: 0.78rem;
    }

    .testimonial-block .author-pic img {
        border: 2px solid rgba(0,212,255,0.3) !important;
    }

    /* ============================================
       MOBILE
    ============================================ */
    @media (max-width: 768px) {
        .mission-banner { padding: 40px 0 !important; }
        .mission-card { padding: 20px 16px !important; }
        .mission-num { font-size: clamp(1.4rem, 5vw, 2rem) !important; }

        .why-choose-section { padding: 50px 0 !important; }
        .why-choose-section .section-title { font-size: 1.4rem !important; }

        .testimonial-section { padding: 50px 0 !important; }
        .testimonial-block { padding: 20px !important; }
    }

    @media (max-width: 576px) {
        .we-help-section .imgs-grid { display: none; }
        .mission-card { margin-bottom: 12px; }
    }

    /* ============================================
       LIGHT THEME OVERRIDES
    ============================================ */
    html[data-theme="light"] .hero {
        padding-top: 180px !important;
    }

    html[data-theme="light"] .hero::before {
        background: linear-gradient(135deg, rgba(10,15,30,0.92) 0%, rgba(10,15,30,0.70) 50%, rgba(37, 99, 235, 0.06) 100%) !important;
    }

    html[data-theme="light"] .hero .intro-excerpt h1 {
        color: #FFFFFF !important;
        text-shadow: none !important;
    }

    html[data-theme="light"] .hero .intro-excerpt h1 .brand {
        color: #2563EB !important;
    }

    html[data-theme="light"] .hero .intro-excerpt p {
        color: rgba(255,255,255,0.9) !important;
        text-shadow: none !important;
    }

    html[data-theme="light"] .hero-breadcrumb {
        color: rgba(255,255,255,0.7) !important;
    }

    html[data-theme="light"] .hero-breadcrumb span {
        color: #60A5FA !important;
    }
</style>

<!-- Start Hero Section -->
<div class="hero hero-img"
    style="background: url('{{ asset('assets/images/about-as-service-contact-information-concept (1).jpg') }}') no-repeat center center !important;
    background-size: cover !important;
    padding: 155px 0 60px !important;
    min-height: 420px !important;">

    <div class="hero-grid"></div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    <div class="hero-breadcrumb">Accueil / <span>À propos</span></div>
                    <h1><span class="brand">KIZNET</span>service</h1>
                    <p class="mb-4">
                        Votre partenaire tech pour l'achat d'ordinateurs et de composants électroniques
                        depuis l'Europe — commandez en ligne, payez uniquement à la livraison.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Mission / Chiffres clés -->
<div class="mission-banner">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="mission-card">
                    <div class="mission-num">500+</div>
                    <h4>Produits</h4>
                    <p>Ordinateurs, composants &amp; accessoires tech disponibles</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mission-card">
                    <div class="mission-num">0€</div>
                    <h4>Avance requise</h4>
                    <p>Paiement uniquement à la réception de votre commande</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mission-card">
                    <div class="mission-num">EU</div>
                    <h4>Expédié depuis</h4>
                    <p>Produits sourcés et envoyés depuis l'Europe</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mission-card">
                    <div class="mission-num">B2B</div>
                    <h4>Gros &amp; Détail</h4>
                    <p>Particuliers et revendeurs, sans minimum de commande</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Pourquoi choisir KIZNETservice ?</h2>
                <p>Commandez vos équipements informatiques en toute confiance — aucun paiement en ligne,
                    livraison depuis l'Europe, disponible pour les particuliers comme pour les revendeurs.</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/truck.svg') }}" alt="Livraison" class="img-fluid">
                            </div>
                            <h3>Livraison à domicile</h3>
                            <p>Vos commandes partent d'Europe et arrivent directement chez vous, en toute sécurité.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/bag.svg') }}" alt="Commande" class="img-fluid">
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
                            <p>Notre équipe vous aide à choisir les bons composants selon vos besoins et votre budget.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 mb-4">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('assets/images/return.svg') }}" alt="Paiement" class="img-fluid">
                            </div>
                            <h3>Paiement à la livraison</h3>
                            <p>Aucun paiement en ligne requis. Vous réglez uniquement quand vous recevez votre colis.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="{{ asset('assets/images/pexels-magda-ehlers-pexels-2861656_1_cropped.png') }}" alt="KIZNETservice" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section before-footer-section">
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
                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
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

@endsection