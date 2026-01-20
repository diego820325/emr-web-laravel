<script setup lang="ts">
import { route } from 'ziggy-js';
import { Form, Link } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref } from 'vue';

defineProps<{ patient: Record<string, any> }>();

const notes = ref('');
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Nueva Nota</h1>
        <Form
            :action="route('patients.records.store', patient.id)"
            method="post"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Fecha</label>
                <input
                    type="date"
                    name="date"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="min-h-40 rounded-lg bg-gray-100 p-2 hidden"
                    v-model="notes"
                ></textarea>
                <QuillEditor
                    theme="snow"
                    toolbar="full"
                    contentType="html"
                    class="min-h-40"
                    v-model:content="notes"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 1</label>
                <input
                    type="file"
                    name="file1"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 2</label>
                <input
                    type="file"
                    name="file2"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 3</label>
                <input
                    type="file"
                    name="file3"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex justify-center gap-3">
                <Link
                    :href="route('patients.show', patient.id)"
                    class="w-32 cursor-pointer rounded-lg bg-gray-100 px-4 py-2 font-semibold hover:bg-gray-200"
                    as="button"
                    >Cancelar</Link
                >
                <button
                    type="submit"
                    class="w-32 cursor-pointer rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
                >
                    Crear
                </button>
            </div>
        </Form>
    </div>
</template>
