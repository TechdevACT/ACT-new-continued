<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProjects = Project::with('category:id,name')
        ->select('id', 'title', 'slug', 'thumbnail', 'category_id')
        ->get()
        ->map(function ($project) {
            return [
                'title' => $project->title,
                'slug' => $project->slug,
                'image' => $project->thumbnail,
                'type' => $project->category->name ?? null,
            ];
        });

        $allCategory = ProjectCategory::all(['name'])->toArray();

        return Inertia::render('Projects', [
            'data' => compact('allProjects', 'allCategory'),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = Project::with('category', 'projectGalleries')->where('slug', $project->slug)->firstOrFail();

        return Inertia::render('DetailProject', [
            'data' => compact('project'),
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
