<?php

namespace App\Http\Controllers;

use App\Models\AboutOption;
use App\Models\FrontEnd;
use App\Models\ImageFrontEnd;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home(){
        $data_fe = FrontEnd::all();
        $hero_image = ImageFrontEnd::where('type', 'hero')->take(5)->get('path');
        $industry_image = ImageFrontEnd::where('type', 'industry')->take(5)->get('path');
        $clients_image = ImageFrontEnd::where('type', 'clients')->take(5)->get('path');
        $banner_image = ImageFrontEnd::where('type', 'bannerHome')->take(1)->get('path');
        $blog = News::with('newsImages')->where('status', 'published')->orderBy('created_at', 'desc')->take(3)->get();

        return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'data_fe' => compact('data_fe', 'hero_image', 'industry_image', 'clients_image', 'banner_image', 'blog'),
    ]);

    }
    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function about()
    {
        $data_about = AboutOption::where('id', 1)->first();
        return Inertia::render('About', [
            'data_about' => compact('data_about'),
        ]);
    }

    public function services()
    {
        return Inertia::render('Services');
    }

    public function news(Request $request)
    {
        $categorySlug = $request->get('category');

        $news_all = News::with('newsImages', 'category')
        ->where( 'status', 'published')
        ->when($categorySlug, function ($query) use ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(4)
        ->withQueryString();

        $categories = NewsCategory::withCount(['news' => function ($query) {
            $query->where('status', 'published');
        }])
        ->having('news_count', '>', 0)
        ->orderBy('name')
        ->get();

        return Inertia::render('News',  [
            'data' => compact('news_all', 'categories'),
            'filter' => [
                'category' => $categorySlug,
            ]
        ]);
    }

    public function newsDetail()
    {
        return Inertia::render('DetailNews');
    }

    public function shop()
    {
        return Inertia::render('Shop');
    }

    public function shopDetail()
    {
        return Inertia::render('DetailShop');
    }
}
