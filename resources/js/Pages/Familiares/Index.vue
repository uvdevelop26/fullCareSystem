<template>
    <div>
        <Head title="Familiares" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Familiares</h1>
        <div class="flex items-center justify-between mb-6">
         
            <Link
                class="btn-nuevo"
                type="button"
                :href="route('familiares.create')"
            >
                <span class="text-white font-bold">Nuevo Familiar</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">CI</th>
                        <th class="py-3 px-4">Fecha Nacimiento</th>
                        <th class="py-3 px-4">Teléfono</th>
                        <th class="py-3 px-4">Edad</th>
                        <th class="py-3 px-4">Sexo</th>
                        <th class="py-3 px-4">Direccion</th>
                        <th class="py-3 px-4">Ciudad</th>
                        <th class="py-3 px-4">Parentezco</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Residente</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="familiare in familiares.data"
                        :key="familiare.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100"
                        :class="{}"
                    >
                        <td class="border-t py-3">
                            {{ familiare.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.ci_numero }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.fecha_nacimiento }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.telefono }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.edad }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.sexo }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.direccion }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.persona.ciudade.nombre_ciudad }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.parentezco }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.email }}
                        </td>
                        <td class="border-t py-3">
                            {{ familiare.residente.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            <Link
                                class="mx-1 inline-block"
                                :href="route('familiares.edit', familiare.id)"
                            >
                                <icon
                                    name="edit"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </Link>
                            <button
                                class="mx-1"
                                @click="eliminarFamiliar(familiare)"
                            >
                                <icon
                                    name="delete"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="familiares.links" />
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Pagination from "../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

export default{

    components:{
        Head,
        Link,
        Icon,
        Pagination

    },

    layout: Layout,

    props:{
        familiares: Object
    },

    setup(props){

        const eliminarFamiliar = (data) => {
            data._method = "DELETE";
            Inertia.post("/familiares/" + data.id, data);
        };



        return{
            eliminarFamiliar
        }
    }

    

}

</script>