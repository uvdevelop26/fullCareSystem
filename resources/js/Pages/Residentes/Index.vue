<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue';
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue'
import { watchEffect, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { pickBy } from 'lodash';
import DialogModal from '../../Components/DialogModal.vue'
import { ref } from 'vue';
import { onMounted } from 'vue'
import FlashMessages from '../../Shared/FlashMessages.vue'



export default {
    layout: LayoutApp,

    components: {
        Link,
        Icon,
        Icon,
        Head,
        SelectInput,
        SearchInput,
        Filters,
        DialogModal,
        FlashMessages

    },

    props: {
        residentes: Array,
        ciudades: Array,
        filters: Object,
        flash: Object
    },
    setup(props) {

        const openModal = ref(false);

        const catchData = ref();

        const flashMessage = ref(null)


        //PARA MOSTRAR IMAGEN
        const urlbase = (url) => {
            if (url.includes('https')) {
                return url;
            } else {
                return url.replace('public/', 'storage/')
            }
        }

        //BUSQUEDA
        const form = reactive({
            search: props.filters.search,
            search_ciudad: props.filters.search_ciudad,
            search_sexo: props.filters.search_sexo
        })

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('residentes.index', Object.keys(query).length ? query : {}));
        });

        //MOSTRAR MODAL Y ASIGNAR DATOS
        const showModal = (data) => {
            openModal.value = true;
            catchData.value = data
        }

        //ELIMINAR RESIDENTE
        const eliminarResidente = () => {

            catchData.value._method = "DELETE";
            Inertia.post('/residentes/' + catchData.value.id, catchData.value, {
                preserveState: false,
                preserveScroll: true
            });

            openModal.value = false;
        }

        //limpiar campos

        const limpiarCampos = async () => {
            form.search = null
            form.search_ciudad = null
            form.search_sexo = null

        }

        //flash Messages
        onMounted(() => {
            flashMessage.value = props.flash.success

        })



        return { form, urlbase, eliminarResidente, openModal, catchData, showModal, limpiarCampos, flashMessage }
    }


}

</script>
<template>
    <div>

        <Head title="residentes" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Residentes</span>
            </h1>
            <Link :href="route('residentes.create')"
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
                        <!-- selccionar cuidad -->
                        <select-input id="ciudades" label="Ciudad" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            ref="selectInputComponentCiudad" v-model="form.search_ciudad">
                            <option :value="null" />
                            <option v-for="ciudad in ciudades" :key="ciudad.id" :value="ciudad.id" class="text-sm">
                                {{ ciudad.nombre_ciudad }}
                            </option>
                        </select-input>
                        <!-- selccionar sexo -->
                        <select-input id="sexo" label="Sexo" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                             v-model="form.search_sexo">
                            <option :value="null" />
                            <option class="text-sm" value="femenino">
                                Femenino
                            </option>
                            <option class="text-sm" value="masculino">
                                Masculino
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
        <!-- flash -->
        <flash-messages :flashMessage="flashMessage" class="w-full" />
        <!-- TABLE -->

        <div class="overflow-x-auto py-4 max-w-7xl">
            <table
                class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Foto</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Cédula </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Nacimiento</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Telefono</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">edad</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">sexo</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">direccion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Ingreso</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Habitación N°</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="residente in residentes" :key="residente.id"
                        v-if="residentes.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            <div class="inline-block h-12 w-12 border-2 border-softIndigo rounded-full overflow-hidden">
                                <img :src="urlbase(residente.foto)" class="w-full h-full object-cover" alt="foto">
                            </div>
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ residente.persona.nombres }}
                            {{ residente.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.ci_numero }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.fecha_nacimiento }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.telefono }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.edad }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor capitalize">{{ residente.persona.sexo }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block font-semibold underline"> {{
                                residente.persona.ciudade.nombre_ciudad }}
                            </span>
                          <p class="w-64 whitespace-normal">{{ residente.persona.direccion }}</p>  
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.fecha_ingreso }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.habitacione.numero }}</td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('residentes.edit', residente.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="showModal(residente)">
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
                    Eliminar Residente
                </div>
            </template>
            <template v-slot:content>
                <div v-if="catchData">
                    ¿Está seguro que desea eliminar al residente {{ catchData.persona.nombres }} {{
                        catchData.persona.apellidos }}?
                </div>
            </template>
            <template v-slot:footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                    <button @click="eliminarResidente()"
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
