<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::published()
            ->with('tags')
            ->orderBy('position')
            ->get()
            ->map(fn(Project $project) => [
                'title' => $project->title,
                'slug' => $project->slug,
                'summary' => $project->summary,
                'cover_url' => $project->cover_url,

                'tags' => $project->tags->pluck('name'),
            ]);

        return Inertia::render('projects/Index', [
            'projects' => $projects,
        ]);
    }

    public function show(Project $project): Response
    {
        abort_if($project->published_at === null, 404);

        $project->load('tags');

        return Inertia::render('projects/Show', [
            'project' => [
                ...$project->only(
                    'title',
                    'slug',
                    'summary',
                    'content',
                    'demo_url',
                    'repo_url'
                ),
                'cover_url' => $project->cover_url,
                'tags' => $project->tags->pluck('name'),
            ],
        ]);
    }
}
