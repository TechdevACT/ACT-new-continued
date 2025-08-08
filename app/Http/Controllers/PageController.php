<?php

namespace App\Http\Controllers;

use App\Models\AboutOption;
use App\Models\FrontEnd;
use App\Models\ImageFrontEnd;
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

        return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'data_fe' => compact('data_fe', 'hero_image', 'industry_image', 'clients_image', 'banner_image'),
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
}
