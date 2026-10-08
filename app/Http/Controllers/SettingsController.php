<?php

namespace App\Http\Controllers;

use App\Models\AboutOption;
use App\Models\FrontEnd;
use App\Models\ImageFrontEnd;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // Impor fasad Storage
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $data_fe = FrontEnd::all();
        $data_about = AboutOption::all();
        $hero_image = ImageFrontEnd::where('type', 'hero')->orderBy('sort_order')->take(5)->get('path');
        $industry_image = ImageFrontEnd::where('type', 'industry')->orderBy('sort_order')->take(6)->get('path');
        $clients_image = ImageFrontEnd::where('type', 'clients')->orderBy('sort_order')->take(6)->get('path');
        $banner_image = ImageFrontEnd::where('type', 'bannerHome')->take(1)->get('path');
        $contact_image = ImageFrontEnd::where('type', 'contactImage')->first();
        $banner_about_image = ImageFrontEnd::where('type', 'bannerAbout')->first();
        $testimonials = Testimonial::all();
        $services = \App\Models\Service::all();
        return Inertia::render(
            'Settings/Settings',
            [
                'data_fe' => compact('data_fe', 'data_about', 'hero_image', 'industry_image', 'clients_image', 'banner_image', 'contact_image', 'banner_about_image'),
                'testimonials' => $testimonials,
                'services' => $services,
            ]
        );
    }

    public function heroUpdate(Request $request)
    {
        $data_hero = FrontEnd::where('id', 1)->first();

        $request->validate([
            'title1'      => 'required',
            'title2'      => 'required',
            'description' => 'required',
        ]);

        // PHP multipart memisahkan string dan file ke bucket berbeda.
        // Kita merge keduanya kembali berdasarkan index.
        $stringImages = $request->input('images', []);   // ['0' => '/storage/...', '2' => '/storage/...']
        $fileImages   = $request->file('images', []);    // ['1' => UploadedFile, ...]

        // Tentukan jumlah total slot (index tertinggi + 1)
        $allIndexes = array_merge(array_keys($stringImages), array_keys($fileImages));
        if (empty($allIndexes)) {
            // Tidak ada gambar sama sekali — hapus semua
            $oldImages = ImageFrontEnd::where('type', 'hero')->get();
            foreach ($oldImages as $old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
        } else {
            $maxIndex = max($allIndexes);

            // Kumpulkan path yang masih dipertahankan (string)
            $keptPaths = array_values($stringImages);

            // Hapus dari DB + storage hanya gambar yang sudah tidak ada di list
            $oldImages = ImageFrontEnd::where('type', 'hero')->get();
            foreach ($oldImages as $old) {
                if (!in_array($old->path, $keptPaths)) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                    $old->delete();
                }
            }

            // Proses setiap slot berdasarkan index untuk sort_order
            for ($i = 0; $i <= $maxIndex; $i++) {
                if (isset($stringImages[$i])) {
                    // Gambar lama: update sort_order-nya
                    ImageFrontEnd::where('type', 'hero')
                        ->where('path', $stringImages[$i])
                        ->update(['sort_order' => $i]);
                } elseif (isset($fileImages[$i])) {
                    // Gambar baru: upload dan simpan
                    $path = $fileImages[$i]->store('images/frontEnd', 'public');
                    ImageFrontEnd::create([
                        'type'       => 'hero',
                        'path'       => '/storage/' . $path,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        $data_hero->update([
            'hero_title'       => $request->title1,
            'hero_title2'      => $request->title2,
            'hero_description' => $request->description,
        ]);

        Cache::forget('home.data_fe');

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

        Cache::forget('home.data_fe');

        return redirect()->back();
    }

    public function bannerClientUpdate(Request $request)
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('banner')) {
                $oldBanner = ImageFrontEnd::where('type', 'bannerHome')->first();
                if ($oldBanner) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $oldBanner->path));
                    $oldBanner->delete();
                }

                $image = $request->file('banner')[0];
                $path = $image->store('images/frontEnd', 'public');

                ImageFrontEnd::create([
                    'type' => 'bannerHome',
                    'path' => '/storage/' . $path,
                ]);
            }

            if ($request->hasFile('images')) {
                $oldImages = ImageFrontEnd::where('type', 'clients')->get();
                foreach ($oldImages as $image) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $image->path));
                    $image->delete();
                }

                foreach ($request->file('images') as $image) {
                    $path = $image->store('images/clients', 'public');

                    ImageFrontEnd::create([
                        'type' => 'clients',
                        'path' => '/storage/' . $path,
                    ]);
                }
            }

            DB::commit();
            Cache::forget('home.data_fe');
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

        Cache::forget('home.data_fe');

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

        $stringImages = $request->input('images', []);
        $fileImages   = $request->file('images', []);

        $allIndexes = array_merge(array_keys($stringImages), array_keys($fileImages));
        if (empty($allIndexes)) {
            $oldImages = ImageFrontEnd::where('type', 'industry')->get();
            foreach ($oldImages as $old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
        } else {
            $maxIndex = max($allIndexes);
            $keptPaths = array_values($stringImages);

            $oldImages = ImageFrontEnd::where('type', 'industry')->get();
            foreach ($oldImages as $old) {
                if (!in_array($old->path, $keptPaths)) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                    $old->delete();
                }
            }

            for ($i = 0; $i <= $maxIndex; $i++) {
                if (isset($stringImages[$i])) {
                    ImageFrontEnd::where('type', 'industry')
                        ->where('path', $stringImages[$i])
                        ->update(['sort_order' => $i]);
                } elseif (isset($fileImages[$i])) {
                    $path = $fileImages[$i]->store('images/frontEnd', 'public');
                    ImageFrontEnd::create([
                        'type'       => 'industry',
                        'path'       => '/storage/' . $path,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        $data_hero->update([
            'industry_title' => $request->title,
            'industry_heading' => $request->heading,
            'industry_description' => $request->description
        ]);

        Cache::forget('home.data_fe');

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

        Cache::forget('home.data_fe');

        return redirect()->back();
    }

    public function aboutPageUpdate(Request $request)
    {
        $request->validate([
            'headingbig1'          => 'required',
            'headingbig2'          => 'required',
            'heading'              => 'required',
            'description'         => 'required',
            'approach_title'      => 'required',
            'approach_heading'    => 'required',
            'approach_description'=> 'required',
            'expertise_title'     => 'required',
            'emphasis_title'      => 'required',
            'emphasis_heading'    => 'required',
            'emphasis_description'=> 'required',
        ]);

        $data_about = AboutOption::where('id', 1)->first();

        $data_about->update([
            'heading_big'          => $request->headingbig1,
            'heading_big2'         => $request->headingbig2,
            'heading'              => $request->heading,
            'description'         => $request->description,
            'approach_title'      => $request->approach_title,
            'approach_heading'    => $request->approach_heading,
            'approach_description'=> $request->approach_description,
            'expertise_title'     => $request->expertise_title,
            'emphasis_title'      => $request->emphasis_title,
            'emphasis_heading'    => $request->emphasis_heading,
            'emphasis_description'=> $request->emphasis_description,
        ]);

        return redirect()->back();
    }

    /**
     * Update gambar pada halaman Contact.
     */
    public function contactUpdate(Request $request)
    {
        if ($request->hasFile('image')) {
            $old = ImageFrontEnd::where('type', 'contactImage')->first();
            if ($old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
            $path = $request->file('image')->store('images/frontEnd', 'public');
            ImageFrontEnd::create([
                'type' => 'contactImage',
                'path' => '/storage/' . $path,
            ]);
        } elseif ($request->input('remove_image') === 'true') {
            $old = ImageFrontEnd::where('type', 'contactImage')->first();
            if ($old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
        }

        Cache::forget('home.data_fe');

        return redirect()->back();
    }

    /**
     * Update banner gambar About di halaman Home.
     */
    public function bannerAboutUpdate(Request $request)
    {
        if ($request->hasFile('image')) {
            $old = ImageFrontEnd::where('type', 'bannerAbout')->first();
            if ($old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
            $path = $request->file('image')->store('images/frontEnd', 'public');
            ImageFrontEnd::create([
                'type' => 'bannerAbout',
                'path' => '/storage/' . $path,
            ]);
        } elseif ($request->input('remove_image') === 'true') {
            $old = ImageFrontEnd::where('type', 'bannerAbout')->first();
            if ($old) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $old->path));
                $old->delete();
            }
        }

        Cache::forget('home.data_fe');

        return redirect()->back();
    }
}
