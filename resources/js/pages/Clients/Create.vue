<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

<template>
    <div>Crear</div>
    <Form :action="route('clients.store')" method="post">
        <input type="text" name="name" />
        <input type="text" name="phone" />
        <input type="text" name="email" />
        <textarea name="notes"></textarea>
        <button type="submit">Crear Cliente</button>
        <Link :href="route('clients.index')">Volver</Link>
    </Form>
</template>
