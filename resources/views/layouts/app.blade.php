<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    @php
        $faviconUrl = !empty($siteInfos['logo'])
            ? (Str::startsWith($siteInfos['logo'], 'http') ? $siteInfos['logo'] : asset($siteInfos['logo']))
            : asset('assets/images/logov2.jpeg');
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}" />
    <link rel="shortcut icon" href="{{ $faviconUrl }}" />
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <title>@yield('title', 'Archipel - DUTYFREE')</title>

    <!-- Anti-FOUC : applique le thème AVANT le rendu -->
    <script>
        (function() {
            var t = localStorage.getItem('kiznet_theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    <style>
        /* ============================================================
           THÈME SOMBRE (valeurs par défaut dans :root de chaque page)
           Ces surcharges s'appliquent explicitement si data-theme=dark
           ============================================================ */
        html[data-theme="dark"] {
            --primary: #0d1117;
            --accent: #4F90F0;
            --accent2: #F97316;
            --surface: #161b27;
            --surface2: #1e2537;
            --text: #E5E7EB;
            --text-muted: #9CA3AF;
        }

        /* ============================================================
           THÈME CLAIR
           ============================================================ */
        html[data-theme="light"] {
            --primary: #F5F7FA;
            --accent: #2563EB;
            --accent2: #EA580C;
            --surface: #FFFFFF;
            --surface2: #EEF2F7;
            --text: #111827;
            --text-muted: #374151;
        }

        html[data-theme="light"] body {
            background: #F5F7FA !important;
            color: #111827 !important;
        }

        /* ============================================================
           NAVBAR CLAIR : toujours visible, jamais transparent
           ============================================================ */
        html[data-theme="light"] .custom-navbar {
            background: rgba(255, 255, 255, 0.97) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.09) !important;
        }

        html[data-theme="light"] .custom-navbar-nav .nav-link {
            color: rgba(15, 23, 42, 0.65) !important;
        }

        html[data-theme="light"] .custom-navbar-nav .nav-link::after {
            background: #2563EB !important;
        }

        html[data-theme="light"] .custom-navbar-nav .nav-link:hover,
        html[data-theme="light"] .custom-navbar-nav .nav-link.active {
            color: #0F172A !important;
        }

        /* Logo texte */
        html[data-theme="light"] .navbar-brand {
            color: #0F172A !important;
        }

        /* Hamburger icon (navbar-dark rend l'icône blanche → invisible sur fond blanc) */
        html[data-theme="light"] .navbar-toggler-icon {
            filter: invert(1) brightness(0) !important;
        }

        html[data-theme="light"] .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.25) !important;
        }

        /* Scrolled en mode clair : rester blanc, pas sombre */
        html[data-theme="light"] .custom-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
        }

        html[data-theme="light"] .custom-navbar-cta img {
            filter: brightness(0) !important;
            opacity: 0.55 !important;
        }

        html[data-theme="light"] .custom-navbar-cta img:hover {
            opacity: 1 !important;
        }

        html[data-theme="light"] .navbar-collapse {
            background: rgba(255, 255, 255, 0.99) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }

        /* ============================================================
           HERO CLAIR (sans image de fond) — fond clair + texte sombre
           Ciblé via :not(.hero-img) pour ne pas toucher les héros
           avec image de fond qui ont leur propre overlay sombre.
           ============================================================ */
        html[data-theme="light"] .hero:not(.hero-img) {
            background: #F5F7FA !important;
            padding-top: 100px !important;
        }

        html[data-theme="light"] .hero:not(.hero-img)::before {
            background: radial-gradient(ellipse at 80% 40%, rgba(37, 99, 235, 0.07) 0%, transparent 65%) !important;
        }

        /* Titres */
        html[data-theme="light"] .hero:not(.hero-img) h1,
        html[data-theme="light"] .hero:not(.hero-img) h2,
        html[data-theme="light"] .hero:not(.hero-img) h3,
        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt h1,
        html[data-theme="light"] .hero-section h1,
        html[data-theme="light"] .hero-section h2,
        html[data-theme="light"] .hero-section h3,
        html[data-theme="light"] section:first-of-type h1,
        html[data-theme="light"] section:first-of-type h2,
        html[data-theme="light"] section:first-of-type h3 {
            color: #0D1117 !important;
            font-weight: 800 !important;
            text-shadow: none !important;
        }

        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt h1 .accent-word,
        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt h1 span.accent,
        html[data-theme="light"] .hero:not(.hero-img) h1 .accent-word {
            color: #2563EB !important;
            font-weight: 800 !important;
        }

        /* Sous-tag h1 */
        html[data-theme="light"] .hero:not(.hero-img) .hero-subtitle-tag,
        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt h1 span,
        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt h1 .hero-subtitle-tag {
            color: #4B5563 !important;
            font-weight: 500 !important;
        }

        /* Paragraphes */
        html[data-theme="light"] .hero:not(.hero-img) p,
        html[data-theme="light"] .hero:not(.hero-img) .intro-excerpt p,
        html[data-theme="light"] .hero:not(.hero-img) .hero-sub-p,
        html[data-theme="light"] .hero:not(.hero-img) .hero-checklist,
        html[data-theme="light"] .hero-section p,
        html[data-theme="light"] section:first-of-type p,
        html[data-theme="light"] .intro-excerpt p {
            color: #374151 !important;
            font-weight: 500 !important;
            text-shadow: none !important;
        }

        /* Badge hero */
        html[data-theme="light"] .hero:not(.hero-img) .hero-badge {
            background: rgba(37, 99, 235, 0.08) !important;
            border-color: rgba(37, 99, 235, 0.2) !important;
            color: #2563EB !important;
            font-weight: 600 !important;
        }

        /* Stats hero */
        html[data-theme="light"] .hero-stats {
            border-top-color: rgba(0, 0, 0, 0.1) !important;
        }

        html[data-theme="light"] .hero:not(.hero-img) .hero-stat-item .stat-num {
            color: #0D1117 !important;
            font-weight: 800 !important;
        }

        html[data-theme="light"] .hero:not(.hero-img) .hero-stat-item .stat-label {
            color: #6B7280 !important;
        }

        /* ============================================================
           HERO AVEC IMAGE DE FOND (.hero-img)
           Préserver l'overlay sombre + texte blanc en thème clair
           ============================================================ */
        html[data-theme="light"] .hero-img {
            padding-top: 100px !important;
        }

        html[data-theme="light"] .hero-img::before {
            background: linear-gradient(135deg, rgba(10,15,30,0.92) 0%, rgba(10,15,30,0.72) 55%, rgba(0,0,0,0.1) 100%) !important;
        }

        html[data-theme="light"] .hero-img .intro-excerpt h1,
        html[data-theme="light"] .hero-img h1 {
            color: #FFFFFF !important;
            font-weight: 800 !important;
        }

        html[data-theme="light"] .hero-img .hero-breadcrumb {
            color: rgba(255,255,255,0.7) !important;
        }

        html[data-theme="light"] .hero-img .hero-breadcrumb span {
            color: #60A5FA !important;
        }

        html[data-theme="light"] .hero-img p,
        html[data-theme="light"] .hero-img .step,
        html[data-theme="light"] .hero-img .sep {
            color: rgba(255,255,255,0.75) !important;
        }

        /* ============================================================
           CARDS DANS LE HERO
           ============================================================ */
        html[data-theme="light"] .hero-product-card {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
        }

        html[data-theme="light"] .hero-product-card:hover {
            border-color: rgba(37, 99, 235, 0.25) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        html[data-theme="light"] .hero-product-card .hero-product-name {
            color: #111827 !important;
            font-weight: 600 !important;
        }

        html[data-theme="light"] .hero-product-card img {
            filter: none !important;
        }

        html[data-theme="light"] .hero-carousel-card {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }

        html[data-theme="light"] .hero-carousel-card h3 {
            color: #111827 !important;
            font-weight: 700 !important;
        }

        html[data-theme="light"] .hero-carousel-card img {
            filter: none !important;
        }

        html[data-theme="light"] .hero-carousel-nav button {
            background: rgba(0, 0, 0, 0.06) !important;
            border-color: rgba(0, 0, 0, 0.12) !important;
            color: #374155 !important;
        }

        /* ============================================================
           SECTIONS DU CONTENU
           ============================================================ */

        /* Fond des sections alternées */
        html[data-theme="light"] .product-section,
        html[data-theme="light"] .we-help-section,
        html[data-theme="light"] .untree_co-section {
            background: #F5F7FA !important;
        }

        html[data-theme="light"] .why-choose-section,
        html[data-theme="light"] .testimonial-section {
            background: #FFFFFF !important;
        }

        /* Tous les titres de sections → noir fort */
        html[data-theme="light"] .section-title,
        html[data-theme="light"] h1, html[data-theme="light"] h2,
        html[data-theme="light"] h3, html[data-theme="light"] h4,
        html[data-theme="light"] h5 {
            color: #111827 !important;
        }

        /* Textes courants */
        html[data-theme="light"] p {
            color: #374151 !important;
        }

        html[data-theme="light"] .text-muted,
        html[data-theme="light"] [style*="color: var(--text-muted)"] {
            color: #6B7280 !important;
        }

        /* Cards produits */
        html[data-theme="light"] .product-item {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.09) !important;
        }

        /* Cartes catégories (bordure inline rgba blanc invisible sur fond clair) */
        html[data-theme="light"] .category-card {
            border-color: rgba(0, 0, 0, 0.09) !important;
        }

        html[data-theme="light"] .category-card h3,
        html[data-theme="light"] .category-card .text-white {
            color: #111827 !important;
        }

        /* Best-sellers cards horizontales */
        html[data-theme="light"] .product-item-horizontal {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.09) !important;
        }

        html[data-theme="light"] .product-item-horizontal h4,
        html[data-theme="light"] .product-item-horizontal .text-white {
            color: #111827 !important;
        }

        html[data-theme="light"] .product-item:hover {
            border-color: rgba(37, 99, 235, 0.25) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
        }

        html[data-theme="light"] .product-item .product-title {
            color: #111827 !important;
            font-weight: 600 !important;
        }

        html[data-theme="light"] .product-thumbnail {
            filter: none !important;
        }

        /* Feature cards */
        html[data-theme="light"] .feature {
            background: #F8FAFC !important;
            border-color: rgba(0, 0, 0, 0.08) !important;
        }

        html[data-theme="light"] .feature h3 {
            color: #111827 !important;
            font-weight: 700 !important;
        }

        html[data-theme="light"] .feature p {
            color: #6B7280 !important;
        }

        html[data-theme="light"] .feature .icon {
            background: rgba(37, 99, 235, 0.08) !important;
        }

        html[data-theme="light"] .feature .icon img {
            filter: none !important;
            opacity: 0.85 !important;
        }

        /* Liste "we-help" */
        html[data-theme="light"] .we-help-section .custom-list li {
            color: #374151 !important;
            border-bottom-color: rgba(0, 0, 0, 0.07) !important;
        }

        html[data-theme="light"] .we-help-section .imgs-grid .grid img {
            filter: none !important;
        }

        /* Témoignages */
        html[data-theme="light"] .testimonial-block {
            background: #F8FAFC !important;
            border-color: rgba(0, 0, 0, 0.08) !important;
        }

        html[data-theme="light"] .testimonial-block blockquote p {
            color: #374151 !important;
        }

        html[data-theme="light"] .testimonial-block .author-info h3 {
            color: #111827 !important;
            font-weight: 700 !important;
        }

        /* ============================================================
           FILTRES / FORMULAIRES
           ============================================================ */
        html[data-theme="light"] .filters-bar {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.09) !important;
        }

        html[data-theme="light"] .filters-bar .form-control,
        html[data-theme="light"] .filters-bar .form-select,
        html[data-theme="light"] .form-control,
        html[data-theme="light"] .form-select {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.14) !important;
            color: #111827 !important;
        }

        html[data-theme="light"] .filters-bar .form-control::placeholder,
        html[data-theme="light"] .form-control::placeholder {
            color: #9CA3AF !important;
        }

        html[data-theme="light"] .filters-bar .form-select option,
        html[data-theme="light"] .form-select option {
            background: #FFFFFF;
            color: #111827;
        }

        html[data-theme="light"] .filter-label,
        html[data-theme="light"] label {
            color: #374151 !important;
        }

        /* ============================================================
           PANIER / CHECKOUT / DÉTAIL PRODUIT / À PROPOS / CONTACT
           ============================================================ */
        html[data-theme="light"] .untree_co-section,
        html[data-theme="light"] section {
            background: #F5F7FA;
            color: #111827 !important;
        }

        /* Tableaux */
        html[data-theme="light"] table,
        html[data-theme="light"] td,
        html[data-theme="light"] th {
            color: #111827 !important;
        }

        html[data-theme="light"] .site-block-order-table {
            border-color: rgba(0, 0, 0, 0.09) !important;
        }

        html[data-theme="light"] .site-block-order-table td,
        html[data-theme="light"] .site-block-order-table th {
            border-color: rgba(0, 0, 0, 0.09) !important;
            color: #111827 !important;
        }

        /* Spans et éléments divers */
        html[data-theme="light"] span,
        html[data-theme="light"] li,
        html[data-theme="light"] a:not(.btn):not(.nav-link) {
            color: inherit;
        }

        /* Liens de contenu (hors nav/bouton) */
        html[data-theme="light"] .links-wrap ul li a,
        html[data-theme="light"] footer a {
            color: #6B7280 !important;
        }

        html[data-theme="light"] .links-wrap ul li a:hover,
        html[data-theme="light"] footer a:hover {
            color: #2563EB !important;
        }

        /* ============================================================
           FOOTER CLAIR
           ============================================================ */
        html[data-theme="light"] .footer-section {
            background: #1E293B !important;
        }

        html[data-theme="light"] .footer-section h5,
        html[data-theme="light"] .footer-section h3,
        html[data-theme="light"] .footer-section p,
        html[data-theme="light"] .footer-section li,
        html[data-theme="light"] .footer-section a,
        html[data-theme="light"] .footer-section span,
        html[data-theme="light"] .footer-section .copyright p {
            color: #CBD5E1 !important;
        }

        html[data-theme="light"] .footer-section .subscription-form {
            background: rgba(255, 255, 255, 0.05) !important;
        }

        html[data-theme="light"] .footer-section .subscription-form .form-control {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #E2E8F0 !important;
        }

        html[data-theme="light"] .footer-section .custom-social li a {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #CBD5E1 !important;
        }

        /* ============================================================
           SCROLL TO TOP CLAIR
           ============================================================ */
        html[data-theme="light"] .scroll-to-top {
            background: #FFFFFF !important;
            border-color: rgba(0, 0, 0, 0.12) !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1) !important;
        }

        html[data-theme="light"] .scroll-to-top .scroll-icon {
            color: #6B7280 !important;
        }

        html[data-theme="light"] .scroll-to-top:hover {
            background: #2563EB !important;
            border-color: #2563EB !important;
        }

        html[data-theme="light"] .scroll-to-top:hover .scroll-icon {
            color: #ffffff !important;
        }

        /* ============================================================
           OPTIMISATION MOBILE GLOBALE
           ============================================================ */

        /* Tablette (≤ 991px) */
        @media (max-width: 991px) {
            .hero.hero-img {
                padding: 130px 0 50px !important;
            }
        }

        /* Mobile (≤ 768px) */
        @media (max-width: 768px) {
            /* Logo navbar */
            .navbar-brand img {
                width: 70px !important;
                height: 70px !important;
            }

            /* Hero sans image */
            .hero:not(.hero-img) {
                padding: 100px 0 40px !important;
                min-height: auto !important;
            }

            /* Hero avec image */
            .hero.hero-img {
                padding: 110px 0 40px !important;
                min-height: 280px !important;
            }

            /* Hero breadcrumb + h1 */
            .hero .intro-excerpt h1 {
                font-size: clamp(1.6rem, 6vw, 2.5rem) !important;
            }

            /* Sections de contenu */
            .product-section,
            .why-choose-section,
            .we-help-section,
            .testimonial-section,
            .untree_co-section {
                padding: 50px 0 !important;
            }

            /* Cards produits */
            .product-item .product-thumbnail {
                height: 160px !important;
            }

            /* Tableau panier / checkout — scroll horizontal */
            .table-responsive-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            /* Formulaires : champs côte-à-côte → empilement */
            .form-row-mobile .col-md-6,
            .form-row-mobile .col-6 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }

            /* Footer : padding réduit */
            .footer-section > .container {
                padding-top: 36px !important;
            }

            .footer-section .subscription-form {
                padding: 20px 16px 18px !important;
                margin-bottom: 32px !important;
            }

            /* Section produit detail */
            .product-detail-section {
                padding: 100px 0 40px !important;
            }
        }

        /* Petit mobile (≤ 576px) */
        @media (max-width: 576px) {
            /* Logo encore plus petit */
            .navbar-brand img {
                width: 58px !important;
                height: 58px !important;
            }

            /* Hero */
            .hero:not(.hero-img),
            .hero.hero-img {
                padding: 90px 0 30px !important;
            }

            /* Titre hero encore plus compact */
            .hero .intro-excerpt h1 {
                font-size: clamp(1.4rem, 7vw, 2rem) !important;
            }

            /* Stats hero : empiler */
            .hero-stats {
                flex-direction: column !important;
                gap: 12px !important;
            }

            /* Boutons hero côte à côte → empilés */
            .hero .d-flex.gap-3 {
                flex-direction: column !important;
                gap: 10px !important;
            }

            .hero .d-flex.gap-3 .btn {
                width: 100% !important;
                text-align: center !important;
            }

            /* Sections */
            .product-section,
            .why-choose-section,
            .we-help-section {
                padding: 36px 0 !important;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
  
        @yield('content')
   

   

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Ajoute ce code juste avant la fermeture du body dans ton layout -->

    <!-- Bouton Scroll to Top avec indicateur de progression -->
    <div id="scrollToTop" class="scroll-to-top">
        <i class="fa fa-chevron-up scroll-icon"></i>
    </div>

    <style>
        /* ============================================
           BOUTON SCROLL TO TOP
           ============================================ */
        .scroll-to-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 44px;
            height: 44px;
            background: #1e2537;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            cursor: pointer;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease, background 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            background: #4F90F0;
            border-color: #4F90F0;
        }

        .scroll-icon {
            color: #9CA3AF;
            font-size: 15px;
            transition: color 0.2s;
        }

        .scroll-to-top:hover .scroll-icon {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .scroll-to-top {
                width: 40px;
                height: 40px;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollBtn = document.getElementById('scrollToTop');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollBtn.classList.add('show');
                } else {
                    scrollBtn.classList.remove('show');
                }
            });

            scrollBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

</body>

</html>
