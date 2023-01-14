<template>
    <div>
        <Head title="Roles" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Roles</h1>
        <div class="flex items-center justify-between mb-6">
         
            <Link
                class="btn-nuevo"
                type="button"
                :href="route('roles.create')"
            >
                <span class="text-white font-bold">Nuevo Rol</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto" >
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Rol</th>
                        <th class="py-3 px-4">Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="roles in role"
                        :key="role.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100"
                        :class="{}"
                    >
                        <td class="border-t py-3">
                            {{ role.name }}
                        </td>
                        
    
                        <td class="border-t py-3">
                            <Link
                                class="mx-1 inline-block"
                                :href="route('roles.edit', role.id)"
                          
                            >
                                <icon
                                    name="edit"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </Link>
                            <button
                                class="mx-1"
                                @click="eliminarRol(role)"
                                
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
        roles: Object
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