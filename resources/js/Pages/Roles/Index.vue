<template>
    <div>

        <Head title="Roles" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Roles</h1>
        <div class="flex items-center justify-between mb-6">

            <Link class="btn-nuevo" type="button" :href="route('roles.create')" v-if="can.create">
            <span class="text-white font-bold">Nuevo Rol</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Rol</th>
                        <th class="py-3 px-4" v-if="can.edit || can.delete">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id" class="text-center text-sm text-gray-600 hover:bg-gray-100"
                        :class="{}">
                        <td class="border-t py-3">
                            {{ role.name }}
                        </td>
                        <td class="border-t py-3" v-if="can.edit || can.delete">
                            <Link class="mx-1 inline-block" :href="route('roles.edit', role.id)" v-if="can.edit">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1" @click="eliminarRol(role)" v-if="can.delete">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import { useForm } from "@inertiajs/inertia-vue3";

export default {

    components: {
        Head,
        Link,
        Icon,


    },


    props: {
        roles: Object,
        can: Object
    },

    layout: Layout,

    setup(props) {

        const formDelete = useForm({});

        function eliminarRol(id) {
            formDelete.delete(route('roles.destroy', id))
        };



        return {
            eliminarRol
        }
    }



}

</script>