<script setup lang="ts">
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';

defineProps<{
    section: Record<string, any>;
    customAttributes: Array<Record<string, any>>;
}>();
</script>

<template>
    <div class="container mx-auto flex flex-col gap-10 p-10">
        <div class="flex justify-between">
            <h1 class="text-xl font-bold">{{ section.name }} - Campos personalizados</h1>
            <Link
                :href="route('custom-attributes.create', section.id)"
                as="button"
                class="cursor-pointer rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
            >
                Nuevo Campo
            </Link>
        </div>
        <table>
            <thead>
                <tr class="border-b text-left font-semibold">
                    <th class="pb-3">Pregunta</th>
                    <th class="pb-3">Tipo</th>
                    <th class="pb-3">Opciones</th>
                    <th class="pb-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="attribute in customAttributes"
                    :key="attribute.id"
                    class="border-b"
                >
                    <td class="py-3 pr-2">
                        {{ attribute.question }}
                    </td>
                    <td class="py-3 pr-2 text-nowrap text-gray-400">
                        {{ attribute.custom_attribute_type.name }}
                    </td>
                    <td class="py-3 pr-2 text-gray-400">
                        <div class="flex flex-col">
                            <div
                                v-for="option in attribute.options"
                                :key="option.id"
                            >
                                {{ option.text }}
                            </div>
                        </div>
                    </td>
                    <td class="flex gap-3 py-3">
                        <Link
                            :href="
                                route('custom-attributes.edit', [
                                    section.id,
                                    attribute.id,
                                ])
                            "
                            class="font-semibold text-blue-500 hover:text-blue-600"
                        >
                            Editar
                        </Link>
                        <Link
                            :href="
                                route('custom-attributes.destroy', [
                                    section.id,
                                    attribute.id,
                                ])
                            "
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
