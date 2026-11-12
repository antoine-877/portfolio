<script setup>
import { Link } from "@inertiajs/vue3";
import { about, contact, home } from "@/routes";
import { index as projectsIndex } from "@/routes/projects";
</script>

<template>
    <div class="mx-auto max-w-4xl px-4">
        <header class="flex items-center justify-between py-6">
            <Link :href="home()" class="font-semibold"> Antoine Mertens </Link>

            <nav class="flex gap-4">
                <Link :href="projectsIndex()">project</Link>
                <Link :href="about()">À propos</Link>
                <Link :href="contact()">Contact</Link>
            </nav>
        </header>

        <main>
            <slot />
        </main>

        <footer class="py-6 text-sm">
            © Antoine Mertens {{ new Date().getFullYear() }}. Tous droits
            réservés.
        </footer>
    </div>
</template>
