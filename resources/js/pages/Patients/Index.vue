<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { ref } from 'vue';
import { FilterMatchMode } from '@primevue/core/api';
import UserLayout from '@/layouts/UserLayout.vue';
import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';
import ConfirmDialog from 'primevue/confirmdialog';
import { destroy } from '@/actions/App/Http/Controllers/PatientController';

defineProps<{ patients: Array<Record<string, any>> }>();

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const confirm = useConfirm();
const toast = useToast();

const confirmDelete = (id: number, name: string) => {
    confirm.require({
        message: `Estas seguro de eliminar a ${name}?`,
        header: 'Eliminar Cliente',
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
            router.delete(destroy(id));
            toast.add({
                severity: 'info',
                summary: 'Eliminado',
                detail: `El cliente ${name} ha sido eliminado!`,
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
                <h1 class="text-xl font-bold">Clientes</h1>
                <Link
                    :href="route('patients.create')"
                    as="button"
                    class="cursor-pointer rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
                >
                    Nuevo Cliente
                </Link>
            </div>
            <DataTable
                v-model:filters="filters"
                :value="patients"
                paginator
                :rows="50"
                :globalFilterFields="['name', 'phone', 'email', 'notes']"
            >
                <template #header>
                    <div class="flex items-center justify-end gap-1">
                        <span>Buscar:</span>
                        <input
                            type="text"
                            class="rounded-lg bg-gray-100 p-2"
                            v-model="filters['global'].value"
                        />
                    </div>
                </template>
                <template #empty
                    >No hay clientes que coincidan con la búsqueda</template
                >
                <Column field="name" header="Nombre" class="text-black">
                    <template #body="slotProps">
                        <Link
                            :href="route('patients.show', slotProps.data.id)"
                            class="hover:underline"
                        >
                            {{ slotProps.data.name }}
                        </Link>
                    </template>
                </Column>
                <Column
                    field="phone"
                    header="Teléfono"
                    class="text-gray-400"
                ></Column>
                <Column
                    field="email"
                    header="Correo"
                    class="text-gray-400"
                ></Column>
                <Column
                    field="notes"
                    header="Notas"
                    class="text-gray-400"
                ></Column>
                <Column field="id">
                    <template #body="slotProps">
                        <div class="flex gap-3">
                            <Link
                                :href="
                                    route('patients.edit', slotProps.data.id)
                                "
                                class="font-semibold text-blue-500 hover:text-blue-600"
                            >
                                Editar
                            </Link>
                            <button
                                @click="
                                    confirmDelete(
                                        slotProps.data.id,
                                        slotProps.data.name,
                                    )
                                "
                                class="cursor-pointer font-semibold text-blue-500 hover:text-blue-600"
                            >
                                Borrar
                            </button>
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>
    </UserLayout>
</template>
