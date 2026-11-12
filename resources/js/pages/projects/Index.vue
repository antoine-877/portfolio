<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { show } from "@/routes/projects";

defineProps({
    projects: Array,
});
</script>

<template>
    <Head title="project" />
    <h1>Mes project</h1>

    <ul>
        <li v-for="project in projects" :key="project.slug">
            <img
                v-if="project.cover_url"
                :src="project.cover_url"
                alt=""
                width="300"
            />

            <h2>{{ project.title }}</h2>
            <p>{{ project.summary }}</p>

            <Link :href="show(project)"> Voir le projet </Link>
        </li>
    </ul>
</template>
