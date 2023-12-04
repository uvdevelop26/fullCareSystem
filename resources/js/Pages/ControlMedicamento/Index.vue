<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head } from '@inertiajs/inertia-vue3'
import Filters from '../../Shared/Filters.vue';
import { pickBy } from 'lodash';
import { Inertia } from '@inertiajs/inertia';
import SearchInput from '../../Shared/SearchInput.vue';
import SelectInput from '../../Shared/SelectInput.vue';
import { watchEffect, reactive } from 'vue';
import TextInput from "../../Shared/TextInput.vue";


export default {

    layout: LayoutApp,

    components: {
        Head,
        Filters,
        SearchInput,
        SelectInput,
        TextInput
    },

    props: {
        controlMedicamentos: Array,
        filters: Object
    },

    setup(props) {

        //BUSQUEDA
        const search = reactive({
            search_residente: props.filters.search_residente,
            search_fecha: props.filters.search_fecha

        });

        watchEffect(() => {
            const query = pickBy(search);
            Inertia.replace(route('control-medicamentos.index', Object.keys(query).length ? query : {}));
        })

        //LIMPIAR CAMPOS
        const limpiarCampos = () => {
            search.search_residente = null,
            search.search_fecha = null
        }


        return { search, limpiarCampos }
    }

}
</script>
<template>
    <div>

        <Head title="Control Marcacion" />

        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Marcaciones Diarias</span>
            </h1>
        </div>
        <!-- FILTER AREA -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class="lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombre del Residente" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="search.search_residente" />
                        <text-input type="date" label="Fecha" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" id="name"
                            v-model="search.search_fecha" />
                    </div>
                    <div class="py-3 text-right">
                        <button class="btn-indigo mx-1 hover:bg-softIndigo" type="button" @click="limpiarCampos()">
                            Limpiar
                        </button>
                    </div>
                </div>
            </filters>
        </div>

        <!-- TABLA -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead>
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Fecha</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Residente</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Medicamento</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">hora</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Hora Marcación</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Realizado</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">usuario</th>

                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr v-for="control in controlMedicamentos" :key="control.id" class="text-center shadow group"
                        v-if="controlMedicamentos.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ control.fecha }}
                        </td>
                        <td v-for="residente in control.horario_medicamento.medicamentos"
                            class="py-1 px-1 bg-white group-hover:bg-fondColor">
                            {{ residente.residente.persona.nombres }}
                        </td>
                        <td v-for="medicamentos in control.horario_medicamento.medicamentos"
                            class="py-1 px-1 bg-white group-hover:bg-fondColor">
                            {{ medicamentos.nombre }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ control.horario_medicamento.hora }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ control.hora }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-if="control.realizado == 1"> SI </span>
                            <span v-else> NO </span>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ control.user.username }}
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