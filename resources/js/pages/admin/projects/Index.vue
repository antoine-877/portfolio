<script setup>
import { Form, Head, Link } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Spinner } from "@/components/ui/spinner";
import ProjectController from "@/actions/App/Http/Controllers/Admin/ProjectController";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { create, edit, index } from "@/routes/admin/projects";

defineOptions({
    layout: {
        breadcrumbs: [{ title: "Projets", href: index() }],
    },
});

defineProps({
    projects: Array,
});
</script>

<template>
    <Head title="Projets" />

    <div class="space-y-4 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Projets</h1>
            <Button as-child>
                <Link :href="create()">Nouveau projet</Link>
            </Button>
        </div>

        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Titre</TableHead>
                    <TableHead>Adresse</TableHead>
                    <TableHead>Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="project in projects" :key="project.id">
                    <TableCell class="font-medium">{{
                        project.title
                    }}</TableCell>
                    <TableCell>/projets/{{ project.slug }}</TableCell>
                    <TableCell>
                        <div class="flex items-center gap-2">
                            <!-- Modification -->
                            <Button as-child variant="outline" size="sm">
                                <Link :href="edit(project).url">
                                    Modifier
                                </Link>
                            </Button>

                            <!-- Suppression -->
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button variant="destructive" size="sm">
                                        Supprimer
                                    </Button>
                                </DialogTrigger>

                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>
                                            Supprimer le projet ?
                                        </DialogTitle>

                                        <DialogDescription>
                                            Voulez-vous vraiment supprimer le
                                            projet « {{ project.title }} » ?
                                            Cette action est irréversible.
                                        </DialogDescription>
                                    </DialogHeader>

                                    <Form
                                        v-bind="
                                            ProjectController.destroy.form(
                                                project,
                                            )
                                        "
                                        v-slot="{ processing }"
                                    >
                                        <DialogFooter>
                                            <DialogClose as-child>
                                                <Button
                                                    variant="outline"
                                                    type="button"
                                                >
                                                    Annuler
                                                </Button>
                                            </DialogClose>

                                            <Button
                                                type="submit"
                                                variant="destructive"
                                                :disabled="processing"
                                            >
                                                <Spinner v-if="processing" />
                                                Confirmer la suppression
                                            </Button>
                                        </DialogFooter>
                                    </Form>
                                </DialogContent>
                            </Dialog>
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
