<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Nuevo Cliente</h1>
        <Form
            :action="route('patients.store')"
            method="post"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Nombre</label>
                <input
                    type="text"
                    name="name"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Teléfono</label>
                <input
                    type="text"
                    name="phone"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Correo</label>
                <input
                    type="text"
                    name="email"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                ></textarea>
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
                    Crear
                </button>
            </div>
        </Form>
    </div>
</template>
