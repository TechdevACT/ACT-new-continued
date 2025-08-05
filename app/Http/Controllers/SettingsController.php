<?php

namespace App\Http\Controllers;

use App\Models\FrontEnd;
use App\Models\ImageFrontEnd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $data_fe = FrontEnd::all();
        $hero_image = ImageFrontEnd::where('type', 'hero')->take(5)->get('path');
        $industry_image = ImageFrontEnd::where('type', 'industry')->take(5)->get('path');
        return Inertia::render('Settings/Settings',
    [
        'data_fe' => compact('data_fe', 'hero_image', 'industry_image'),
    ]);
    }

    public function heroUpdate(Request $request)
    {
        $data_hero = FrontEnd::where('id', 1)->first();

        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('images')) {
            $data_hero_image = ImageFrontEnd::where('type', 'hero')->get();

            foreach ($data_hero_image as $image) {
                $filePath = public_path($image->path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }

            foreach ($request->file('images') as $image) {
                $imageName = $image->hashName();
                $image->move(public_path('images/frontEnd'), $imageName);
                ImageFrontEnd::create([
                    'type' => 'hero',
                    'path' => '/images/frontEnd/' . $imageName
                ]);
            }
        }


        $data_hero->update([
            'hero_title' => $request->title1,
            'hero_title2' => $request->title2,
            'hero_description' => $request->description
        ]);

        return redirect()->back();
    }

    public function aboutUpdate(Request $request)
    {
        $data_about = FrontEnd::where('id', 1)->first();

        $request->validate([
            'titleAbout' => 'required',
            'descriptionAbout' => 'required',
        ]);

        $data_about->update([
            'about_title' => $request->titleAbout,
            'about_description' => $request->descriptionAbout
        ]);

        return redirect()->back();
    }

    public function bannerClientUpdate(Request $request)
    {
        dd($request->all());
    }

    public function expertiseUpdate(Request $request)
    {
        $data_about = FrontEnd::where('id', 1)->first();

        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data_about->update([
            'expertise_title' => $request->title,
            'expertise_heading' => $request->heading,
            'expertise_description' => $request->description
        ]);

        return redirect()->back();
    }

    public function industryUpdate(Request $request)
    {
        $data_hero = FrontEnd::where('id', 1)->first();

        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('images')) {
            $data_hero_image = ImageFrontEnd::where('type', 'industry')->get();

            foreach ($data_hero_image as $image) {
                $filePath = public_path($image->path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }

            foreach ($request->file('images') as $image) {
                $imageName = $image->hashName();
                $image->move(public_path('images/frontEnd'), $imageName);
                ImageFrontEnd::create([
                    'type' => 'industry',
                    'path' => '/images/frontEnd/' . $imageName
                ]);
            }
        }


        $data_hero->update([
            'industry_title' => $request->title,
            'industry_heading' => $request->heading,
            'industry_description' => $request->description
        ]);

        return redirect()->back();
    }

    public function blogUpdate(Request $request)
    {
        $data_blog = FrontEnd::where('id', 1)->first();

        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        $data_blog->update([
            'blog_title' => $request->title,
            'blog_heading' => $request->heading,
            'blog_description' => $request->description
        ]);

        return redirect()->back();
    }
}
