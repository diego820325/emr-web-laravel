<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

<template>
    <div class="flex flex-col">
        <div class="flex gap-8 pt-5 justify-center">
            <Link
                :href="route('patients.index')"
                class="font-semibold text-blue-500 hover:text-blue-600"
                >Clientes</Link
            >
            <Link
                :href="route('custom-attributes.index', { section: 1 })"
                class="font-semibold text-blue-500 hover:text-blue-600"
                >Personalizar Clientes</Link
            >
            <Link
                :href="route('custom-attributes.index', { section: 2 })"
                class="font-semibold text-blue-500 hover:text-blue-600"
                >Personalizar Notas</Link
            >
        </div>
        <slot />
    </div>
</template>
