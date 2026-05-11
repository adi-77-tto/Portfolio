<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'], // max 5MB
            'gallery_images.*' => ['nullable', 'image', 'max:5120'],
            'featured' => ['nullable', 'boolean'],
        ]);

        $projectData = collect($validated)->except(['image', 'gallery_images'])->all();
        $projectData['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $projectData['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::query()->create($projectData);

        if ($request->hasFile('gallery_images')) {
            $this->storeGalleryImages($project, $request->file('gallery_images'));
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'], // max 5MB
            'gallery_images.*' => ['nullable', 'image', 'max:5120'],
            'featured' => ['nullable', 'boolean'],
        ]);

        $projectData = collect($validated)->except(['image', 'gallery_images'])->all();
        $projectData['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $projectData['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($projectData);

        if ($request->hasFile('gallery_images')) {
            $this->storeGalleryImages($project, $request->file('gallery_images'));
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        foreach ($project->images as $galleryImage) {
            Storage::disk('public')->delete($galleryImage->image_path);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    private function storeGalleryImages(Project $project, array $images): void
    {
        $startingSortOrder = $project->images()->max('sort_order') ?? 0;

        foreach ($images as $index => $imageFile) {
            $path = $imageFile->store('projects/gallery', 'public');
            
            $project->images()->create([
                'image_path' => $path,
                'sort_order' => $startingSortOrder + $index + 1,
            ]);
        }
    }
}
