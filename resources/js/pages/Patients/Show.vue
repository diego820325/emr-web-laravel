<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<{
    customAttributes: Record<string, any>;
    recordCustomAttributes: Record<string, any>;
    patient: Record<string, any>;
}>();

const getCustomAttributeValue = (
    model: Record<string, any>,
    customAttribute: Record<string, any>,
) => {
    const attributeValues = model.custom_attribute_values.filter(
        (custom_attribute_value: Record<string, any>) =>
            custom_attribute_value.custom_attribute_id === customAttribute.id,
    );

    if (!attributeValues) {
        return '';
    }

    const attributeValue =
        customAttribute.custom_attribute_type_id !== 10
            ? attributeValues[0]
            : attributeValues
                  .map(
                      (attributeValue: Record<string, any>) =>
                          attributeValue.custom_attribute_option.text,
                  )
                  .join(', ');

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
            return attributeValue?.custom_attribute_option?.text;
        case 9:
            return attributeValue?.custom_attribute_option?.text;
        case 10:
            return attributeValue;
        default:
            return 'N/A';
    }
};
</script>

<template>
    <div class="mx-auto flex w-1/2 flex-col items-start gap-10 p-10">
        <Link
            :href="route('patients.index')"
            class="cursor-pointer rounded-lg bg-white px-4 py-2 font-semibold text-blue-500 hover:text-blue-600"
            as="button"
            ><< Volver</Link
        >
        <h1 class="text-xl font-bold">{{ patient.name }}</h1>
        <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Teléfono</div>
                <p>{{ patient.phone }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Correo</div>
                <p>{{ patient.email }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <div class="font-semibold">Notas</div>
                <p>{{ patient.notes }}</p>
            </div>
            <div
                class="flex flex-col gap-2"
                v-for="customAttribute in customAttributes"
                :key="customAttribute.id"
            >
                <div class="font-semibold">{{ customAttribute.question }}</div>
                <p v-if="customAttribute.custom_attribute_type_id === 5">
                    {{
                        getCustomAttributeValue(patient, customAttribute)
                            ? 'Si'
                            : 'No'
                    }}
                </p>
                <p
                    v-else-if="customAttribute.custom_attribute_type_id === 3"
                    v-html="getCustomAttributeValue(patient, customAttribute)"
                ></p>

                <p v-else>
                    {{ getCustomAttributeValue(patient, customAttribute) }}
                </p>
            </div>
            <div class="flex justify-center gap-3">
                <button
                    type="submit"
                    class="w-32 cursor-pointer rounded-lg bg-red-100 px-4 py-2 font-semibold text-red-400 hover:bg-red-500 hover:text-white"
                >
                    Eliminar
                </button>
                <Link
                    :href="route('patients.edit', patient.id)"
                    class="w-32 cursor-pointer rounded-lg bg-gray-100 px-4 py-2 font-semibold hover:bg-gray-200"
                    as="button"
                    >Editar</Link
                >
                <Link
                    :href="route('patients.records.create', patient.id)"
                    class="w-32 cursor-pointer rounded-lg bg-white px-4 py-2 font-semibold text-blue-500 hover:text-blue-600"
                    as="button"
                    >Añadir nota</Link
                >
            </div>
        </div>

        <h2 class="text-lg font-bold">Seguimiento</h2>
        <div v-for="record in patient.records" :key="record.id">
            <div class="font-semibold">{{ record.date }}</div>
            <p v-html="record.notes"></p>
            <div
                class="flex flex-col gap-2"
                v-for="customAttribute in recordCustomAttributes"
                :key="customAttribute.id"
            >
                <div class="font-semibold">{{ customAttribute.question }}</div>
                <p v-if="customAttribute.custom_attribute_type_id === 5">
                    {{
                        getCustomAttributeValue(record, customAttribute)
                            ? 'Si'
                            : 'No'
                    }}
                </p>
                <p
                    v-else-if="customAttribute.custom_attribute_type_id === 3"
                    v-html="getCustomAttributeValue(record, customAttribute)"
                ></p>

                <p v-else>
                    {{ getCustomAttributeValue(record, customAttribute) }}
                </p>
            </div>
            <div class="flex gap-2">
                <a
                    :href="route('attachments.download', [attachment.id])"
                    v-for="attachment in record.attachments"
                    :key="attachment.id"
                    class="cursor-pointer rounded-lg bg-blue-50 px-5 py-1 text-blue-500 hover:bg-blue-100"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ attachment.name }}
                </a>
            </div>
            <div class="flex gap-3">
                [
                <Link
                    :href="route('records.destroy', [record.id])"
                    method="delete"
                    class="cursor-pointer rounded-lg font-semibold text-red-300 hover:text-red-500"
                    as="button"
                    >Eliminar</Link
                >
                |
                <Link
                    :href="route('records.edit', [record.id])"
                    class="cursor-pointer rounded-lg font-semibold text-blue-500 hover:text-blue-600"
                    as="button"
                    >Editar</Link
                >
                ]
            </div>
        </div>
    </div>
</template>
