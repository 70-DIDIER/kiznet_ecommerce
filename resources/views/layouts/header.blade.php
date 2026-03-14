<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset($siteInfos['logo'] ?? 'assets/images/logov2.jpeg') }}"
                    alt="" height="80" style="border-radius: 50%;">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                        href="{{ route('shop') }}">Boutique</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"
                        href="{{ route('services') }}">Services</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">À
                        propos</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle {{ request()->routeIs('services') ? 'active' : '' }}"
                        href="#"
                        id="categoriesDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Catégories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        @foreach ($categories as $category)
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('shop') }}?category_id={{ $category->id }}"
                                >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                        href="{{ route('blog') }}">Blog</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">Contactez-nous</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                {{-- <li>
                    <a class="nav-link" href="#">
                        <img src="{{ asset('assets/images/user.svg') }}" alt="User">
                    </a>
                </li> --}}
                <li class="position-relative">
                    <a class="nav-link" href="{{ url('cart') }}">
                        <img src="{{ asset('assets/images/cart.svg') }}" alt="Cart">
                        <span id="cart-badge" class="cart-badge">0</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>

</nav>
<!-- End Header/Navigation -->

<style>
    /* Header transparent */
    .custom-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        background: transparent !important;
        z-index: 1000;
        transition: all 0.3s ease;
        padding: 20px 0;
    }

    .custom-navbar.scrolled {
        transform: translateY(-100%);
        opacity: 0;
        pointer-events: none;
    }

    /* Sections hero (hauteur + paramètres) */
    .hero-section,
    section:first-of-type,
    .hero {
        min-height: 100vh !important;
        height: 100vh;
        display: flex;
        align-items: center;
        background-size: cover !important;
        background-position: center !important;
        position: relative;
        overflow: hidden;
    }

    /* *** Assombrissement de l'image du hero *** */
    .hero::before,
    .hero-section::before,
    section:first-of-type::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0, 5);
        /* intensité du sombre */
        z-index: 1;
    }

    /* Textes au-dessus du sombre */
    .hero *,
    .hero-section *,
    section:first-of-type * {
        position: relative;
        z-index: 2;
    }

    /* Logo blanc pur */
    .navbar-brand {
        color: #ffffff !important;
        font-weight: bold;
        font-size: 1.8rem !important;
        text-shadow: none !important;
    }

    .navbar-brand span {
        color: #f9bf29 !important;
    }


    /* ============================================================
       MENU : blanc pur (normal) + hover & active TRÈS brillants
       ============================================================ */

    /* NORMAL = blanc pur */
    .custom-navbar-nav .nav-link {
        color: #ffffff !important;
        opacity: 1 !important;
        font-weight: 600 !important;
        font-size: 1.05rem !important;
        padding: 8px 16px !important;
        transition: all 0.3s ease;
        text-shadow: none !important;
    }

    /* HOVER = doré + glow accentué */
    .custom-navbar-nav .nav-link:hover {
        color: #f9bf29 !important;
        text-shadow:
            0 0 10px rgba(249, 191, 41, 0.9),
            0 0 20px rgba(249, 191, 41, 0.7),
            0 0 35px rgba(249, 191, 41, 0.5);
        transform: translateY(-2px);
    }

    /* ACTIVE = doré + glow puissant */
    .custom-navbar-nav .nav-link.active {
        color: #f9bf29 !important;
        font-weight: 800 !important;
        text-shadow:
            0 0 12px rgba(249, 191, 41, 1),
            0 0 28px rgba(249, 191, 41, 0.9),
            0 0 50px rgba(249, 191, 41, 0.8);
        transform: translateY(-2px);
    }

    /* Textes hero (blanc pur sans glow) */
    .hero p,
    .hero h1,
    .hero h2,
    .hero h3,
    .hero-section p,
    .hero-section h1,
    .hero-section h2,
    .hero-section h3 {
        color: #ffffff !important;
        font-weight: 500;
        text-shadow: none !important;
    }

    .hero h1,
    .hero-section h1 {
        font-size: 3rem !important;
        font-weight: 700 !important;
    }

    /* Icônes panier */
    .custom-navbar-cta img {
        filter: brightness(0) invert(1);
        width: 24px;
        height: 24px;
        transition: all 0.3s ease;
    }

    .custom-navbar-cta img:hover {
        filter: brightness(1) drop-shadow(0 0 10px #f9bf29);
        transform: scale(1.1);
    }

    .cart-badge {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(40%, -40%);
        background: #f9bf29;
        color: #000000;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 12px;
        line-height: 1;
        padding: 2px 6px;
        display: none;
        min-width: 18px;
        text-align: center;
    }

    /* Mobile */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 8px;
        }

        .custom-navbar-nav .nav-link {
            padding: 12px 20px !important;
        }
    }
</style>





<script>
    let lastScrollTop = 0;
    function getCart() { try { return JSON.parse(localStorage.getItem('df_cart') || '[]'); } catch { return []; } }
    function cartCount() { return getCart().reduce((s, i) => s + (Number(i.quantity) || 0), 0); }
    function updateCartBadge() { var el = document.getElementById('cart-badge'); if (!el) return; var c = cartCount(); el.textContent = String(c); el.style.display = c > 0 ? 'inline-block' : 'none'; }
    window.dfUpdateCartBadge = updateCartBadge;

    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.custom-navbar');
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Si on scroll vers le bas et qu'on a dépassé 100px
        if (scrollTop > 100) {
            navbar.classList.add('scrolled');
        } else {
            // Si on remonte en haut
            navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.custom-navbar');

        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        }
        updateCartBadge();
    });

    window.addEventListener('storage', function(e) { if (e.key === 'df_cart') updateCartBadge(); });
</script>
