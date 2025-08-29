<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $allProjects = Project::with('category:id,name')
            ->select('id', 'title', 'slug', 'thumbnail', 'category_id')
            ->orderBy('created_at', 'desc')
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

    public function show(Project $project)
    {
        $project = Project::with('category', 'projectGalleries')->where('slug', $project->slug)->firstOrFail();

        return Inertia::render('DetailProject', [
            'data' => compact('project'),
        ]);
    }
}

