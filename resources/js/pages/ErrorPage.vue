<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { home } from '@/routes';

const props = defineProps({
    status: Number,
});

const title = computed(() =>
    props.status === 404 ? 'Page introuvable' : 'Accès refusé',
);

const message = computed(() =>
    props.status === 404
        ? "Cette page n'existe pas ou n'est plus en ligne."
        : "Vous n'avez pas accès à cette page.",
);
</script>

<template>

    <Head :title="title" />

    <section>
        <h1>{{ status }} · {{ title }}</h1>

        <p>{{ message }}</p>

        <Link :href="home()">Retour à l'accueil</Link>
    </section>
</template>
