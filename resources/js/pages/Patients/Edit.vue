<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { QuillEditor } from '@vueup/vue-quill';
import { ref } from 'vue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps<{
    patient: Record<string, any>;
    customAttributes: Array<Record<string, any>>;
    errors: Record<string, any>;
}>();

const getCustomAttributeValue = (customAttribute: Record<string, any>) => {
    const attributeValues = props.patient.custom_attribute_values.filter(
        (custom_attribute_value: Record<string, any>) =>
            custom_attribute_value.custom_attribute_id === customAttribute.id,
    );

    if (!attributeValues) {
        return '';
    }

    const attributeValue =
        customAttribute.custom_attribute_type_id !== 10
            ? attributeValues[0]
            : attributeValues.map(
                  (attributeValue: Record<string, any>) =>
                      attributeValue.custom_attribute_option.id,
              );

    switch (customAttribute.custom_attribute_type_id) {
        case 1:
            return attributeValue?.string_value;
        case 2:
            return attributeValue?.text_value;
        case 3:
            return attributeValue?.long_text_value;
        case 4:
            return attributeValue?.number_value;
        case 5:
            return attributeValue?.boolean_value;
        case 6:
            return attributeValue?.date_value;
        case 7:
            return attributeValue?.date_time_value;
        case 8:
            return attributeValue?.custom_attribute_option?.id;
        case 9:
            return attributeValue?.custom_attribute_option?.id;
        case 10:
            return attributeValue;
        default:
            return 'N/A';
    }
};

const htmlModels: Record<string, any> = ref({});

for (const customAttribute of props.customAttributes) {
    if (customAttribute.custom_attribute_type_id === 3) {
        htmlModels.value[customAttribute.id] =
            getCustomAttributeValue(customAttribute);
    }
}
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col gap-10 p-10">
        <h1 class="text-xl font-bold">Editar Cliente</h1>
        <Form
            :action="route('patients.update', patient.id)"
            method="put"
            class="flex flex-col gap-5"
        >
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">
                    Nombre
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    class="rounded-lg bg-gray-100 p-2"
                    :defaultValue="patient.name"
                />
                <div class="text-xs text-red-500" v-if="errors.name">
                    {{ errors.name }}
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Teléfono</label>
                <input
                    type="text"
                    name="phone"
                    class="rounded-lg bg-gray-100 p-2"
                    :defaultValue="patient.phone"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Correo</label>
                <input
                    type="text"
                    name="email"
                    class="rounded-lg bg-gray-100 p-2"
                    :defaultValue="patient.email"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class="font-semibold">Notas</label>
                <textarea
                    name="notes"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                    >{{ patient.notes }}</textarea
                >
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
                    :defaultValue="getCustomAttributeValue(customAttribute)"
                />
                <textarea
                    :name="customAttribute.id"
                    class="min-h-40 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 2"
                    >{{ getCustomAttributeValue(customAttribute) }}</textarea
                >
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
                    :defaultValue="getCustomAttributeValue(customAttribute)"
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
                            :defaultChecked="
                                getCustomAttributeValue(customAttribute) === 1
                            "
                        />
                        Si
                    </div>
                    <div class="flex gap-1">
                        <input
                            type="radio"
                            :name="customAttribute.id"
                            class="rounded-lg bg-gray-100 p-2"
                            :value="0"
                            :defaultChecked="
                                getCustomAttributeValue(customAttribute) === 0
                            "
                        />
                        No
                    </div>
                </div>
                <input
                    type="date"
                    :name="customAttribute.id"
                    class="w-42 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 6"
                    :defaultValue="getCustomAttributeValue(customAttribute)"
                />
                <input
                    type="datetime-local"
                    :name="customAttribute.id"
                    class="w-52 rounded-lg bg-gray-100 p-2"
                    v-if="customAttribute.custom_attribute_type_id === 7"
                    :defaultValue="getCustomAttributeValue(customAttribute)"
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
                        :defaultSelected="
                            getCustomAttributeValue(customAttribute) ===
                            option.id
                        "
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
                            :defaultChecked="
                                getCustomAttributeValue(customAttribute) ===
                                option.id
                            "
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
                            :defaultChecked="
                                getCustomAttributeValue(
                                    customAttribute,
                                ).includes(option.id)
                            "
                        />
                        {{ option.text }}
                    </div>
                </div>
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
                    Guardar
                </button>
            </div>
        </Form>
    </div>
</template>
