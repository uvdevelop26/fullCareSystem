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
                        <th class="py-2 px-4">Nombres</th>
                        <th class="py-2 px-4">Apellidos</th>
                        <th class="py-2 px-4">CI</th>
                        <th class="py-2 px-4">Fecha Nacimiento</th>
                        <th class="py-2 px-4">Teléfono</th>
                        <th class="py-2 px-4">Edad</th>
                        <th class="py-2 px-4">Sexo</th>
                        <th class="py-2 px-4">Direccion</th>
                        <th class="py-2 px-4">Ciudad</th>
                        <th class="py-2 px-4">Parentezco</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Residente</th>
                        <th class="py-2 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="familiare in familiares.data"
                        :key="familiare.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-50"
                        :class="{}"
                    >
                        <td class="border-t">
                            {{ familiare.persona.nombres }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.apellidos }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.ci_numero }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.fecha_nacimiento }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.telefono }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.edad }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.sexo }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.direccion }}
                        </td>
                        <td class="border-t">
                            {{ familiare.persona.ciudade.nombre_ciudad }}
                        </td>
                        <td class="border-t">
                            {{ familiare.parentezco }}
                        </td>
                        <td class="border-t">
                            {{ familiare.email }}
                        </td>
                        <td class="border-t">
                            {{ familiare.residente_id }}
                        </td>
                        <td class="border-t py-2">
                            <Link
                                class="inline-block px-2 py-2 mx-1 bg-gray-100 rounded-full"
                                :href="route('familiares.edit', familiare.id)"
                            >
                                <icon
                                    name="edit"
                                    class="w-3 h-3 fill-gray-600"
                                />
                            </Link>
                            <button
                                class="px-2 py-2 mx-1 my-0 bg-gray-100 rounded-full"
                                @click="eliminarFamiliar(familiare)"
                            >
                                <icon
                                    name="delete"
                                    class="w-3 h-3 fill-gray-600"
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