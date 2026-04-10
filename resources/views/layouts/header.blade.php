<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset($siteInfos['logo'] ?? 'assets/images/logov2.jpeg') }}"
                    alt="" width="70" height="70" style="border-radius: 50%; object-fit: contain; background: #fff;">
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
                <!-- Toggle thème -->
                <li class="d-flex align-items-center">
                    <button id="theme-toggle" class="theme-toggle-btn" title="Changer de thème" aria-label="Changer de thème">
                        <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5"/>
                            <line x1="12" y1="1" x2="12" y2="3"/>
                            <line x1="12" y1="21" x2="12" y2="23"/>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                            <line x1="1" y1="12" x2="3" y2="12"/>
                            <line x1="21" y1="12" x2="23" y2="12"/>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                        </svg>
                        <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                    </button>
                </li>
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
    /* ============================================================
       NAVBAR
       ============================================================ */
    .custom-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        background: transparent !important;
        z-index: 1000;
        transition: background 0.3s ease, box-shadow 0.3s ease, padding 0.3s ease;
        padding: 10px 0;
    }

    .custom-navbar.scrolled {
        background: rgba(13, 17, 26, 0.96) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 1px 0 rgba(255,255,255,0.06);
        padding: 8px 0;
    }

    /* Logo */
    .navbar-brand {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.6rem !important;
    }

    .navbar-brand span {
        color: #4F90F0 !important;
    }

    /* Liens nav */
    .custom-navbar-nav .nav-link {
        color: rgba(255,255,255,0.75) !important;
        font-weight: 500 !important;
        font-size: 0.9rem !important;
        padding: 4px 10px !important;
        transition: color 0.2s ease;
        position: relative;
    }

    /* Neutralise le ::before du template (barre orange style.css) */
    .custom-navbar .custom-navbar-nav li a::before {
        display: none !important;
    }

    .custom-navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 14px;
        right: 14px;
        height: 2px;
        background: #4F90F0;
        transform: scaleX(0);
        transition: transform 0.2s ease;
        border-radius: 2px;
    }

    .custom-navbar-nav .nav-link:hover {
        color: #ffffff !important;
    }

    .custom-navbar-nav .nav-link:hover::after {
        transform: scaleX(0.5);
    }

    .custom-navbar-nav .nav-link.active {
        color: #ffffff !important;
        font-weight: 600 !important;
    }

    .custom-navbar-nav .nav-link.active::after {
        transform: scaleX(0.7);
    }

    /* Icônes panier */
    .custom-navbar-cta img {
        filter: brightness(0) invert(1);
        opacity: 0.75;
        width: 22px;
        height: 22px;
        transition: opacity 0.2s ease;
    }

    .custom-navbar-cta img:hover {
        opacity: 1;
    }

    .cart-badge {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(40%, -40%);
        background: #4F90F0;
        color: #ffffff;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 11px;
        line-height: 1;
        padding: 2px 5px;
        display: none;
        min-width: 17px;
        text-align: center;
    }

    /* Tablette / Mobile */
    @media (max-width: 991px) {
        .custom-navbar {
            padding: 6px 0;
        }

        .navbar-collapse {
            background: rgba(13, 17, 26, 0.97);
            padding: 16px;
            border-radius: 10px;
            margin-top: 8px;
            border: 1px solid rgba(255,255,255,0.07);
        }

        html[data-theme="light"] .navbar-collapse {
            background: rgba(255, 255, 255, 0.99) !important;
            border-color: rgba(0, 0, 0, 0.1) !important;
        }

        .custom-navbar-nav .nav-link {
            padding: 10px 16px !important;
        }

        .custom-navbar-nav .nav-link::after {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .custom-navbar {
            padding: 5px 0;
        }

        .custom-navbar-cta.ms-5 {
            margin-left: 12px !important;
        }
    }

    /* ============================================================
       BOUTON TOGGLE THÈME
       ============================================================ */
    .theme-toggle-btn {
        background: none;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 8px;
        padding: 6px 8px;
        cursor: pointer;
        color: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        line-height: 1;
    }

    .theme-toggle-btn:hover {
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.06);
    }

    /* Icônes soleil/lune : l'une masquée selon le thème */
    #icon-sun,
    #icon-moon {
        display: none;
    }

    html[data-theme="dark"] #icon-sun {
        display: block; /* en mode sombre → montrer le soleil (pour passer au clair) */
    }

    html[data-theme="light"] #icon-moon {
        display: block; /* en mode clair → montrer la lune (pour passer au sombre) */
    }

    /* Bouton clair en mode light */
    html[data-theme="light"] .theme-toggle-btn {
        border-color: rgba(0, 0, 0, 0.2);
        color: rgba(15, 23, 42, 0.65);
    }

    html[data-theme="light"] .theme-toggle-btn:hover {
        color: #0F172A;
        border-color: rgba(0, 0, 0, 0.35);
        background: rgba(0, 0, 0, 0.05);
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
        if (scrollTop > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.custom-navbar');
        if (window.scrollY > 60) {
            navbar.classList.add('scrolled');
        }
        updateCartBadge();
    });

    window.addEventListener('storage', function(e) { if (e.key === 'df_cart') updateCartBadge(); });

    /* ============================================================
       TOGGLE THÈME CLAIR / SOMBRE
       ============================================================ */
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('theme-toggle');
        if (!btn) return;

        btn.addEventListener('click', function() {
            var current = document.documentElement.getAttribute('data-theme') || 'dark';
            var next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('kiznet_theme', next);
        });
    });
</script>
