<template>
<div>
    <Head title="Egresos" />
    <h1 class="mb-7 text-3xl font-bold text-cyan-600">Egresos</h1>
    <div class="flex items-center justify-between mb-6">
        <Link class="btn-nuevo" 
        type="button" 
        :href="route('egresos.create')">
            <span class="text-white font-bold">Nuevo Egreso</span>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-center text-sm uppercase">
                    <th class="py-4 px-6">Tipo Egreso</th>
                    <th class="py-4 px-6">Subtipo</th>
                    <th class="py-4 px-6">Detalle</th>
                    <th class="py-4 px-6">Fecha Egreso</th>
                    <th class="py-4 px-6">Montos</th>
                    <th class="py-4 px-6">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="egreso in egresos" :key="egreso.id" 
                class="text-center text-gray-600 hover:bg-indigo-50"
                :class="{}">
                    <td class="border-t py-2">
                        {{egreso.tipo_egreso}}
                    </td>
                    <td class="border-t py-2">
                         {{egreso.subtipo}}
                    </td>
                    <td class="border-t py-2">
                        {{egreso.detalle}}
                    </td>
                    <td class="border-t px-2">
                        {{egreso.fecha_egreso}}
                    </td>
                    <td class="border-t px-2">
                        {{egreso.monto}}
                    </td>
                    <td class="border-t py-2">
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1"
                        :href="route('egresos.edit', egreso.id)">
                             <icon name="edit" class="w-3 h-3 fill-gray-600" />
                        </Link>
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1" method="DELETE"
                        :href="route('egresos.destroy', egreso.id)">
                             <icon name="delete" class="w-3 h-3 fill-gray-600" />
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
  
</template>

<script>
import Layout from '../../Shared/Layout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
export default {

    components: {
        Head,
        Link,
        Icon

    },

    props:{
        egresos: Array
    },

    layout: Layout

}
</script>

<style>

</style>