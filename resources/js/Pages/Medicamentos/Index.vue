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
        medicamentos: Array,

    },

    setup() {

        const eliminarMedicamento = (data) => {
            data._method = "DELETE";
            Inertia.post("/medicamentos/" + data.id, data);
        };

        return { eliminarMedicamento }
    }

}
</script>
<template>
    <div>

        <Head title="Medicamentos" />
        <!-- header -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Medicamentos</span>
            </h1>
            <Link :href="route('medicamentos.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- filter area -->
        <!-- table -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead>
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">residente</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">medicamento</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">descripcion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">dosis</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">indicaciones</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">efectos secundarios</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">presentacion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">horario</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr v-for="medicamento in medicamentos" :key="medicamento.id" v-if="medicamentos.length"
                        class="text-center shadow group">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ medicamento.residente.persona.nombres }}
                            {{ medicamento.residente.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.nombre }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.descripcion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.dosis }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.indicaciones }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.efectos_secundarios }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ medicamento.presentacione.nombre }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-for="horario in medicamento.horarios"
                                class="inline-block p-1 mx-1 rounded-lg text-white font-bold bg-gradient-to-r from-indigo-400 to-indigo-500 ">
                                {{ horario.hora }}
                            </span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('medicamentos.edit', medicamento.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="eliminarMedicamento(medicamento)">
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