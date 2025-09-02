<?php

// these routes for guests
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\OpenCloseWebsite;
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SlugController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\SendNewLetterController;
use App\Http\Controllers\Api\AuthenticationController;

Route::middleware([LanguageMiddleware::class, OpenCloseWebsite::class])->group(function () {
    // these routes for guests only
    Route::middleware(['guest'])->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::post('send-otp', 'sendOtp');
            Route::post('verify-otp', 'verifyOtp');
            Route::post('refresh-token', 'refreshToken');
            Route::post('reset-password', 'resetPassword');
        });
    });

    // these routes for authenticated users only
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticationController::class, 'logout']);
        Route::post('change-password', [AuthenticationController::class, 'changePassword']);

        Route::get('profile', [ProfileController::class, 'index']);
        Route::post('update-profile', [ProfileController::class, 'updateProfile']);
        Route::post('update-avatar', [ProfileController::class, 'updateAvatar']);

        Route::post('testimonial', [TestimonialController::class, 'create']);
    });

    // these routes for all users
    Route::post('check-mobile', [AuthenticationController::class, 'checkMobileExists']);
    Route::get('get-testimonial', [TestimonialController::class, 'index']);

    Route::post('send-new-letter', [SendNewLetterController::class, 'sendEmail']);
    Route::post('contact-us', [ContactController::class, 'contact']);

    Route::controller(GeneralController::class)->group(function () {
        Route::get('social-media', 'socialMedia');
        Route::get('country', 'getCountries');
        Route::get('city', 'getCities');
        Route::get('country/{id}', 'getCitiesByCountryId');
        Route::get('site-setting', 'siteSetting');
    });

    Route::controller(CategoryController::class)->group(function () {
//        Route::get('products-of-category/{slug}', 'productWithCategory');
//        Route::get('category/{type}', 'categoriesByType');
        Route::get('category', 'index');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('pages', 'pages');
        Route::get('posts', 'posts');
        Route::get('posts/{slug}', 'getPostBySlug');
        Route::get('pages/slug/{slug}', 'getPageBySlug');
        Route::get('pages/{id}', 'getPageById');
    });

//    Route::controller(SlugController::class)->group(function () {
//        Route::get('slug-products', 'slugProduct');
//        Route::get('slug-pages', 'getPageBySlug');
//        Route::get('slug-blogs', 'slugBlog');
//        Route::get('slug-category', 'slugCategory');
//    });

});
