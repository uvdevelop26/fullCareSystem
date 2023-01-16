<template>
    <div>
        <Head title="Usuarios" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Usuarios</h1>
        <div class="flex items-center justify-between mb-6">
         
            <Link
                class="btn-nuevo"
                type="button"
                :href="route('usuarios.create')"
            >
                <span class="text-white font-bold">Nuevo Usuario</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">Nombre Usuario</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Rol</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100"
                        :class="{}"
                    >
                        <td class="border-t py-3">
                            {{ user.empleado.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ user.empleado.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ user.username }}
                        </td>
                        <td class="border-t py-3">
                            {{ user.empleado.email }}
                        </td>
                        <td class="border-t py-3">
                          
                        </td>
                        <td class="border-t py-3">
                            <Link
                                class="mx-1 inline-block"
                                :href="route('usuarios.edit', user.id)"
                            >
                                <icon
                                    name="edit"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </Link>
                            <button
                                class="mx-1"
                                @click="eliminarUsuario(user)"
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
           <!--  <pagination class="mt-6" :links="user.links" /> -->
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
/* import Pagination from "../../Shared/Pagination.vue"; */
import { Inertia } from "@inertiajs/inertia";

export default{

    components:{
        Head,
        Link,
        Icon,
        /* Pagination */

    },

    layout: Layout,

    props:{
        users: Object, 
    
    },

    setup(props){

        const eliminarUsuario = (data) => {
            data._method = "DELETE";
            Inertia.post("/usuarios/" + data.id, data);
        };



        return{
            eliminarUsuario
        }
    }

    

}

</script>