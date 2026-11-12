<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->isMethod('POST')) {
            $this->merge([
                'slug' => Str::slug((string) $this->input('title')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => $this->isMethod('POST') ? [Rule::unique('projects', 'slug')] : ['prohibited'],
            'summary' => ['required', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], //2048 Ko//
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    public function messages(): array
    {
        return ['slug.unique' => 'Un projet porte déjà ce titre.'];
    }

    public function attributes(): array
    {
        return [
            'summary' => 'résumé',
            'demo_url' => 'lien de la démo',
            'repo_url' => 'lien du code',
            'cover' => 'image de couverture',
        ];
    }
}
