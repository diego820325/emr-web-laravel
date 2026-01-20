<script setup lang="ts">
import { route } from 'ziggy-js';
import { Form, Link } from '@inertiajs/vue3';

defineProps<{ patient: Record<string, any> }>();
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col items-start gap-10 p-10">
        <Link
            :href="route('patients.index')"
            class="cursor-pointer rounded-lg bg-white px-4 py-2 font-semibold text-blue-500 hover:text-blue-600"
            as="button"
            ><< Volver</Link
        >
        <h1 class="text-xl font-bold">{{ patient.name }}</h1>
        <Form
            :action="route('patients.store')"
            method="post"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Teléfono</div>
                <p>{{ patient.phone }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Correo</div>
                <p>{{ patient.email }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Notas</div>
                <p>{{ patient.notes }}</p>
            </div>
            <div class="flex justify-center gap-3">
                <button
                    type="submit"
                    class="w-32 cursor-pointer rounded-lg bg-red-100 px-4 py-2 font-semibold text-red-400 hover:bg-red-500 hover:text-white"
                >
                    Eliminar
                </button>
                <Link
                    :href="route('patients.index')"
                    class="w-32 cursor-pointer rounded-lg bg-gray-100 px-4 py-2 font-semibold hover:bg-gray-200"
                    as="button"
                    >Editar</Link
                >
                <Link
                    :href="route('patients.records.create', patient.id)"
                    class="w-32 cursor-pointer rounded-lg bg-white px-4 py-2 font-semibold text-blue-500 hover:text-blue-600"
                    as="button"
                    >Añadir nota</Link
                >
            </div>
        </Form>

        <h2 class="text-lg font-bold">Seguimiento</h2>
        <div v-for="record in patient.records" :key="record.id">
            <div class="font-semibold">{{ record.date }}</div>
            <p v-html="record.notes"></p>
            <div class="flex gap-2">
                <a
                    :href="route('attachments.download', [attachment.id])"
                    v-for="attachment in record.attachments"
                    :key="attachment.id"
                    class="cursor-pointer rounded-lg bg-blue-50 px-5 py-1 text-blue-500 hover:bg-blue-100"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ attachment.name }}
                </a>
            </div>
            <div class="flex gap-3">
                [
                <Link
                    :href="route('records.destroy', [record.id])"
                    method="delete"
                    class="cursor-pointer rounded-lg font-semibold text-red-300 hover:text-red-500"
                    as="button"
                    >Eliminar</Link
                >
                |
                <Link
                    :href="route('records.edit', [record.id])"
                    class="cursor-pointer rounded-lg font-semibold text-blue-500 hover:text-blue-600"
                    as="button"
                    >Editar</Link
                >
                ]
            </div>
        </div>
    </div>
</template>
