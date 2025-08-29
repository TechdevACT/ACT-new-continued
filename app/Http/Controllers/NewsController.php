<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        $news = News::with('user', 'newsImages')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('News/Index', [
            'news' => $news,
            'filters' => [
                'search' => $search,
                'sortField' => $sortField,
                'sortDirection' => $sortDirection,
            ]
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug',
            'content' => 'required',
            'excerpt' => 'required',
        ]);

        $news = News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => 'published',
            'excerpt' => $request->excerpt
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/news', 'public');
            NewsImages::create([
                'news_id' => $news->id,
                'image' => '/storage/' . $path,
            ]);
        }

        return redirect()->route('blog.index');
    }

    public function show(News $blog)
    {
        $blog = News::with('user', 'newsImages')->where('slug', $blog->slug)->firstOrFail();

        return Inertia::render('DetailNews', [
            'data' => compact('blog'),
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(String $id, Request $request)
    {
        $news = News::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . $id,
            'content' => 'required',
            'excerpt' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $newsImage = NewsImages::where('news_id', $id)->first();

            if ($newsImage && $newsImage->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $newsImage->image));
            }

            $path = $request->file('image')->store('images/news', 'public');

            if ($newsImage) {
                $newsImage->update(['image' => '/storage/' . $path]);
            } else {
                NewsImages::create([
                    'news_id' => $id,
                    'image' => '/storage/' . $path,
                ]);
            }
        }

        $news->update($request->except('image'));

        return redirect()->route('blog.index')->with('success', 'News updated!');
    }

    public function destroy(String $id)
    {
        $news = News::findOrFail($id);
        $newsImage = $news->newsImages()->first();

        if ($newsImage && $newsImage->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $newsImage->image));
        }

        $news->delete();
        return back()->with('success', 'News deleted!');
    }
}

