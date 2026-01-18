<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ record: Record<string, any> }>();
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Nueva Nota</h1>
        <Form
            :action="route('records.update', record.id)"
            method="put"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Fecha</label>
                <input
                    type="date"
                    name="date"
                    class="rounded-lg bg-gray-100 p-2"
                    :value="record.date"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                    :value="record.notes"
                ></textarea>
            </div>
            <div class="flex justify-center gap-3">
                <Link
                    :href="route('patients.show', record.patient.id)"
                    class="w-32 cursor-pointer rounded-lg bg-gray-100 px-4 py-2 font-semibold hover:bg-gray-200"
                    as="button"
                    >Cancelar</Link
                >
                <button
                    type="submit"
                    class="w-32 cursor-pointer rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
                >
                    Guardar
                </button>
            </div>
        </Form>
    </div>
</template>
