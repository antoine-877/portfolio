<script setup>
import {
    Bold,
    Code,
    Heading2,
    Heading3,
    Italic,
    Link,
    List,
    ListOrdered,
} from "@lucide/vue";
import StarterKit from "@tiptap/starter-kit";
import { EditorContent, useEditor } from "@tiptap/vue-3";
import { onBeforeUnmount, ref } from "vue";
import { Button } from "@/components/ui/button";

const props = defineProps({
    name: { type: String, required: true },
    defaultValue: { type: String, default: "" },
    label: { type: String, default: "Contenu" },
});

// Le HTML de l'éditeur, recopié dans le champ caché que <Form> envoie.
const html = ref(props.defaultValue ?? "");

const editor = useEditor({
    content: props.defaultValue ?? "",
    extensions: [
        StarterKit.configure({
            heading: { levels: [2, 3] },
            strike: false,
            underline: false,
            horizontalRule: false,
            trailingNode: false,
            link: { openOnClick: false, defaultProtocol: "https" },
        }),
    ],
    editorProps: {
        attributes: {
            role: "textbox",
            "aria-multiline": "true",
            "aria-label": props.label,
            class: "prose prose-sm max-w-none min-h-48 px-3 py-2 focus:outline-none dark:prose-invert",
        },
    },
    onUpdate: ({ editor }) => {
        html.value = editor.isEmpty ? "" : editor.getHTML();
    },
});

onBeforeUnmount(() => editor.value?.destroy());

function setLink() {
    const previous = editor.value.getAttributes("link").href ?? "";
    const url = window.prompt("Adresse du lien", previous);

    if (url === null) {
        return;
    }

    if (url === "") {
        editor.value.chain().focus().unsetLink().run();

        return;
    }

    editor.value.chain().focus().setLink({ href: url }).run();
}

const buttons = [
    {
        label: "Titre 2",
        icon: Heading2,
        active: () => editor.value.isActive("heading", { level: 2 }),
        run: () =>
            editor.value.chain().focus().toggleHeading({ level: 2 }).run(),
    },
    {
        label: "Titre 3",
        icon: Heading3,
        active: () => editor.value.isActive("heading", { level: 3 }),
        run: () =>
            editor.value.chain().focus().toggleHeading({ level: 3 }).run(),
    },
    {
        label: "Gras",
        icon: Bold,
        active: () => editor.value.isActive("bold"),
        run: () => editor.value.chain().focus().toggleBold().run(),
    },
    {
        label: "Italique",
        icon: Italic,
        active: () => editor.value.isActive("italic"),
        run: () => editor.value.chain().focus().toggleItalic().run(),
    },
    {
        label: "Liste à puces",
        icon: List,
        active: () => editor.value.isActive("bulletList"),
        run: () => editor.value.chain().focus().toggleBulletList().run(),
    },
    {
        label: "Liste numérotée",
        icon: ListOrdered,
        active: () => editor.value.isActive("orderedList"),
        run: () => editor.value.chain().focus().toggleOrderedList().run(),
    },
    {
        label: "Lien",
        icon: Link,
        active: () => editor.value.isActive("link"),
        run: setLink,
    },
    {
        label: "Bloc de code",
        icon: Code,
        active: () => editor.value.isActive("codeBlock"),
        run: () => editor.value.chain().focus().toggleCodeBlock().run(),
    },
];
</script>

<template>
    <div
        class="rounded-md border border-input shadow-xs focus-within:border-ring focus-within:ring-[3px] focus-within:ring-ring/50"
    >
        <div
            v-if="editor"
            class="flex flex-wrap gap-1 border-b border-input p-1"
        >
            <Button
                v-for="button in buttons"
                :key="button.label"
                type="button"
                variant="ghost"
                size="icon-sm"
                :title="button.label"
                :aria-label="button.label"
                :aria-pressed="button.active()"
                :class="{ 'bg-accent': button.active() }"
                @click="button.run"
            >
                <component :is="button.icon" />
            </Button>
        </div>

        <EditorContent :editor="editor" />

        <input type="hidden" :name="name" :value="html" />
    </div>
</template>
