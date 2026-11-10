
<script setup>
import { Form, Head } from '@inertiajs/vue3';
import ProjectController from '@/actions/App/Http/Controllers/Admin/ProjectController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
import { edit, index } from '@/routes/admin/projects';

defineOptions({
    layout: (pageProps) => ({
        breadcrumbs: [
            { title: 'Projets', href: index() },
            {
                title: pageProps.project.title,
                href: edit(pageProps.project),
            },
        ],
    }),
});

defineProps({
    project: Object,
    tags: Array,
});
</script>

<template>
    <Head :title="`Modifier ${project.title}`" />

    <div class="max-w-2xl p-4">
        <h1 class="mb-6 text-xl font-semibold">
            Modifier le projet
        </h1>

        <Form
            v-bind="ProjectController.update.form(project)"
            v-slot="{ errors, processing }"
            class="space-y-6"
            novalidate
        >
            <div class="grid gap-2">
                <Label for="title">Titre</Label>
                <Input
                    id="title"
                    name="title"
                    :default-value="project.title"
                />
                <InputError :message="errors.title || errors.slug" />
            </div>

            <div class="grid gap-2">
                <Label for="summary">Résumé</Label>
                <Textarea
                    id="summary"
                    name="summary"
                    rows="3"
                    :default-value="project.summary"
                />
                <InputError :message="errors.summary" />
            </div>

            <div class="grid gap-2">
                <Label for="demo_url">Lien de la démo</Label>
                <Input
                    id="demo_url"
                    name="demo_url"
                    type="url"
                    :default-value="project.demo_url"
                />
                <InputError :message="errors.demo_url" />
            </div>

            <div class="grid gap-2">
                <Label for="repo_url">Lien du code</Label>
                <Input
                    id="repo_url"
                    name="repo_url"
                    type="url"
                    :default-value="project.repo_url"
                />
                <InputError :message="errors.repo_url" />
            </div>

            <fieldset class="grid gap-2">
                <legend class="mb-2 text-sm font-medium">
                    Technologies
                </legend>

                <Label
                    v-for="tag in tags"
                    :key="tag.id"
                    class="flex items-center gap-3"
                >
                    <Checkbox
                        name="tags[]"
                        :value="String(tag.id)"
                        :default-value="project.tags.includes(tag.id)"
                    />
                    <span>{{ tag.name }}</span>
                </Label>

                <InputError :message="errors.tags" />
            </fieldset>

            <Button type="submit" :disabled="processing">
                <Spinner v-if="processing" />
                Enregistrer
            </Button>
        </Form>
    </div>
</template>
