<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSetting;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/auth/{provider}/delete/redirect', [SocialiteController::class, 'deleteRedirect'])
        ->name('auth.delete.redirect');
    Route::get('/auth/{provider}/delete/callback', [SocialiteController::class, 'deleteCallback'])
        ->name('auth.delete.callback');

    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/news', [PageController::class, 'news'])->name('news');
    Route::get('/news/detail', [PageController::class, 'newsDetail'])->name('newsDetail');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/', [SettingsController::class, 'heroUpdate'])->name('heroUpdate');
        Route::post('/about', [SettingsController::class, 'aboutUpdate'])->name('aboutUpdate');
        Route::post('/expertise', [SettingsController::class, 'expertiseUpdate'])->name('expertiseUpdate');
        Route::post('/bannerClient', [SettingsController::class, 'bannerClientUpdate'])->name('bannerClientUpdate');
        Route::post('/industry', [SettingsController::class, 'industryUpdate'])->name('industryUpdate');
        Route::post('/blog', [SettingsController::class, 'blogUpdate'])->name('blogUpdate');
        Route::post('/aboutPage', [SettingsController::class, 'aboutPageUpdate'])->name('aboutPageUpdate');
    });

    Route::resource('blog', NewsController::class);
    Route::resource('projectsSetting', ProjectSetting::class);
    Route::resource('projects', ProjectController::class);
    Route::delete('/gallery/{projectGallery}', [ProjectSetting::class, 'deleteGalleryImage'])
    ->name('gallery.delete');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('auth.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('auth.callback');

Route::get('/auth/complete-registration', [SocialiteController::class, 'showCompleteRegistrationForm'])
    ->middleware('guest')
    ->name('auth.complete-registration');

Route::post('/auth/complete-registration', [SocialiteController::class, 'storeCompleteRegistration'])
    ->middleware('guest');

require __DIR__.'/auth.php';
