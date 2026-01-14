<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ clients: Array<Record<string, any>> }>();
</script>

<template>
    <h1>Clientes</h1>
    <div>
        <Link :href="route('clients.create')">Create User</Link>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Notas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="client in clients" :key="client.id">
                <td>{{ client.name }}</td>
                <td>{{ client.phone }}</td>
                <td>{{ client.email }}</td>
                <td>{{ client.notes }}</td>
                <td>
                    <Link :href="route('clients.edit', client.id)">Editar</Link>
                    <Link
                        :href="route('clients.destroy', client.id)"
                        method="delete"
                        as="button"
                    >
                        Borrar
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
