<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'randomProduit']);

Route::get('/home', [ProductController::class, 'randomProduit'])->name('home');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/verify/{token}', [NewsletterController::class, 'verify'])->name('newsletter.verify');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/product/{id}', [ProductController::class, 'publicShow'])->name('product.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

// routes/web.php

Route::get('/about', function () {
    $testimonials = \App\Models\Testimonial::inRandomOrder()->limit(3)->get();

    return view('about', compact('testimonials'));
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Groupe admin protégé, préfixé et avec nommage
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::put('orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Site Infos - Routes personnalisées
    Route::controller(SiteInfoController::class)->prefix('site-infos')->name('site-infos.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/initialize', 'initializeDefaults')->name('initialize');
        Route::get('/{section}/edit', 'editSection')->name('edit-section');
        Route::put('/{section}', 'updateSection')->name('update-section');
    });
});

Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
