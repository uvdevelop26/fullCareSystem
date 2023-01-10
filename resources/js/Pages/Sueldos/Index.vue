<template>
    <div>

        <Head title="Sueldos" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Planilla de Sueldos</h1>
        <div class="flex items-center justify-between mb-6">

            <Link class="btn-nuevo" type="button" :href="route('sueldos.create')">
            <span class="text-white font-bold">Nuevo Sueldo</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-2 px-4">Nombres</th>
                        <th class="py-2 px-4">Apellidos</th>
                        <th class="py-2 px-4">Monto</th>
                        <th class="py-2 px-4">Categoria</th>
                        <th class="py-2 px-4">Observacion</th>
                        <th class="py-2 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sueldo in sueldos.data" :key="sueldo.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-50" :class="{}">
                        <td class="border-t">
                            {{ sueldo.empleado.persona.nombres }}
                        </td>
                        <td class="border-t">
                            {{ sueldo.empleado.persona.apellidos }}
                        </td>
                        <td class="border-t">
                            {{ sueldo.monto }}
                        </td>
                        <td class="border-t">
                            {{ sueldo.categoria }}
                        </td>
                        <td class="border-t">
                            {{ sueldo.observacion }}
                        </td>

                        <td class="border-t py-2">
                            <Link class="inline-block px-2 py-2 mx-1 bg-gray-100 rounded-full"
                                :href="route('sueldos.edit', sueldo.id)">
                            <icon name="edit" class="w-3 h-3 fill-gray-600" />
                            </Link>
                            <button class="px-2 py-2 mx-1 my-0 bg-gray-100 rounded-full"
                                @click="eliminarSueldo(sueldo)">
                                <icon name="delete" class="w-3 h-3 fill-gray-600" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <pagination class="mt-6" :links="sueldos.links" /> -->
        </div>
    </div>
</template>

<script>
import Layout from '../../Shared/Layout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
/* import Pagination from "../../Shared/Pagination.vue"; */
import { Inertia } from "@inertiajs/inertia";

export default {

    components: {
        Head,
        Link,
        Icon,
        /*  Pagination */
    },

    layout: Layout,

    props: {
        sueldos: Object
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