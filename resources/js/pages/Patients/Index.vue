<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { ref } from 'vue';
import { FilterMatchMode } from '@primevue/core/api';
import UserLayout from '@/layouts/UserLayout.vue';

defineProps<{ patients: Array<Record<string, any>> }>();

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
</script>

<template>
    <UserLayout>
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
                            <Link
                                :href="
                                    route('patients.destroy', slotProps.data.id)
                                "
                                method="delete"
                                as="button"
                                class="cursor-pointer font-semibold text-blue-500 hover:text-blue-600"
                            >
                                Borrar
                            </Link>
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>
    </UserLayout>
</template>
