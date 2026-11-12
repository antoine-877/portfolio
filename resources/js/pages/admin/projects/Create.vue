<script setup>
import { Form, Head } from "@inertiajs/vue3";
import ProjectController from "@/actions/App/Http/Controllers/Admin/ProjectController";
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Spinner } from "@/components/ui/spinner";
import { Textarea } from "@/components/ui/textarea";
import { create, index } from "@/routes/admin/projects";
import RichTextEditor from "@/components/RichTextEditor.vue";
import { ref, onUnmounted } from "vue";

defineOptions({
    layout: {
        breadcrumbs: [
            { title: "project", href: index() },
            { title: "Nouveau projet", href: create() },
        ],
    },
});

const coverPreview = ref(null);

const handleCoverChange = (event) => {
    const file = event.target.files[0];

    if (coverPreview.value) {
        URL.revokeObjectURL(coverPreview.value);
    }

    coverPreview.value = file ? URL.createObjectURL(file) : null;
};

onUnmounted(() => {
    if (coverPreview.value) {
        URL.revokeObjectURL(coverPreview.value);
    }
});

defineProps({
    tags: Array,
});
</script>

<template>
    <Head title="Nouveau projet" />

    <div class="max-w-2xl p-4">
        <h1 class="mb-6 text-xl font-semibold">Nouveau projet</h1>

        <Form
            v-bind="ProjectController.store.form()"
            v-slot="{ errors, processing, progress }"
            class="space-y-6"
            novalidate
        >
            <!--Title-->
            <div class="grid gap-2">
                <Label for="title">Titre</Label>
                <Input id="title" name="title" />
                <InputError :message="errors.title || errors.slug" />
            </div>
            <!--Resume-->
            <div class="grid gap-2">
                <Label for="summary">Résumé</Label>
                <Textarea id="summary" name="summary" rows="3" />
                <InputError :message="errors.summary" />
            </div>
            <!--Contenu-->
            <div class="grid gap-2">
                <Label>Contenu</Label>
                <RichTextEditor name="content" label="Contenu du projet" />
                <InputError :message="errors.content" />
            </div>
            <!--Images-->
            <div class="grid gap-2">
                <Label for="cover">Image de couverture</Label>

                <!-- Aperçu de l'image sélectionnée -->
                <img
                    v-if="coverPreview"
                    :src="coverPreview"
                    alt="Aperçu de la couverture"
                    class="w-48 rounded"
                />

                <!-- Sélection de l'image -->
                <Input
                    id="cover"
                    name="cover"
                    type="file"
                    accept="image/*"
                    @change="handleCoverChange"
                />

                <!-- Progression de l'upload -->
                <progress
                    v-if="progress"
                    :value="progress.percentage"
                    max="100"
                    class="w-full"
                >
                    {{ progress.percentage }} %
                </progress>

                <InputError :message="errors.cover" />
            </div>
            <!--URL-->
            <div class="grid gap-2">
                <Label for="demo_url">Lien de la démo</Label>
                <Input id="demo_url" name="demo_url" type="url" />
                <InputError :message="errors.demo_url" />
            </div>
            <!--Lien GitHub-->
            <div class="grid gap-2">
                <Label for="repo_url">Lien du code</Label>
                <Input id="repo_url" name="repo_url" type="url" />
                <InputError :message="errors.repo_url" />
            </div>
            <!--Utilise-->
            <fieldset class="grid gap-2">
                <legend class="mb-2 text-sm font-medium">Technologies</legend>
                <Label
                    v-for="tag in tags"
                    :key="tag.id"
                    class="flex items-center gap-3"
                >
                    <Checkbox name="tags[]" :value="String(tag.id)" />
                    <span>{{ tag.name }}</span>
                </Label>
                <InputError :message="errors.tags" />
            </fieldset>

            <Button type="submit" :disabled="processing">
                <Spinner v-if="processing" />
                Créer le projet
            </Button>
        </Form>
    </div>
</template>
