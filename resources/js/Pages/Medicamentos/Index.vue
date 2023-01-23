<template>
    <div>
        <Head title="Medicamentos" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Medicamentos</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('medicamentos.create')">
            <span class="text-white font-bold">Nuevo Medicamento</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Residente</th>
                        <th class="py-3 px-4">Medicamento</th>
                        <th class="py-3 px-4">Suministro</th>
                        <th class="py-3 px-4">Vencimiento</th>
                        <th class="py-4 px-6">Dosis/Cantidad</th>
                        <th class="py-4 px-6">Stock</th>
                        <th class="py-4 px-6">Horarios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="medicamento in medicamentos" :key="medicamento.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ medicamento.residente.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ medicamento.nombre_medicamento }}
                        </td>
                        <td class="border-t py-3">
                            {{ medicamento.via_suministro }}
                        </td>
                        <td class="border-t py-3">
                            {{ medicamento.fecha_vencimiento }}
                        </td>
                        <td class="border-t py-3">
                            {{ medicamento.dosis_cantidad }}
                        </td>
                        <td class="border-t py-3">
                            {{ medicamento.stock }}
                        </td>
                        <td class="border-t py-3">
                          <span v-for="horario in medicamento.horarios" 
                          class="inline-block p-1 mx-1 rounded-lg text-white font-bold bg-gradient-to-r from-indigo-400 to-indigo-500 ">
                        {{ horario.hora }}
                        </span>  
                        </td>
                      
                        <td class="border-t py-3">
                            <Link class="mx-1 inline-block" :href="route('medicamentos.edit', medicamento.id)">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1"  @click="eliminarMedicamento(medicamento)">
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
        medicamentos: Object
    },

    layout: Layout,

    setup() {
        const formDelete = useForm({});

        const eliminarMedicamento = (data) => {
            data._method = "DELETE";
            Inertia.post("/medicamentos/" + data.id, data);
        };

        return { eliminarMedicamento }
    }

}
</script>

<style>

</style>