<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects', [
            'projects' => Project::query()->with('images')->latest()->get(),
        ]);
    }

    public function show(Project $project)
    {
        $project->load('images');

        return view('project-details', [
            'project' => $project,
        ]);
    }
}
