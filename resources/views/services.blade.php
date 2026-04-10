

@extends('layouts.app')

@section('title', 'Services - Furni')

@section('content')

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Services</h1>
                    <p class="mb-4">Des services adaptés aux voyageurs modernes : réservation en ligne, retrait express à l’aéroport et accompagnement personnalisé à chaque étape.</p>
                    {{-- <p><a href="{{ route('shop') }}" class="btn btn-secondary me-2">Acheter maintenant</a> --}}
                        {{-- <a href="#" class="btn btn-white-outline">Explore</a> --}}
                    {{-- </p> --}}
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="{{ asset('assets/images/couch.png') }}" class="img-fluid" alt="Couch">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row my-5">

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/truck.svg') }}" alt="Retrait rapide" class="img-fluid">
                    </div>
                    <h3>Retrait rapide à l’aéroport</h3>
                    <p>Précommandez vos produits en ligne et récupérez-les directement au comptoir, sans attente.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/bag.svg') }}" alt="Shopping simple" class="img-fluid">
                    </div>
                    <h3>Shopping simple &amp; pratique</h3>
                    <p>Parcourez notre catalogue, ajoutez vos articles au panier et précommandez en quelques clics seulement.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/support.svg') }}" alt="Assistance" class="img-fluid">
                    </div>
                    <h3>Assistance disponible</h3>
                    <p>Notre équipe est là pour répondre à toutes vos questions sur les commandes et le retrait.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/return.svg') }}" alt="Flexibilité" class="img-fluid">
                    </div>
                    <h3>Flexibilité &amp; tranquillité</h3>
                    <p>Modifiez ou annulez vos commandes avant le retrait facilement et rapidement.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/truck.svg') }}" alt="Retrait rapide" class="img-fluid">
                    </div>
                    <h3>Retrait rapide à l’aéroport</h3>
                    <p>Vos articles sont préparés et prêts à être récupérés rapidement au comptoir.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/bag.svg') }}" alt="Shopping pratique" class="img-fluid">
                    </div>
                    <h3>Shopping pratique</h3>
                    <p>Précommandez vos produits en ligne en quelques clics et simplifiez vos achats avant le vol.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/support.svg') }}" alt="Assistance" class="img-fluid">
                    </div>
                    <h3>Assistance personnalisée</h3>
                    <p>Notre équipe est disponible pour vous guider et répondre à toutes vos questions.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="{{ asset('assets/images/return.svg') }}" alt="Flexibilité" class="img-fluid">
                    </div>
                    <h3>Flexibilité &amp; tranquillité</h3>
                    <p>Vous pouvez modifier ou annuler vos commandes avant le retrait, selon vos besoins.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- End Why Choose Us Section -->

<!-- Start Product Section -->
<div class="product-section pt-0">
    <div class="container">
        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Profitez d’une expérience de shopping fluide et agréable.</h2>
                <p class="mb-4">Nos produits, allant des parfums sophistiqués aux chocolats et spiritueux de qualité, sont prêts à être précommandés et retirés à l’aéroport en toute simplicité. </p>
                <p><a href="{{ route('shop') }}" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="{{ route('cart') }}">
                    <img src="{{ asset('assets/images/product-1.png') }}" class="img-fluid product-thumbnail" alt="Product 1">
                    <h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>
                    <span class="icon-cross">
                        <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid" alt="Cross">
                    </span>
                </a>
            </div>
            <!-- End Column 2 -->

            <!-- Start Column 3 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="{{ route('cart') }}">
                    <img src="{{ asset('assets/images/product-2.png') }}" class="img-fluid product-thumbnail" alt="Product 2">
                    <h3 class="product-title">Kruzo Aero Chair</h3>
                    <strong class="product-price">$78.00</strong>
                    <span class="icon-cross">
                        <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid" alt="Cross">
                    </span>
                </a>
            </div>
            <!-- End Column 3 -->

            <!-- Start Column 4 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="{{ route('cart') }}">
                    <img src="{{ asset('assets/images/product-3.png') }}" class="img-fluid product-thumbnail" alt="Product 3">
                    <h3 class="product-title">Ergonomic Chair</h3>
                    <strong class="product-price">$43.00</strong>
                    <span class="icon-cross">
                        <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid" alt="Cross">
                    </span>
                </a>
            </div>
            <!-- End Column 4 -->

        </div>
    </div>
</div>
<!-- End Product Section -->

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

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;J’ai réservé mes parfums en ligne et tout était prêt à mon arrivée
                                                    à l’aéroport.
                                                    Service rapide, efficace et sans tracas. Je recommande vivement !&rdquo;
                                                </p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person-1.png') }}"
                                                        alt="Sophie Martin" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Sophie Martin</h3>
                                                <span class="position d-block mb-3">Voyageuse fréquente</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Le retrait à l’aéroport a été un jeu d’enfant. J’ai économisé du
                                                    temps et j’ai eu mes chocolats préférés. Très pratique !&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person-1.png') }}"
                                                        alt="Jean Dupont" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Jean Dupont</h3>
                                                <span class="position d-block mb-3">Voyageur d’affaires</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Service impeccable ! La précommande en ligne est super simple et
                                                    le personnel à l’aéroport était très accueillant. Je le referai à chaque
                                                    voyage.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person-1.png') }}"
                                                        alt="Emma Lefevre" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Emma Lefevre</h3>
                                                <span class="position d-block mb-3">Voyageuse régulière</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->

@endsection