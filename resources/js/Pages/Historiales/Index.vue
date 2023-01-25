<template>
    <div>
        <Head title="Permisos" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Historial Clínico</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('historiales.create')" v-if="can.create">
            <span class="text-white font-bold">Nuevo Historial</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">Fecha</th>
                        <th class="py-3 px-4">Observaciones</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="historiale in historiales.data" :key="historiale.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ historiale.residente.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ historiale.residente.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ historiale.fecha_historial }}
                        </td>
                        <td class="border-t py-3">
                            {{ historiale.observaciones }}
                        </td>
                        <td class="border-t py-3">
                            <Link class="mx-1 inline-block"
                                :href="route('historiales.edit', historiale.id)" v-if="can.edit">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <Link class="mx-1 inline-block">
                            <icon name="ver" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="historiales.links" />
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Pagination from "../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

export default {

    components: {
        Head,
        Link,
        Icon,
        Pagination
    },

    layout: Layout,

    props: {
        historiales: Object,
        can: Object
    },

   
}
</script>