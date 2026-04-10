<!-- Start Footer Section -->
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

    /* ============================================
       FOOTER
    ============================================ */
    .footer-section {
        background: var(--surface) !important;
        color: var(--text) !important;
        font-family: 'DM Sans', sans-serif;
        border-top: 1px solid rgba(255,255,255,0.05);
        position: relative;
        overflow: hidden;
    }

    /* Ligne déco en haut */
    .footer-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent2), var(--accent));
    }

    /* Watermark supprimé */
    .footer-section::after {
        display: none;
    }

    /* ============================================
       NEWSLETTER
    ============================================ */
    .footer-section .subscription-form {
        background: var(--surface2);
        border: 1px solid rgba(0, 212, 255, 0.12);
        border-radius: 14px;
        padding: 28px 28px 24px;
        margin-bottom: 48px;
        position: relative;
        overflow: hidden;
    }

    .footer-section .subscription-form::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
    }

    .footer-section .subscription-form h3 {
        font-family: 'DM Sans', sans-serif !important;
        font-weight: 600 !important;
        font-size: 1.1rem !important;
        color: #fff !important;
        margin-bottom: 18px !important;
    }

    .footer-section .subscription-form h3 img {
        filter: invert(1) sepia(1) saturate(5) hue-rotate(170deg);
        width: 22px;
    }

    .footer-section .subscription-form .form-control {
        background: var(--primary) !important;
        border: 1px solid rgba(0, 212, 255, 0.15) !important;
        color: var(--text) !important;
        border-radius: 8px !important;
        padding: 10px 14px !important;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.88rem;
        transition: border-color 0.2s;
    }

    .footer-section .subscription-form .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
    }

    .footer-section .subscription-form .form-control:focus {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(0,212,255,0.1) !important;
        outline: none;
        background: var(--primary) !important;
        color: var(--text) !important;
    }

    .footer-section .subscription-form .btn-primary {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: var(--primary) !important;
        font-weight: 700;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        transition: all 0.25s ease;
    }

    .footer-section .subscription-form .btn-primary:hover {
        background: transparent !important;
        color: var(--accent) !important;
        border-color: var(--accent) !important;
    }

    /* Alertes newsletter */
    .footer-section .alert-success {
        background: rgba(0,212,255,0.08);
        border: 1px solid rgba(0,212,255,0.2);
        color: var(--accent);
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .footer-section .alert-info {
        background: rgba(255,107,43,0.08);
        border: 1px solid rgba(255,107,43,0.2);
        color: var(--accent2);
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .footer-section .alert-danger {
        background: rgba(248,113,113,0.08);
        border: 1px solid rgba(248,113,113,0.2);
        color: #f87171;
        border-radius: 8px;
        font-size: 0.85rem;
    }

    .footer-section .btn-close {
        filter: invert(1);
    }

    /* ============================================
       COLONNES FOOTER
    ============================================ */
    .footer-section .col-lg-3 p {
        color: var(--text-muted) !important;
        font-size: 0.88rem;
        line-height: 1.7;
    }

    /* Titres colonnes */
    .footer-section .links-wrap h5 {
        font-size: 0.78rem !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase;
        color: rgba(255,255,255,0.5) !important;
        margin-bottom: 16px !important;
        font-weight: 600 !important;
    }

    /* Liens */
    .footer-section .links-wrap ul li a {
        color: var(--text-muted) !important;
        font-size: 0.88rem;
        text-decoration: none;
        transition: color 0.2s ease;
        display: inline-block;
        padding: 3px 0;
    }

    .footer-section .links-wrap ul li a:hover {
        color: var(--accent) !important;
        padding-left: 4px;
    }

    /* Texte "Suivez-nous" */
    .footer-section .links-wrap p {
        color: var(--text-muted) !important;
        font-size: 0.82rem !important;
    }

    /* Icônes sociales */
    .footer-section .custom-social {
        display: flex;
        gap: 10px;
        margin-top: 12px !important;
        list-style: none;
        padding: 0;
    }

    .footer-section .custom-social li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: var(--primary);
        border: 1px solid rgba(0,212,255,0.15);
        border-radius: 8px;
        color: var(--text-muted) !important;
        font-size: 0.88rem;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .footer-section .custom-social li a:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .footer-section .custom-social li a span {
        color: inherit !important;
    }

    /* ============================================
       COPYRIGHT
    ============================================ */
    .footer-section .border-top {
        border-top: 1px solid rgba(255,255,255,0.06) !important;
    }

    .footer-section .copyright p {
        color: var(--text-muted) !important;
        font-size: 0.82rem;
    }

    .footer-section .copyright .btn-primary {
        background: rgba(79,144,240,0.1) !important;
        border: 1px solid rgba(79,144,240,0.25) !important;
        color: var(--accent) !important;
        font-size: 0.8rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .footer-section .copyright .btn-primary:hover {
        background: var(--accent) !important;
        color: #ffffff !important;
    }

    /* Séparateur entre newsletter et colonnes */
    .footer-divider {
        height: 1px;
        background: rgba(255,255,255,0.05);
        margin-bottom: 40px;
    }
</style>

<footer class="footer-section">
    <div class="container relative" style="padding-top: 56px;">

        <div class="row">
            <div class="col-lg-8">
                <div class="subscription-form">
                    <h3 class="d-flex align-items-center">
                        <span class="me-2">
                            <img src="{{ asset('assets/images/envelope-outline.svg') }}" alt="Envelope" class="img-fluid">
                        </span>
                        <span>Recevoir nos offres &amp; nouveautés</span>
                    </h3>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info alert-dismissible fade show auto-dismiss" role="alert">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-12 col-sm-auto">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Votre prénom"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12 col-sm-auto">
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Votre adresse e-mail"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="col-12 col-sm-auto">
                            <button type="submit" class="btn btn-primary w-100">
                                <span class="fa fa-paper-plane"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alerts = document.querySelectorAll('.auto-dismiss');
                    alerts.forEach(function(alert) {
                        setTimeout(function() {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }, 15000);
                    });
                });
            </script>
        </div>

        <div class="footer-divider"></div>

        <div class="row g-5 mb-5">
            <!-- Logo + description -->
            <div class="col-lg-3 col-md-6">
                <a class="navbar-brand d-inline-block mb-3" href="{{ route('home') }}">
                    <img src="{{ asset($siteInfos['logo'] ?? 'assets/images/dutyfree-logo-BRFPKRQG.png') }}"
                        alt="KIZNETservice" height="70"
                        style="filter: brightness(1.1);">
                </a>
                <p class="mb-4">
                    {{ $siteInfos['site_description'] ?? 'Valeur par défaut' }}
                </p>
            </div>

            <!-- Liens -->
            <div class="col-lg-9 col-md-6">
                <div class="row links-wrap">

                    <div class="col-6 col-sm-6 col-md-4">
                        <h5>Navigation</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}">À propos</a></li>
                            <li><a href="{{ route('shop') }}">Catalogue</a></li>
                            <li><a href="{{ route('contact') }}">Contactez-nous</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-4">
                        <h5>Légal</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Conditions générales</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                        </ul>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4">
                        <h5>Suivez-nous</h5>
                        <p>Restez connecté avec <strong style="color: var(--accent);">KIZNET</strong>service</p>
                        <ul class="list-unstyled custom-social">
                            @if ($siteInfos['facebook_url'] ?? null)
                                <li>
                                    <a href="{{ $siteInfos['facebook_url'] }}" target="_blank" rel="noopener" title="Facebook">
                                        <span class="fa fa-brands fa-facebook-f"></span>
                                    </a>
                                </li>
                            @endif

                            @if ($siteInfos['twitter_url'] ?? null)
                                <li>
                                    <a href="{{ $siteInfos['twitter_url'] }}" target="_blank" rel="noopener" title="Twitter / X">
                                        <span class="fa fa-brands fa-twitter"></span>
                                    </a>
                                </li>
                            @endif

                            @if ($siteInfos['instagram_url'] ?? null)
                                <li>
                                    <a href="{{ $siteInfos['instagram_url'] }}" target="_blank" rel="noopener" title="Instagram">
                                        <span class="fa fa-brands fa-instagram"></span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-top copyright">
            <div class="row pt-4 pb-4">
                <div class="col-12">
                    <p class="mb-2 text-center">
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script>
                        <strong style="color: var(--accent); font-family: 'Inter', sans-serif;">KIZNET</strong>service
                        — Tous droits réservés.
                    </p>
                    @auth
                        <div class="text-center mt-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                                ⚙ Panel admin
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- End Footer Section -->