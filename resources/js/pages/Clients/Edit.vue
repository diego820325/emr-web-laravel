<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{ client: Record<string, any> }>();
</script>

<template>
    <div>Editar</div>
    <Form :action="route('clients.update', client.id)" method="put">
        <input type="text" name="name" :value="client.name" />
        <input type="text" name="phone" :value="client.phone" />
        <input type="text" name="email" :value="client.email" />
        <textarea name="notes">{{ client.notes }}</textarea>
        <button type="submit">Editar Cliente</button>
        <Link :href="route('clients.index')">Volver</Link>
    </Form>
</template>
