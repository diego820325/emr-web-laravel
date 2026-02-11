<script setup lang="ts">
import UserLayout from '@/layouts/UserLayout.vue';
import { Form, Link } from '@inertiajs/vue3';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref } from 'vue';
import { route } from 'ziggy-js';

defineProps<{
    section: Record<string, any>;
    types: Array<Record<string, any>>;
}>();

const custom_attribute_type_id = ref(0);
const options = ref(3);
</script>

<template>
    <UserLayout>
        <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
            <h1 class="text-xl font-bold">{{ section.name }} - Nuevo Campo</h1>
            <Form
                :action="route('custom-attributes.store', section.id)"
                method="post"
                class="flex flex-col gap-5"
            >
                <div class="flex flex-col gap-2">
                    <label for="name" class="font-semibold">Pregunta</label>
                    <input
                        type="text"
                        name="question"
                        class="rounded-lg bg-gray-100 p-2"
                    />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="name" class="font-semibold">Tipo</label>
                    <select
                        name="custom_attribute_type_id"
                        class="rounded-lg bg-gray-100 p-2"
                        v-model="custom_attribute_type_id"
                    >
                        <option value="0">-- Seleccione --</option>
                        <option
                            v-for="type in types"
                            :key="type.id"
                            :value="type.id"
                        >
                            {{ type.name }}
                        </option>
                    </select>
                </div>
                <div
                    class="flex flex-col gap-2"
                    v-if="custom_attribute_type_id >= 8"
                >
                    <label for="name" class="font-semibold">Opciones</label>
                    <input
                        type="text"
                        name="options[]"
                        class="rounded-lg bg-gray-100 p-2"
                        v-for="n in options"
                        :key="n"
                    />
                    <button
                        type="button"
                        class="cursor-pointer font-semibold text-blue-500 hover:text-blue-600"
                        @click="options++"
                    >
                        Crear otra opción
                    </button>
                </div>
                <div class="flex justify-center gap-3">
                    <Link
                        :href="route('custom-attributes.index', section.id)"
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
    </UserLayout>
</template>
