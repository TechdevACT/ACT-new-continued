<?php

namespace App\Http\Controllers;

use App\Models\FrontEnd;
use App\Models\ImageFrontEnd;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $data_fe = FrontEnd::all();
        $hero_image = ImageFrontEnd::where('type', 'hero')->take(5)->get('path');
        $industry_image = ImageFrontEnd::where('type', 'industry')->take(5)->get('path');
        $clients_image = ImageFrontEnd::where('type', 'clients')->take(6)->get('path');
        $banner_image = ImageFrontEnd::where('type', 'bannerHome')->take(1)->get('path');
        return Inertia::render('Settings/Settings',
    [
        'data_fe' => compact('data_fe', 'hero_image', 'industry_image', 'clients_image', 'banner_image'),
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
        DB::beginTransaction();

        try {
            if ($request->hasFile('banner')) {
                $oldBanner = ImageFrontEnd::where('type', 'bannerHome')->first();
                if ($oldBanner) {
                    $filePath = public_path($oldBanner->path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $oldBanner->delete();
                }

                $image = $request->file('banner')[0];
                $imageName = $image->hashName();
                $image->move(public_path('images/frontEnd'), $imageName);

                ImageFrontEnd::create([
                    'type' => 'bannerHome',
                    'path' => '/images/frontEnd/' . $imageName,
                ]);
            }

            if ($request->hasFile('images')) {
                $oldImages = ImageFrontEnd::where('type', 'clients')->get();
                foreach ($oldImages as $image) {
                    $filePath = public_path($image->path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $image->delete();
                }

                foreach ($request->file('images') as $image) {
                    $imageName = $image->hashName();
                    $image->move(public_path('images/clients'), $imageName);

                    ImageFrontEnd::create([
                        'type' => 'clients',
                        'path' => '/images/clients/' . $imageName,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat mengupdate data',
            ]);
        }
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
