<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue'
import Pagination from "../../Shared/Pagination.vue";
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue';
import { watchEffect, reactive } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { pickBy } from 'lodash';

export default {

    components: {
        Head,
        Link,
        Icon,
        SearchInput,
        Pagination,
        SelectInput,
        Filters

    },

    layout: LayoutApp,

    props: {
        familiares: Array,
        ciudades: Array,
        filters: Object
    },

    setup(props) {

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_ciudad: props.filters.search_ciudad,
            search_residente: props.filters.search_residente

        });

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('familiares.index', Object.keys(query).length ? query : {}))
        });

        //ELIMINAR FAMILIAR
        const eliminarFamiliare = (data) => {
            data._method = "DELETE";
            Inertia.post('/familiares/' + data.id, data)
        }



        return { form, eliminarFamiliare }

    }


}

</script>
<template>
    <div>

        <Head title="familiares" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Familiares</span>
            </h1>
            <Link :href="route('familiares.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>

        <!-- FILTER AREA -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class=" lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Familiar - Nomb/Apell/CI"
                            class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" v-model="form.search" />
                        <select-input id="ciudades" label="Ciudad" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_ciudad">
                            <option :value="null" />
                            <option v-for="ciudad in ciudades" :key="ciudad.id" :value="ciudad.id">
                                {{ ciudad.nombre_ciudad }}
                            </option>
                        </select-input>
                        <search-input id="nombre" label="Residente - Nombre" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_residente" />
                    </div>
                    <div class="py-3 text-right">
                        <button class="btn-indigo mx-1 hover:bg-softIndigo" type="button" @click="limpiarCampos()">
                            Limpiar
                        </button>
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
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Residente</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Familiar</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">CI</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha Nacimiento</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Telefono</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">edad</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">sexo</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">direccion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Parentezco</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">email</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="familiare in familiares" :key="familiare.id"
                        v-if="familiares.length">
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor rounded-l-xl">
                            <span class="text-indigo-400 font-semibold">{{ familiare.residente.persona.nombres }}</span>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.nombres }} {{ familiare.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.ci_numero }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.fecha_nacimiento }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.telefono }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.edad }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.persona.sexo }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block text-indigo-400 font-semibold">
                                {{ familiare.persona.ciudade.nombre_ciudad }}
                            </span>
                            {{ familiare.persona.direccion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.parentezco }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ familiare.email }}
                        </td>
                        <td class="py-2 px-2 rounded-r-xl  bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link :href="route('familiares.edit', familiare.id)"
                                    class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="eliminarFamiliare(familiare)">
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