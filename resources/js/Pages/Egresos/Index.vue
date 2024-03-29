<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'
import SearchInput from '../../Shared/SearchInput.vue';
import SelectInput from '../../Shared/SelectInput.vue';
import Icon from '../../Shared/Icon.vue'
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
        egresos: Array,
        categorias: Array,
        filters: Object,
        flash: Object
    },



    setup(props) {

        const openModal = ref(false);

        const catchData = ref();

        const flashMessage = ref(null);

        //Objetos para búsqueda
        const Datayears = () => {
            const years = [];
            for (let i = 2009; i <= 2030; i++) {
                years.push(i);
            }

            return years;
        }

        const showYears = Datayears();

        const meses = [
            { id: 1, mes: 'enero' },
            { id: 2, mes: 'febrero' },
            { id: 3, mes: 'marzo' },
            { id: 4, mes: 'abril' },
            { id: 5, mes: 'mayo' },
            { id: 6, mes: 'junio' },
            { id: 7, mes: 'julio' },
            { id: 8, mes: 'agosto' },
            { id: 9, mes: 'septiembre' },
            { id: 10, mes: 'octubre' },
            { id: 11, mes: 'noviembre' },
            { id: 12, mes: 'diciembre' }]

        //Busqueda
        const form = reactive({
            search_comprobante: props.filters.search_comprobante,
            search_categoria: props.filters.search_categoria,
            search_anho: props.filters.search_anho,
            search_mes: props.filters.search_mes

        });

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('egresos.index', Object.keys(query).length ? query : {}))
        });

        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //ELIMINAR EGRESO
        const eliminarEgreso = () => {

            catchData.value._method = "DELETE";
            Inertia.post('/egresos/' + catchData.value.id, catchData.value, {
                preserveState: false
            });

            openModal.value = false;
        }

        //LIMPIAR CAMPOS
        const limpiarCampos = () => {
            form.search_comprobante = null
            form.search_categoria = null
            form.search_anho = null
            form.search_mes = null
        }

        //FLASH MESSAGES
        onMounted(() => {
            flashMessage.value = props.flash.success
        })

        return { eliminarEgreso, form, showYears, meses, catchData, openModal, showModal, limpiarCampos, flashMessage }
    }

}
</script>
<template>
    <div>

        <Head title="Egresos" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Egresos</span>
            </h1>
            <Link :href="route('egresos.create')"
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
                        <search-input id="comprobante" label="Comprobante N°" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_comprobante" />
                        <select-input id="categoria" label="Categoria" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_categoria">
                            <option :value="null" />
                            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id"
                                class="text-sm">
                                {{ categoria.nombre }}
                            </option>
                        </select-input>
                        <div class="flex gap-2 w-full lg:w-1/2">
                            <select-input id="anhos" label="Año" class="text-sm pb-1 lg:pr-3 w-full"
                                v-model="form.search_anho">
                                <option :value="null" />
                                <option v-for="years in showYears" :key="years" :value="years" class="text-sm">
                                    {{ years }}
                                </option>
                            </select-input>
                            <select-input id="mes" label="Mes" class="text-sm pb-1 lg:pr-3 w-full"
                                v-model="form.search_mes">
                                <option :value="null" />
                                <option v-for="mes in meses" :key="mes.id" :value="mes.id" class="capitalize text-sm">
                                    {{ mes.mes }}
                                </option>
                            </select-input>
                        </div>
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
                <thead>
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Fecha</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Concepto</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Detalle</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Monto</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Comprobante Nro</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Categoria</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Usuario</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr v-for="egreso in egresos" :key="egreso.id" class="text-center shadow group" v-if="egresos.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ egreso.fecha }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ egreso.concepto }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                           <p class="w-64 whitespace-normal mx-auto"> {{ egreso.detalle }}</p>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ egreso.monto }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ egreso.nro_comprobante }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block underline capitalize font-semibold"> {{ egreso.categoria.nombre }}
                            </span>
                             
                            <p class="w-64 whitespace-normal mx-auto">{{ egreso.categoria.descripcion }}</p>

                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ egreso.user.username }}
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('egresos.edit', egreso.id)">
                                <icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="showModal(egreso)">
                                    <icon name="delete" class="w-3 h-3 fill-white" />
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
                    Eliminar Egreso
                </div>
            </template>
            <template v-slot:content>
                <div v-if="catchData">
                    ¿Está seguro que desea eliminar este Egreso?
                </div>
            </template>
            <template v-slot:footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                    <button @click="eliminarEgreso()"
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