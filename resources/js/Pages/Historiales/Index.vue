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
        historiales: Array,

    },

    setup(props) {

    }


}
</script>
<template>
    <div>

        <Head title="Historiales" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Historial Clínico</span>
            </h1>
            <Link :href="route('historiales.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- FILTER AREA -->
        <!-- TABLE -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead>
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha registro</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Enfermedades</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Alergias</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Diagnostico</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Observaciones</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="historiale in historiales" :key="historiale.id"
                        v-if="historiales.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ historiale.residente.persona.nombres }}
                            {{ historiale.residente.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ historiale.fecha_registro }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-for="enfermedades in historiale.enfermedades"
                                class="inline-block px-3 py-1 mr-2 rounded-2xl border border-softIndigo text-softIndigo bg-indigo-100">
                                {{ enfermedades.nombre }}
                            </span>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-for="alergias in historiale.alergias"
                                class="inline-block px-3 py-1 mr-2 rounded-2xl border border-softIndigo text-softIndigo bg-indigo-100">
                                {{ alergias.nombre }}
                            </span>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ historiale.diagnostico }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ historiale.observaciones }}
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('historiales.edit', historiale.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md">
                                    <Icon name="delete" class="w-3 h-3 fill-white" />
                                </button>
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md">
                                <icon name="ver" class="w-3 h-3 fill-textColor" />
                                </Link>
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
