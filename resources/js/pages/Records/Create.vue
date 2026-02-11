<script setup lang="ts">
import { route } from 'ziggy-js';
import { Form, Link } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref } from 'vue';

const props = defineProps<{
    patient: Record<string, any>;
    customAttributes: Array<Record<string, any>>;
    errors: Record<string, any>;
}>();

const notes = ref('');
const htmlModels: Record<string, any> = ref({});

for (const customAttribute of props.customAttributes) {
    if (customAttribute.custom_attribute_type_id === 3) {
        htmlModels.value[customAttribute.id] = '';
    }
}
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Nueva Nota</h1>
        <Form
            :action="route('patients.records.store', patient.id)"
            method="post"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">
                    Fecha
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    name="date"
                    class="rounded-lg bg-gray-100 p-2"
                />
                <div class="text-xs text-red-500" v-if="errors.date">
                    {{ errors.date }}
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="hidden min-h-40 rounded-lg bg-gray-100 p-2"
                    v-model="notes"
                ></textarea>
                <QuillEditor
                    theme="snow"
                    toolbar="full"
                    contentType="html"
                    class="min-h-40"
                    v-model:content="notes"
                />
            </div>
            <div
                class="flex flex-col gap-2"
                v-for="customAttribute in customAttributes"
                :key="customAttribute.id"
            >
                <label for="name" class="font-semibold">
                    {{ customAttribute.question }}
                </label>
                <input
                    type="text"
                    :name="customAttribute.id"
                    class="rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 1"
                />
                <textarea
                    :name="customAttribute.id"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 2"
                ></textarea>
                <div v-if="customAttribute.custom_attribute_type_id === 3">
                    <textarea
                        :name="customAttribute.id"
                        class="hidden min-h-40 rounded-lg bg-gray-100 p-2"
                        v-model="htmlModels[customAttribute.id]"
                    ></textarea>
                    <QuillEditor
                        theme="snow"
                        toolbar="full"
                        contentType="html"
                        class="min-h-40"
                        v-model:content="htmlModels[customAttribute.id]"
                    />
                </div>
                <input
                    type="number"
                    :name="customAttribute.id"
                    class="w-32 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 4"
                />
                <div
                    v-if="customAttribute.custom_attribute_type_id === 5"
                    class="flex gap-5"
                >
                    <div class="flex gap-1">
                        <input
                            type="radio"
                            :name="customAttribute.id"
                            class="rounded-lg bg-gray-100 p-2"
                            :value="1"
                        />
                        Si
                    </div>
                    <div class="flex gap-1">
                        <input
                            type="radio"
                            :name="customAttribute.id"
                            class="rounded-lg bg-gray-100 p-2"
                            :value="0"
                        />
                        No
                    </div>
                </div>
                <input
                    type="date"
                    :name="customAttribute.id"
                    class="w-42 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 6"
                />
                <input
                    type="datetime-local"
                    :name="customAttribute.id"
                    class="w-52 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 7"
                />
                <select
                    :name="customAttribute.id"
                    class="rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 8"
                >
                    <option value="">-- Seleccione --</option>
                    <option
                        v-for="option in customAttribute.options"
                        :key="option.id"
                        :value="option.id"
                    >
                        {{ option.text }}
                    </option>
                </select>
                <div v-if="customAttribute.custom_attribute_type_id === 9">
                    <div
                        v-for="option in customAttribute.options"
                        :key="option.id"
                    >
                        <input
                            type="radio"
                            :name="customAttribute.id"
                            class="rounded-lg bg-gray-100 p-2"
                            :value="option.id"
                        />
                        {{ option.text }}
                    </div>
                </div>
                <div v-if="customAttribute.custom_attribute_type_id === 10">
                    <div
                        v-for="option in customAttribute.options"
                        :key="option.id"
                    >
                        <input
                            type="checkbox"
                            :name="`${customAttribute.id}[]`"
                            class="rounded-lg bg-gray-100 p-2"
                            :value="option.id"
                        />
                        {{ option.text }}
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 1</label>
                <input
                    type="file"
                    name="file1"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 2</label>
                <input
                    type="file"
                    name="file2"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="date" class="font-semibold">Archivo 3</label>
                <input
                    type="file"
                    name="file3"
                    class="rounded-lg bg-gray-100 p-2"
                />
            </div>
            <div class="flex justify-center gap-3">
                <Link
                    :href="route('patients.show', patient.id)"
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
