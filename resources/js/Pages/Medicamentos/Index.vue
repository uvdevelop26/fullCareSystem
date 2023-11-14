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
        medicamentos: Array,
        filters: Object,
        flash: Object
    },

    setup(props) {

        const openModal = ref(false);

        const catchData = ref();

        const flashMessage = ref(null)

        //BUSQUEDA
        const form = reactive({
            search_nombre: props.filters.search_nombre,
            search_residente: props.filters.search_residente,
        });

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('medicamentos.index', Object.keys(query).length ? query : {}))
        });


        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //eliminar
        const eliminarMedicamento = () => {

            catchData.value._method = "DELETE";
            Inertia.post('/medicamentos/' + catchData.value.id, catchData.value);

            openModal.value = false;
        }

        //LIMPIAR CAMPOS
        const limpiarCampos = ()=>{
            form.search_nombre = null
            form.search_residente = null
            
        }

        //FLASH MESSAGE
        onMounted(()=>{
            flashMessage.value = props.flash.success
        })


        return { eliminarMedicamento, form, showModal, openModal, catchData, limpiarCampos, flashMessage }
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
        <div class="py-2">
            <filters>
                <div class="py-3 px-3 border border-turquesa rounded-md">
                    <div class=" lg:flex lg:flex-wrap">
                        <search-input id="medicamentos" label="Medicamento" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_nombre" />
                        <search-input id="Residente" label="Nombres, Apellidos o C.I"
                            class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2" v-model="form.search_residente" />
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
                            <span v-for="horario in medicamento.horario_medicamentos"
                                class="inline-block px-3 py-1 mr-2 rounded-2xl border border-softIndigo text-softIndigo bg-indigo-100">
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
                                    @click="showModal(medicamento)">
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
            <!-- MODAL PARA ELIMINAR -->
            <dialog-modal :show="openModal">
                <template v-slot:title>
                    <div class="font-bold">
                        Eliminar Medicamentos
                    </div>
                </template>
                <template v-slot:content>
                    <div v-if="catchData">
                        ¿Está seguro que desea eliminar el medicamento {{ catchData.nombre }}?
                    </div>
                </template>
                <template v-slot:footer>
                    <div>
                        <button @click="openModal = false" class="btn-cancelar">
                            Cancelar
                        </button>
                        <button @click="eliminarMedicamento()"
                            class="px-6 py-3 text-white text-sm leading-4 rounded-md bg-red-400 hover:bg-red-300 font-bold whitespace-nowrap focus:bg-red-400">
                            Eliminar
                        </button>
                    </div>
                </template>
            </dialog-modal>
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