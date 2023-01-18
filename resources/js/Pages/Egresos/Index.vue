<template>
    <div>

        <Head title="Egresos" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Egresos</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('egresos.create')">
            <span class="text-white font-bold">Nuevo Egreso</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Tipo</th>
                        <th class="py-3 px-4">Subtipo</th>
                        <th class="py-3 px-4">Detalle</th>
                        <th class="py-4 px-6">Fecha</th>
                        <th class="py-3 px-4">Monto</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="egreso in egresos.data" :key="egreso.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ egreso.tipo }}
                        </td>
                        <td class="border-t py-3">
                            {{ egreso.subtipo }}
                        </td>
                        <td class="border-t py-3">
                            {{ egreso.detalle }}
                        </td>
                        <td class="border-t py-3">
                            {{ egreso.egreso_fecha }}
                        </td>
                        <td class="border-t py-3">
                            {{ egreso.monto }}
                        </td>
                        <td class="border-t py-3">
                            <Link class="mx-1 inline-block" :href="route('egresos.edit', egreso.id)">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1"  @click="eliminarEgreso(egreso.id)">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>

                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="egresos.links" />
        </div>
    </div>

</template>

<script>
import Layout from '../../Shared/Layout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Pagination from '../../Shared/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
export default {

    components: {
        Head,
        Link,
        Icon,
        Pagination
    },

    props: {
        egresos: Object
    },

    layout: Layout,

    setup() {
        const formDelete = useForm({});

        function eliminarEgreso(id) {

            formDelete.delete(route('egresos.destroy', id));

        }

        return { eliminarEgreso }
    }

}
</script>

<style>

</style>