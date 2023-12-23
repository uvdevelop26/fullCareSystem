<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import Icon from '../../Shared/Icon.vue';
import FlashMessages from '../../Shared/FlashMessages.vue';
import { ref, onMounted } from 'vue'
import DialogModal from '../../Components/DialogModal.vue'
import { Inertia } from '@inertiajs/inertia';
import Filters from '../../Shared/Filters.vue';
import { watchEffect, reactive } from 'vue';
import { pickBy } from 'lodash';
import SearchInput from '../../Shared/SearchInput.vue';
import SelectInput from '../../Shared/SelectInput.vue';

export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        FlashMessages,
        DialogModal,
        Filters,
        SearchInput,
        SelectInput
    },

    props: {
        estados: Array,
        flash: Object,
        filters: Object

    },


    setup(props) {

        const openModal = ref(false);

        const flashMessage = ref(null)

        const catchData = ref(null);

        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_estado: props.filters.search_estado,
        })

        watchEffect(() => {
            const query = pickBy(form, (value) => value !== null && value !== undefined);
            Inertia.replace(route('estados.index', Object.keys(query).length ? query : {}));

        });

        //eliminar estado
        const eliminarEstado = () => {
            catchData.value._method = "DELETE";
            Inertia.post('/estados/' + catchData.value.id, catchData.value, {
                preserveState: false
            });

            openModal.value = false;
        }

        //limpiar campos

        const limpiarCampos = async () => {
            form.search = null
            form.search_estado = null

        }


        onMounted(() => {
            flashMessage.value = props.flash.success
        })



        return { flashMessage, showModal, eliminarEstado, catchData, openModal, form, limpiarCampos }


    }



}
</script>
<template>
    <div>

        <Head title="estados" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Estado Residentes</span>
            </h1>
            <Link :href="route('estados.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- filters -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class=" lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombres o Apellidos o C.I"
                            class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" v-model="form.search" />
                        <select-input id="estado" label="Estado" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_estado">
                            <option :value="null" />
                            <option class="text-sm" :value="1">
                                Activo
                            </option>
                            <option class="text-sm" :value="2">
                                Inactivo
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

        <!-- flash messages -->
        <flash-messages :flashMessage="flashMessage" />

        <!-- TABLE -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Apellidos</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">CI</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha Ingreso</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Estado</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Motivo Salida</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha Salida </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha Regreso</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="estado in estados" :key="estado.id" v-if="estados.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ estado.residente.persona.nombres }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ estado.residente.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ estado.residente.persona.ci_numero }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ estado.residente.fecha_ingreso }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span v-if="estado.nombre == 1" class="font-semibold ">Activo</span>
                            <span v-else class="font-semibold ">Inactivo</span>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <p class="w-64 whitespace-normal mx-auto">{{ estado.motivo_salida }}</p>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ estado.fecha_salida }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ estado.fecha_regreso }}
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <button class="inline-block px-3 py-3 mx-auto rounded-full bg-softIndigo hover:shadow-md"
                                    @click="showModal(estado)">
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
                    Anular Estado
                </div>
            </template>
            <template v-slot:content>
                <div v-if="catchData">
                    ¿Está seguro que desea eliminar el estado del residente {{ catchData.residente.persona.nombres }} {{
                        catchData.residente.persona.apellidos }}?
                </div>
            </template>
            <template v-slot:footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                    <button @click="eliminarEstado()"
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
