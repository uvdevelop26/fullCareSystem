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
import DialogModal from '../../Components/DialogModal.vue'
import { ref, onMounted } from 'vue';
import FlashMessages from '../../Shared/FlashMessages.vue';


export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        SearchInput,
        SelectInput,
        Filters,
        DialogModal,
        FlashMessages
    },

    props: {
        jornadas: Array,
        turnos: Array,
        filters: Object,
        auth: Object,
        flash: Object
    },


    setup(props) {

        const openModal = ref(false);

        const catchData = ref();

        const flashMessage = ref(null)

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_turno: props.filters.search_turno
        })

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('jornadas.index', Object.keys(query).length ? query : {}));
        });

        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //ELIMINAR TURNO
        const eliminarJornada = () => {

            catchData.value._method = "DELETE";
            Inertia.post('/jornadas/' + catchData.value.id, catchData.value);

            openModal.value = false;
        }

        //LIMPIAR CAMPOS
        const limpiarCampos = () => {
            form.search = null
            form.search_turno = null
        }

        //LIMPIAR CAMPOS
        onMounted(() => {
            flashMessage.value = props.flash.success
        });


        return { eliminarJornada, form, openModal, catchData, showModal, limpiarCampos, flashMessage }
    }

}
</script>
<template>
    <div>

        <Head title="Turnos" />

        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Jornadas Laborales</span>
            </h1>
            <Link :href="route('jornadas.create')" v-if="auth.role === 'admin'"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- FILTER AREA -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class="lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombres, Apellidos o C.I"
                            class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" v-model="form.search" />
                        <select-input id="turno" label="Turno" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_turno">
                            <option :value="null" />
                            <option v-for="turno in turnos" :key="turno.id" :value="turno.id" class="capitalize">
                                {{ turno.nombre_turnos }}
                            </option>
                        </select-input>
                    </div>
                    <div class="py-3 text-right">
                        <button class="btn-indigo mx-1 hover:bg-softIndigo" type="button" @click="limpiarCampos()">
                            Limpiar
                        </button>
                    </div>
                </div>
            </filters>
        </div>
        <!-- flash message -->
        <flash-messages :flashMessage="flashMessage" />
        <!-- TABLE -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Apellidos </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">C.I. </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Turno</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Entrada</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Salida</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Dias</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="jornada in jornadas" :key="jornada.id"
                        v-if="jornadas.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ jornada.empleado.persona.nombres }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ jornada.empleado.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ jornada.empleado.persona.ci_numero }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ jornada.turno.nombre_turnos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ jornada.turno.hora_entrada }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ jornada.turno.hora_salida }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-for="dias in jornada.dias"
                                class="inline-block px-3 py-1 mr-2 rounded-2xl border border-softIndigo text-softIndigo bg-indigo-100">
                                {{ dias.nombre_dias }}
                            </span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center justify-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('jornadas.edit', jornada.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="showModal(jornada)">
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
        <!-- MODAL PARA ELIMINAR -->
        <dialog-modal :show="openModal">
            <template v-slot:title>
                <div class="font-bold">
                    Eliminar Jornada
                </div>
            </template>
            <template v-slot:content>
                <div v-if="catchData">
                    ¿Está seguro que desea eliminar esta jornada?
                </div>
            </template>
            <template v-slot:footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                    <button @click="eliminarJornada()"
                        class="px-6 py-3 text-white text-sm leading-4 rounded-md bg-red-400 hover:bg-red-300 font-bold whitespace-nowrap focus:bg-red-400">
                        Eliminar
                    </button>
                </div>
            </template>
        </dialog-modal>
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

