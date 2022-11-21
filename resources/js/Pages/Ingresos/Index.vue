<template>
<div>
    <Head title="Ingresos" />
    <h1 class="mb-7 text-3xl font-bold text-cyan-600">Ingresos</h1>
    <div class="flex items-center justify-between mb-6">
        <Link class="btn-nuevo" 
        type="button" 
        :href="route('ingresos.create')">
            <span class="text-white font-bold">Nuevo Ingreso</span>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-center text-sm uppercase">
                    <th class="py-4 px-6">Tipo Ingreso</th>
                    <th class="py-4 px-6">Detalle</th>
                    <th class="py-4 px-6">Fecha Ingreso</th>
                    <th class="py-4 px-6">Montos</th>
                    <th class="py-4 px-6">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ingreso in ingresos" :key="ingreso.id" 
                class="text-center text-gray-600 hover:bg-indigo-50"
                :class="{}">
                    <td class="border-t py-2">
                        {{ingreso.tipo_ingreso}}
                    </td>
                    <td class="border-t py-2">
                         {{ingreso.detalle}}
                    </td>
                    <td class="border-t py-2">
                        {{ingreso.fecha_ingreso}}
                    </td>
                    <td class="border-t px-2">
                        {{ingreso.monto}}
                    </td>
                    <td class="border-t py-2">
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1"
                        :href="route('ingresos.edit', ingreso.id)">
                        <icon name="edit" class="w-3 h-3 fill-gray-600" />
                        </Link>
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1" method="DELETE"
                        :href="route('ingresos.destroy', ingreso.id)">
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
        ingresos: Array
    },

    layout: Layout

}
</script>

<style>

</style>