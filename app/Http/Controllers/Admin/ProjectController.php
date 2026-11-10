<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/projects/Index', [
            'projects' => Project::orderBy('position')
                ->get(['id', 'title', 'slug']),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/projects/Create', [
            'tags' => Tag::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {

        $project = Project::create([
            ...$request->safe()->except('tags'),
            'position' => Project::max('position') + 1,
        ]);

        $project->tags()->sync($request->validated('tags', []));

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Projet créé.']);

        return to_route('admin.projects.index');
    }


    public function edit(Project $project): Response
    {
        return Inertia::render('admin/projects/Edit', [
            'project' => [
                'id' => $project->id,
                'title' => $project->title,
                'summary' => $project->summary,
                'content' => $project->content,
                'demo_url' => $project->demo_url,
                'repo_url' => $project->repo_url,
                'tags' => $project->tags()->pluck('tags.id'),
            ],
            'tags' => Tag::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(
        ProjectRequest $request,
        Project $project
    ): RedirectResponse {
        $project->update(
            $request->safe()->except('tags')
        );

        $project->tags()->sync(
            $request->validated('tags', [])
        );

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Projet modifié.',
        ]);

        return to_route('admin.projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Projet supprimé.',
        ]);

        return to_route('admin.projects.index');
    }
}
