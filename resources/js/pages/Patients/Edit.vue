<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ patient: Record<string, any> }>();
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Editar Cliente</h1>
        <Form
            :action="route('patients.update', patient.id)"
            method="put"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Nombre</label>
                <input
                    type="text"
                    name="name"
                    class="rounded-lg bg-gray-100 p-2"
                    :value="patient.name"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Teléfono</label>
                <input
                    type="text"
                    name="phone"
                    class="rounded-lg bg-gray-100 p-2"
                    :value="patient.phone"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Correo</label>
                <input
                    type="text"
                    name="email"
                    class="rounded-lg bg-gray-100 p-2"
                    :value="patient.email"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                    >{{ patient.notes }}</textarea
                >
            </div>
            <div class="flex justify-center gap-3">
                <Link
                    :href="route('patients.index')"
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
