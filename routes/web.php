<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectSetting;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialiteController;
use App\Models\News;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {

    $counts = [
        'projects' => Project::count(),
        'news' => News::count(),
        'testimonials' => Testimonial::count(),
        'services' => 4,
    ];

    $recentProjects = Project::with('category')
                        ->latest()
                        ->take(5)
                        ->get()
                        ->map(function ($project) {
                            return [
                                'id' => $project->id,
                                'title' => $project->title,
                                'category' => $project->category->name ?? '-',
                                'status' => 'Published',
                                'date' => $project->created_at->diffForHumans(),
                            ];
                        });

    return Inertia::render('Dashboard',[
        'count' => $counts,
        'recent' => $recentProjects,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/symlink', function () {
    Artisan::call('storage:link');
});

Route::get('/fix-symlink-permanent', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = public_path('storage');

    echo "<h1>Perbaikan Symlink</h1>";

    // 1. Bersihkan jalur lama (Hapus folder/link yang salah)
    if (file_exists($linkFolder)) {
        if (is_link($linkFolder)) {
            unlink($linkFolder);
            echo "ink lama yang rusak sudah dibuang.<br>";
        } else {
            // Jika ternyata itu folder asli (bukan link), kita rename biar aman
            rename($linkFolder, public_path('storage_backup_'.rand()));
            echo "Folder 'public/storage' penghalang sudah dipinggirkan (di-rename).<br>";
        }
    } else {
        echo "Tidak ditemukan link/folder lama (Aman).<br>";
    }

    // 2. Bangun Jembatan Baru
    try {
        symlink($targetFolder, $linkFolder);
        echo "<b>SUKSES!</b> Symlink baru telah dibuat.<br>";
        echo "Target Gudang: " . $targetFolder . "<br>";
        echo "Link Etalase: " . $linkFolder . "<br>";
        echo "<br>Sekarang coba upload gambar baru, pasti langsung muncul!";
    } catch (\Exception $e) {
        echo "GAGAL: " . $e->getMessage();
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/auth/{provider}/delete/redirect', [SocialiteController::class, 'deleteRedirect'])
        ->name('auth.delete.redirect');
    Route::get('/auth/{provider}/delete/callback', [SocialiteController::class, 'deleteCallback'])
        ->name('auth.delete.callback');

    // Route::get('/', [PageController::class, 'home'])->name('home');
    // Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    // Route::get('/about', [PageController::class, 'about'])->name('about');
    // Route::get('/services', [PageController::class, 'services'])->name('services');
    // Route::get('/news', [PageController::class, 'news'])->name('news');
    // Route::get('/news/detail', [PageController::class, 'newsDetail'])->name('newsDetail');
    // Route::get('/shop', [PageController::class, 'shop'])->name('shop');
    // Route::get('/shop/detail', [PageController::class, 'shopDetail'])->name('shopDetail');

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

    Route::get('/blog', [NewsController::class, 'index'])->name('blog.index');
    Route::resource('blog', NewsController::class)->except(['show', 'index']);
    Route::resource('projectsSetting', ProjectSetting::class);
    // Route::resource('projects', ProjectController::class);
    Route::resource('testimonials', \App\Http\Controllers\TestimonialController::class)->only(['store', 'update', 'destroy']);
    Route::delete('/gallery/{projectGallery}', [ProjectSetting::class, 'deleteGalleryImage'])
    ->name('gallery.delete');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/detail', [PageController::class, 'newsDetail'])->name('newsDetail');
Route::get('/blog/{blog}', [NewsController::class, 'show'])->name('blog.show');
Route::resource('projects', ProjectController::class)->only(['index','show']);

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
