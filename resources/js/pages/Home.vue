<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    author: String,
});
</script>

<template>

    <Head title="Accueil" />
    <h1>Bonjour, je suis {{ author }}</h1>
</template>
