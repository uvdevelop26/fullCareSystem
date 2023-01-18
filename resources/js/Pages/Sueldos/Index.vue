<template>
    <div>
        <Head title="Sueldos" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Planilla de Sueldos</h1>
        <div class="flex items-center justify-between mb-6">

            <Link class="btn-nuevo" type="button" :href="route('sueldos.create')" v-if="can.create">
            <span class="text-white font-bold">Nuevo Sueldo</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">Monto</th>
                        <th class="py-3 px-4">Categoria</th>
                        <th class="py-3 px-4">Observacion</th>
                        <th class="py-3 px-4"  v-if="can.edit || can.delete">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sueldo in sueldos.data" :key="sueldo.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ sueldo.empleado.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ sueldo.empleado.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ sueldo.monto }}
                        </td>
                        <td class="border-t py-3">
                            {{ sueldo.categoria }}
                        </td>
                        <td class="border-t py-3">
                            {{ sueldo.observacion }}
                        </td>

                        <td class="border-t py-3" v-if="can.edit || can.delete">
                            <Link class="mx-1 inline-block"
                                :href="route('sueldos.edit', sueldo.id)" v-if="can.edit">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1"
                                @click="eliminarSueldo(sueldo)" v-if="can.delete">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="sueldos.links" />
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
        sueldos: Object,
        can: Object
    },

    setup(props) {

        const eliminarSueldo = (data) => {
            data._method = "DELETE";
            Inertia.post("/sueldos/" + data.id, data);
        };



        return {
            eliminarSueldo
        }
    }

}

</script>