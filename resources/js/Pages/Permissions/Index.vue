<template>
    <div>

        <Head title="Premissions" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Permisos de Usuarios</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('permissions.create')" v-if="can.create">
            <span class="text-white font-bold">Nuevo Permiso</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4" v-if="can.edit || can.delete">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="permission in permissions.data" :key="permission.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ permission.name }}
                        </td>
                        <td class="border-t py-3" v-if="can.edit || can.delete">
                            <Link class="mx-1 inline-block"
                                :href="route('permissions.edit', permission.id)" v-if="can.edit">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1" type="submit" @click="eliminarPermiso(permission.id)"
                                v-if="can.delete">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="permissions.links" />
        </div>
    </div>

</template>

<script>
import Layout from '../../Shared/Layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from '../../Shared/Pagination.vue';

export default {

    components: {
        Head,
        Link,
        Icon,
        Pagination

    },

    props: {
        permissions: Object,
        can: Object
    },

    layout: Layout,

    setup(props) {

        const formDelete = useForm({})

        function eliminarPermiso(id) {

            formDelete.delete(route('permissions.destroy', id));

        }

        return { eliminarPermiso }
    }



}
</script>

<style>

</style>