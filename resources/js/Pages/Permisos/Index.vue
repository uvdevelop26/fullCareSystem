<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue';
import Pagination from "../../Shared/Pagination.vue";
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue';
import { watchEffect, reactive } from 'vue';
import { Inertia } from "@inertiajs/inertia";
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
        Pagination,
        SelectInput,
        SearchInput,
        Filters,
        DialogModal,
        FlashMessages
    },

    props: {
        permisos: Array,
        estadoVariaciones: Array,
        filters: Object,
        flash: Object
    },

    setup(props) {

        const openModal = ref(false);

        const catchData = ref();

        const flashMessage = ref(null)

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_estado: props.filters.search_estado,
        });

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('permisos.index', Object.keys(query).length ? query : {}))
        });

        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //ELIMINAR FAMILIAR
        const eliminarPermiso = () => {

            catchData.value._method = "DELETE";
            Inertia.post('/permisos/' + catchData.value.id, catchData.value, {
                preserveState: false
            });

            openModal.value = false;
        }


        //LIMPIAR CAMPOS
        const limpiarCampos = () => {
            form.search = null
            form.search_estado = null
        }

        //FLASH MESSAGE
        onMounted(() => {
            flashMessage.value = props.flash.success
        })


        return { eliminarPermiso, form, openModal, catchData, showModal, limpiarCampos, flashMessage }

    }
}
</script>
<template>
    <div>

        <Head title="Permisos" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Permisos</span>
            </h1>
            <Link :href="route('permisos.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- FILTERS -->
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class=" lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombres, Apellidos o C.I"
                            class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" v-model="form.search" />
                        <select-input id="estado" label="Estado" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_estado">
                            <option :value="null" />
                            <option v-for="estadoVariacione in estadoVariaciones" :key="estadoVariacione.id"
                                :value="estadoVariacione.id" class="text-sm">
                                {{ estadoVariacione.nombre_estado }}
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
        <!-- FLASH MESSAGE -->
        <flash-messages :flashMessage="flashMessage" />
        <!-- TABLE -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">CI</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Inicio Permiso</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Fin Permiso</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">duracion Dias</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">motivo</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">estado</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="permiso in permisos" :key="permiso.id"
                        v-if="permisos.length">
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ permiso.empleado.persona.nombres }}
                            {{ permiso.empleado.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ permiso.empleado.persona.ci_numero }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ permiso.fecha_inicio }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ permiso.fecha_fin }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ permiso.duracion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <p class="w-64 whitespace-normal mx-auto">{{ permiso.motivo }}</p>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="font-semibold">
                                {{ permiso.estado_variacione.nombre_estado }}
                            </span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl  bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link :href="route('permisos.edit', permiso.id)"
                                    class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="showModal(permiso)">
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
                    Eliminar Permiso
                </div>
            </template>
            <template v-slot:content>
                <div v-if="catchData">
                    ¿Está seguro que desea eliminar este Permiso?
                </div>
            </template>
            <template v-slot:footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                    <button @click="eliminarPermiso()"
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