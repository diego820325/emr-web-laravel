<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { logout } from '@/routes';

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <div class="flex flex-col">
        <div class="flex justify-center gap-8 pt-5">
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
            <Link
                class="font-semibold text-blue-500 hover:text-blue-600 cursor-pointer"
                :href="logout()"
                @click="handleLogout"
                as="button"
            >
                Salir
            </Link>
        </div>
        <slot />
    </div>
</template>
