<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::with('tags')
            ->orderBy('position')
            ->get()
            ->map(fn(Project $project) => [
                'title' => $project->title,
                'slug' => $project->slug,
                'summary' => $project->summary,
                'cover_url' => $project->cover_path
                    ? Storage::disk('public')->url($project->cover_path)
                    : null,
                'tags' => $project->tags->pluck('name'),
            ]);

        return Inertia::render('projects/Index', [
            'projects' => $projects,
        ]);
    }
}
