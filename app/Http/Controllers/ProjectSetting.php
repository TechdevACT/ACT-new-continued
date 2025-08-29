<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectSetting extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(9);
        return Inertia::render('Projects/Index', ['projects' => $projects]);
    }

    public function create()
    {
        $projectCategeory = ProjectCategory::all();
        return Inertia::render('Projects/Create', ['categories' => $projectCategeory]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:projects',
            'project_overview' => 'required|string',
            'project_challenges' => 'required|string',
            'project_objectives' => 'required|string',
            'project_final_outcome' => 'required|string',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galleries.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $project = Project::create($validated);

        if ($request->hasFile('background')) {
            $backgroundPath = $request->file('background')->store('projects/backgrounds', 'public');
            $project->background = $backgroundPath;
            $project->save();
        }

        if ($request->hasFile('galleries')) {
            foreach ($request->file('galleries') as $image) {
                $imagePath = $image->store('projects/galleries', 'public');
                $project->projectGalleries()->create(['image' => $imagePath]);
            }
        }

        return redirect()->route('projectsSetting.index')->with('success', 'Project created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $projectCategeory = ProjectCategory::all();
        $project->load('projectGalleries');
        return Inertia::render('Projects/Edit', ['project' => $project, 'categories' => $projectCategeory]);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => [
                'required',
                'string',
                Rule::unique('projects')->ignore($project->id),
            ],
            'project_overview' => 'required|string',
            'project_challenges' => 'required|string',
            'project_objectives' => 'required|string',
            'project_final_outcome' => 'required|string',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galleries.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        if ($request->hasFile('background')) {
            if ($project->background) {
                Storage::disk('public')->delete($project->background);
            }
            $backgroundPath = $request->file('background')->store('projects/backgrounds', 'public');
            $validated['background'] = $backgroundPath;
        }

        $project->update(array_merge($validated, [
            'thumbnail' => $validated['thumbnail'] ?? $project->thumbnail,
            'background' => $validated['background'] ?? $project->background
        ]));

        if ($request->hasFile('galleries')) {
            foreach ($request->file('galleries') as $image) {
                $imagePath = $image->store('projects/galleries', 'public');
                $project->projectGalleries()->create(['image' => $imagePath]);
            }
        }

        return redirect()->route('projectsSetting.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        foreach ($project->projectGalleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->delete();
        }
        $project->delete();
        return back()->with('success', 'Project deleted!');
    }

    public function deleteGalleryImage(String $id)
    {
        $projectGallery = ProjectGallery::findOrFail($id);

        Storage::disk('public')->delete($projectGallery->image);

        $projectGallery->delete();

        return back()->with('success', 'Gallery image deleted successfully.');
    }
}
