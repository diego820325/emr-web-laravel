<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ clients: Array<Record<string, any>> }>();
</script>

<template>
    <div class="container mx-auto flex flex-col gap-10 p-10">
        <div class="flex justify-between">
            <h1 class="text-xl font-bold">Clientes</h1>
            <Link
                :href="route('clients.create')"
                as="button"
                class="rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white cursor-pointer hover:bg-blue-600"
            >
                Nuevo Cliente
            </Link>
        </div>
        <table>
            <thead>
                <tr class="border-b text-left font-semibold">
                    <th class="pb-3">Nombre</th>
                    <th class="pb-3">Teléfono</th>
                    <th class="pb-3">Correo</th>
                    <th class="pb-3">Notas</th>
                    <th class="pb-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="client in clients" :key="client.id" class="border-b">
                    <td class="py-3 pr-2 text-nowrap">{{ client.name }}</td>
                    <td class="py-3 pr-2 text-nowrap text-gray-400">
                        {{ client.phone }}
                    </td>
                    <td class="py-3 pr-2 text-nowrap text-gray-400">
                        {{ client.email }}
                    </td>
                    <td class="py-3 pr-2 text-gray-400">{{ client.notes }}</td>
                    <td class="flex gap-3 py-3">
                        <Link
                            :href="route('clients.edit', client.id)"
                            class="font-semibold text-blue-500 hover:text-blue-600"
                        >
                            Editar
                        </Link>
                        <Link
                            :href="route('clients.destroy', client.id)"
                            method="delete"
                            as="button"
                            class="cursor-pointer font-semibold text-blue-500 hover:text-blue-600"
                        >
                            Borrar
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
