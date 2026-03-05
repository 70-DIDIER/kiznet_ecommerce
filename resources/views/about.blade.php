@extends('layouts.app')

@section('title', 'About Us - Furni')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero"
    style="background: url('{{ asset('assets/images/about-as-service-contact-information-concept (1).jpg') }}') no-repeat center center !important; 
    background-size: cover !important; 
    padding: 120px 0 !important;
    min-height: 550px !important;
    height: 550px !important;
    max-height: 550px !important;">
    
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>À propos de nous</h1>
                    <p class="mb-4" style="font-size: 1.1rem; line-height: 1.1;">
                        Nous facilitons vos achats Duty Free : réservez en ligne, récupérez vos articles à
                        l’aéroport, sans paiement en ligne et sans attente.
                    </p>
                    <p>
                        {{-- <a href="" class="btn btn-secondary me-2">Acheter maintenant</a> --}}
                        {{-- <a href="#" class="btn btn-white-outline">Explorer</a> --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- End Hero Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Pourquoi nous choisir ?</h2>
                    <p>Précommandez vos produits Duty Free en ligne et récupérez-les directement à l’aéroport.
                        Simple, rapide et sécurisé — aucun paiement en ligne requis.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/truck.svg') }}" alt="Image" class="img-fluid">
                                </div>
                                <h3>Retrait rapide à l’aéroport</h3>
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
                        <img src="{{ asset('assets/images/pexels-magda-ehlers-pexels-2861656_1_cropped.png') }}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Team Section -->
    {{-- <div class="untree_co-section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-5 mx-auto text-center">
                <h2 class="section-title">Our Team</h2>
            </div>
        </div>

        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                <img src="{{ asset('assets/images/person_1.jpg') }}" class="img-fluid mb-5" alt="Lawson Arnold">
                <h3><a href="#"><span class="">Lawson</span> Arnold</a></h3>
                <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                <p>Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
            </div> 
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
            <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                <img src="{{ asset('assets/images/person_2.jpg') }}" class="img-fluid mb-5" alt="Jeremy Walker">
                <h3><a href="#"><span class="">Jeremy</span> Walker</a></h3>
                <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                <p>Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
            </div> 
            <!-- End Column 2 -->

            <!-- Start Column 3 -->
            <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                <img src="{{ asset('assets/images/person_3.jpg') }}" class="img-fluid mb-5" alt="Patrik White">
                <h3><a href="#"><span class="">Patrik</span> White</a></h3>
                <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                <p>Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
            </div> 
            <!-- End Column 3 -->

            <!-- Start Column 4 -->
            <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                <img src="{{ asset('assets/images/person_4.jpg') }}" class="img-fluid mb-5" alt="Kathryn Ryan">
                <h3><a href="#"><span class="">Kathryn</span> Ryan</a></h3>
                <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                <p>Separated they live in. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
            </div> 
            <!-- End Column 4 -->

        </div>
    </div>
</div> --}}
    <!-- End Team Section -->

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
