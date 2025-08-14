<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsImages;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        $news = News::with('user')
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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'content' => 'required',
        ]);

        News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => 'published',
            'excerpt' => $request->excerpt ?? $request->title
        ]);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $blog)
    {
        $blog = News::where('slug', $blog->slug)->firstOrFail();

        return Inertia::render('DetailNews', [
            'data' => compact('blog'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(String $id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . $id,
            'content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return redirect()->route('blog.index')->with('success', 'News updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return back()->with('success', 'News deleted!');
    }
}
