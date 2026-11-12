<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;


class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/projects/Index', [
            'projects' => Project::orderBy('position')
                ->get(['id', 'title', 'slug', 'published_at']),
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
        $data = $request->safe()->except(['tags', 'cover']);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('projects', 'public');
        }

        $project = Project::create([
            ...$data,
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
                'cover_url' => $project->cover_url,
            ],
            'tags' => Tag::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->safe()->except(['tags', 'cover']);

        if ($request->hasFile('cover')) {
            if ($project->cover_path && str_starts_with($project->cover_path, 'projects/')) {
                Storage::disk('public')->delete($project->cover_path);
            }

            $data['cover_path'] = $request->file('cover')->store('projects', 'public');
        }

        $project->update($data);

        // sync des tags, flash et redirection : inchangés

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
        if ($project->cover_path && str_starts_with($project->cover_path, 'projects/')) {
            Storage::disk('public')->delete($project->cover_path);
        }

        $project->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Projet supprimé.',
        ]);

        return to_route('admin.projects.index');
    }

    public function togglePublished(Project $project): RedirectResponse
    {
        $project->update([
            'published_at' => $project->published_at ? null : now(),
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => $project->published_at ? 'Projet publié.' : 'Projet repassé en brouillon.',
        ]);

        return to_route('admin.projects.index');
    }

    public function moveUp(Project $project): RedirectResponse
    {
        $previous = Project::where('position', '<', $project->position)
            ->orderByDesc('position')
            ->first();

        if ($previous) {
            $this->swapPositions($project, $previous);
        }

        return to_route('admin.projects.index');
    }

    public function moveDown(Project $project): RedirectResponse
    {
        $previous = Project::where('position', '>', $project->position)
            ->orderBy('position')
            ->first();

        if ($previous) {
            $this->swapPositions($project, $previous);
        }

        return to_route('admin.projects.index');
    }

    private function swapPositions(Project $first, Project $second): void
    {
        [$first->position, $second->position] = [$second->position, $first->position];

        $first->save();
        $second->save();
    }
}
