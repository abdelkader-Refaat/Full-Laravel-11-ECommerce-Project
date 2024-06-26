<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/// required route files /////////
// require __DIR__.'/auth.php';
// require __DIR__.'/admin.php';

Route::group(['prefix' => LaravelLocalization::setLocale(),
             'middleware' => ['localeSessionRedirect', 'localize']], function () {
     Route::controller(HomeController::class)->group(function () {
            Route::get('/',  'index')->name('front.index');
            Route::get('/products',  'products')->name('front.products');
            Route::get('/shops',  'shops')->name('front.shops');
            Route::get('/category',  'category')->name('front.category');
            Route::get('/category/{slug}',  'get_category_slug')->name('front.category_slug');
            Route::get('/category/product/{slug}',  'get_single_product_slug')->name('front.single_product');
            Route::get('/order',  'order')->name('front.order');
            Route::get('/stripe/{price}',  'stripe')->name('front.stripe');
            Route::post('/stripe/{price}',  'stripePost')->name('stripe.post');
            Route::post('/comment',  'comment')->name('comment');
            Route::get('/products/search',  'search')->name('products.search');
                });

    Route::View('/about', 'front.about');
    Route::View('/news', 'front.news')->name('front.news');
    Route::View('/contacts', 'front.contacts')->name('front.contacts');
    // Cart Route
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ############# social routes for login  ###########//
// Route::get('socialite/{driver}',[SocialLoginController::class,'toProvider'])->where('driver','google|github');
// // call back route
// Route::get('auth/{driver}/login',[SocialLoginController::class,'handleCallback'])->where('driver','google|github');

Route::get('/socialite/{driver}', [SocialLoginController::class, 'redirect'])
    ->where('driver', 'google|github')
    ->name('socialite.login');

Route::get('/socialite/{driver}/login', [SocialLoginController::class, 'callback'])->where('driver', 'google|github');

// ####### test  route ##########
Route::get('/test', [HomeController::class, 'test']);

Route::get('/mail', [MailController::class, 'sendMail']);

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
