<script setup lang="ts">
import UserLayout from '@/layouts/UserLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast';
import { destroy } from '@/actions/App/Http/Controllers/CustomAttributeController';
import Toast from 'primevue/toast';
import ConfirmDialog from 'primevue/confirmdialog';

defineProps<{
    section: Record<string, any>;
    customAttributes: Array<Record<string, any>>;
}>();

const confirm = useConfirm();
const toast = useToast();

const confirmDelete = (sectionId: number, id: number) => {
    confirm.require({
        message: 'Estas seguro de eliminar el campo personalizado?',
        header: 'Eliminar Campo Personalizado',
        rejectProps: {
            label: 'Cancelar',
            severity: 'secondary',
            outlined: true,
        },
        acceptProps: {
            label: 'Eliminar',
            severity: 'danger',
        },
        accept: () => {
            router.delete(destroy([sectionId, id]));
            toast.add({
                severity: 'info',
                summary: 'Eliminado',
                detail: 'El campo personalizado ha sido eliminado!',
                life: 3000,
            });
        },
    });
};
</script>

<template>
    <UserLayout>
        <Toast />
        <ConfirmDialog>
            <template #message="slotProps">
                <div>{{ slotProps.message.message }}</div>
            </template>
        </ConfirmDialog>
        <div class="container mx-auto flex flex-col gap-10 p-10">
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">
                    {{ section.name }} - Campos personalizados
                </h1>
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
                            <button
                                @click="
                                    confirmDelete(
                                        section.id,
                                        attribute.id,
                                    )
                                "
                                class="cursor-pointer font-semibold text-blue-500 hover:text-blue-600"
                            >
                                Borrar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </UserLayout>
</template>
