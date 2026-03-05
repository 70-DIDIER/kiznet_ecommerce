<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />

    <title>@yield('title', 'Archipel - DUTYFREE')</title>
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
        <svg class="progress-ring" width="60" height="60">
            <circle class="progress-ring-circle" stroke="#ff8c00" stroke-width="3" fill="transparent" r="27"
                cx="30" cy="30" />
        </svg>
        <i class="fa fa-chevron-up scroll-icon"></i>
    </div>

    <style>
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
    </style>

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

    <!-- Scripts -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

</body>

</html>
