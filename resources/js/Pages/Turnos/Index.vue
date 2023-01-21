<template>
    <div>

        <Head title="Jornadas" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Jornadas</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('turnos.create')">
            <span class="text-white font-bold">Nueva Jornada</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">Turno</th>
                        <th class="py-4 px-6">Dias</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="turno in turnos" :key="turno.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ turno.empleado.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ turno.empleado.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ turno.turno }}
                        </td>
                        <td class="border-t py-3">
                          <span v-for="dias in turno.dias" 
                          class="inline-block p-1 mx-1 rounded-lg text-white font-bold bg-gradient-to-r from-indigo-400 to-indigo-500 ">
                        {{ dias.dias }}
                        </span>  
                        </td>
                      
                        <td class="border-t py-3">
                            <Link class="mx-1 inline-block" :href="route('turnos.edit', turno.id)">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1"  @click="eliminarTurno(turno)">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>

                    </tr>
                </tbody>
            </table>
           <!--  <pagination class="mt-6" :links="ingresos.links" /> -->
        </div>
    </div>

</template>

<script>
import Layout from '../../Shared/Layout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
/* import Pagination from '../../Shared/Pagination.vue'; */
import { Inertia } from '@inertiajs/inertia';
export default {

    components: {
        Head,
        Link,
        Icon,
/*         Pagination */

    },

    props: {
        turnos: Object
    },

    layout: Layout,

    setup() {
        const formDelete = useForm({});

        const eliminarTurno = (data) => {
            data._method = "DELETE";
            Inertia.post("/turnos/" + data.id, data);
        };

        return { eliminarTurno }
    }

}
</script>

<style>

</style>