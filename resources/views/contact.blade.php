@extends('layouts.app')

@section('title', 'Contact — KIZNETservice')

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

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,15,30,0.93) 0%, rgba(10,15,30,0.72) 55%, rgba(0,212,255,0.05) 100%);
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
       SECTION CONTACT
    ============================================ */
    .untree_co-section {
        background: var(--primary);
        padding: 80px 0;
    }

    /* Cards infos de contact */
    .service.link {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        padding: 20px 18px;
        text-decoration: none !important;
        transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 16px;
        gap: 14px;
    }

    .service.link:hover {
        border-color: rgba(0, 212, 255, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }

    .service-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        background: linear-gradient(135deg, rgba(0,212,255,0.15), rgba(255,107,43,0.1));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0 !important;
        color: var(--accent);
    }

    .service-contents p {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.5;
    }

    .service-contents p a {
        color: var(--accent);
        text-decoration: none;
        transition: color 0.2s;
    }

    .service-contents p a:hover {
        color: var(--text);
    }

    /* ============================================
       FORMULAIRE
    ============================================ */
    .contact-card {
        background: var(--surface);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 40px 36px;
        position: relative;
        overflow: hidden;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
    }

    .contact-card .form-title {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--text);
        margin-bottom: 6px;
    }

    .contact-card .form-subtitle {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-family: 'Inter', sans-serif;
        font-size: 0.72rem;
        letter-spacing: 0.07em;
        color: var(--text-muted) !important;
        text-transform: uppercase;
        margin-bottom: 6px;
        display: block;
    }

    .form-group .form-control {
        background: var(--surface2);
        border: 1px solid rgba(0, 212, 255, 0.12);
        color: var(--text);
        border-radius: 8px;
        padding: 11px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.92rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-group .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
    }

    .form-group .form-control:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        background: var(--surface2);
        color: var(--text);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 130px;
    }

    /* Bouton submit */
    .btn-explorer {
        background: transparent !important;
        border: 2px solid var(--accent) !important;
        color: var(--accent) !important;
        font-family: 'Inter', sans-serif !important;
        font-size: 0.82rem !important;
        letter-spacing: 0.05em;
        padding: 10px 28px !important;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-explorer:hover {
        background: var(--accent) !important;
        color: var(--primary) !important;
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
    }

    /* Alertes */
    .alert-danger {
        background: rgba(248, 113, 113, 0.1);
        border: 1px solid rgba(248, 113, 113, 0.3);
        color: #f87171;
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .alert-success {
        background: rgba(0, 212, 255, 0.08);
        border: 1px solid rgba(0, 212, 255, 0.25);
        color: var(--accent);
        border-radius: 8px;
        font-size: 0.85rem;
    }

    /* Modal carte */
    .modal-content {
        background: var(--surface);
        border: 1px solid rgba(0, 212, 255, 0.15);
        border-radius: 14px;
        overflow: hidden;
    }

    .modal-header {
        background: var(--surface2);
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .modal-title {
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: var(--text);
    }

    .btn-close {
        filter: invert(1);
    }

    /* reCaptcha dark fix */
    .g-recaptcha {
        margin-top: 16px;
        filter: invert(0.85) hue-rotate(180deg);
    }

    /* ============================================
       MOBILE
    ============================================ */
    @media (max-width: 768px) {
        .untree_co-section { padding: 40px 0 !important; }

        /* Card contact */
        .contact-block { padding: 24px 16px !important; }

        /* Iframe map */
        iframe { height: 280px !important; }
    }

    @media (max-width: 576px) {
        /* Champs prénom/nom → empilement */
        .row-name-fields > [class*="col-"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    /* ============================================
       LIGHT THEME OVERRIDES
    ============================================ */
    html[data-theme="light"] .hero {
        padding-top: 180px !important;
    }

    html[data-theme="light"] .hero::before {
        background: linear-gradient(135deg, rgba(10,15,30,0.93) 0%, rgba(10,15,30,0.72) 55%, rgba(37, 99, 235, 0.05) 100%) !important;
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
    style="background: url('{{ asset('assets/images/customer-service-business-contact-concept-wooden-cube-block-which-print-screen-letter-telephone-email-address-message.jpg') }}') no-repeat center center !important;
    background-size: cover !important;
    padding: 155px 0 60px !important;
    min-height: 400px !important;">

    <div class="hero-grid"></div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="intro-excerpt">
                    <div class="hero-breadcrumb">Accueil / <span>Contact</span></div>
                    <h1><span class="brand">KIZNET</span>service</h1>
                    <p class="mb-4">
                        Une question sur une commande, un produit ou une livraison ?
                        Notre équipe vous répond rapidement — écrivez-nous ou appelez directement.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Contact Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="block">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 pb-4">

                    <!-- Infos de contact -->
                    <div class="row mb-5 g-3">

                        <!-- Adresse -->
                        <div class="col-lg-4">
                            <a href="#" class="service no-shadow align-items-center link horizontal d-flex active"
                                data-bs-toggle="modal" data-bs-target="#mapModal"
                                data-aos="fade-left" data-aos-delay="0">
                                <div class="service-icon color-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                    </svg>
                                </div>
                                <div class="service-contents">
                                    <p>{{ $siteInfos['address'] ?? 'Valeur par défaut' }}</p>
                                </div>
                            </a>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-4">
                            <a href="mailto:contact@kiznetservice.com"
                                class="service no-shadow align-items-center link horizontal d-flex active"
                                data-aos="fade-left" data-aos-delay="100">
                                <div class="service-icon color-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                    </svg>
                                </div>
                                <div class="service-contents">
                                    <p>{{ $siteInfos['email'] ?? 'Valeur par défaut' }}</p>
                                </div>
                            </a>
                        </div>

                        <!-- Téléphone / WhatsApp -->
                        <div class="col-lg-4">
                            <div class="service no-shadow align-items-center link horizontal d-flex active"
                                data-aos="fade-left" data-aos-delay="200">
                                <div class="service-icon color-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                </div>
                                <div class="service-contents">
                                    <p style="white-space: nowrap;">
                                        @php
                                            $phones = explode(' / ', $siteInfos['phone'] ?? '+228 9086 2570 / +228 9947 6525');
                                        @endphp
                                        @foreach ($phones as $index => $phone)
                                            <a href="https://wa.me/{{ str_replace([' ', '+'], '', $phone) }}" target="_blank">
                                                {{ trim($phone) }}
                                            </a>
                                            @if ($index < count($phones) - 1) / @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Modal carte -->
                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mapModalLabel">Localisation — KIZNETservice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31785.780276428497!2d1.246!3d6.16875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e3c906961333%3A0x2201e83329a4ecad!2sA%C3%A9roport%20International%20Gnassingb%C3%A9%20Eyad%C3%A9ma!5e0!3m2!1sfr!2stg!4v1754666800000!5m2!1sfr!2stg"
                                        width="100%" height="500" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="contact-card">
                        <div class="form-title">Envoyer un message</div>
                        <div class="form-subtitle">Nous vous répondons sous 24h — en semaine.</div>

                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                        <form id="contact-form" method="POST" action="{{ route('contact.submit') }}">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fname">Prénom</label>
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Jean" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="lname">Nom</label>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Dupont" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="vous@exemple.com" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" cols="30" rows="5"
                                    placeholder="Décrivez votre demande : produit recherché, quantité, question de livraison..." required></textarea>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LdwcScsAAAAADBEqqBlNwhlkwFUeJZL83ODGaNl"></div>

                            <button type="submit" class="btn btn-explorer mt-3">Envoyer →</button>
                        </form>

                        <!-- Messages retour -->
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div id="success-message" class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const successMsg = document.getElementById('success-message');
                                if (successMsg) {
                                    setTimeout(() => {
                                        successMsg.style.transition = 'opacity 0.5s ease';
                                        successMsg.style.opacity = '0';
                                        setTimeout(() => successMsg.remove(), 500);
                                    }, 10000);
                                }
                            });
                        </script>

                        <script>
                            function onSubmit(token) {
                                document.getElementById("contact-form").submit();
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Section -->

@endsection