
<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue'
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue';
import { watchEffect, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { pickBy } from 'lodash';

export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        SearchInput,
        SelectInput,
        Filters
    },


    props: {
        users: Array,
        roles: Array,
        filters: Object
    },

    setup(props) {

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_rol: props.filters.search_rol,
        });

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('usuarios.index', Object.keys(query).length ? query : {}));
        });

        //ELIMINAR USUARIO
        const eliminarUser = (data) => {
            data._method = "DELETE";
            Inertia.post('/usuarios/' + data.id, data)
        }

        return { form, eliminarUser }
    }



}

</script>
<template>
    <div>

        <Head title="Usuarios" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Usuarios</span>
            </h1>
            <Link :href="route('usuarios.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- FILTER AREA  -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class="lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombres/Apellidos/CI" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search" />
                        <select-input id="roles" label="Rol" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_rol">
                            <option :value="null" />
                            <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                                {{ rol.name }}
                            </option>
                        </select-input>
                    </div>
                </div>
            </filters>
        </div>
        <!-- TABLE -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Apellidos</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">CI </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">email</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">usuario</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">rol</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="user in users" :key="user.id" v-if="users.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ user.empleado.persona.nombres }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ user.empleado.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ user.empleado.persona.ci_numero }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ user.empleado.email }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ user.username }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-for="role in user.roles"
                                class="inline-block px-3 py-1 mr-2 rounded-2xl border border-softIndigo text-softIndigo bg-indigo-100">
                                {{ role.name }}
                            </span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('usuarios.edit', user.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="eliminarUser(user)">
                                    <Icon name="delete" class="w-3 h-3 fill-white" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-else class="text-center shadow group">
                        <span class="inline-block py-2 text-indigo-400 text-md">No se encuentran resultados</span>
                    </tr>
                </transition-group>
            </table>
        </div>
    </div>
</template>
<style scoped>
/* LIST TRANSITIONS */
.list-enter-from {
    opacity: 0;
    transform: translateX(-60px);
}

.list-enter-to {
    opacity: 1;
    transform: translateX(0);
}

.list-enter-active {
    transition: all 0.4s ease;
}

.list-leave-from {
    opacity: 1;
    transform: translateX(0);
}

.list-leave-to {
    opacity: 0;
    transform: translateX(-60px);
}

.list-leave-active {
    transition: all 0.4s ease;
}
</style>