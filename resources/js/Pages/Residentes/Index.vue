<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue';
import Pagination from '../../Shared/Pagination.vue'
/* import Card from '../../Shared/Card.vue'; */
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue'
import { computed } from 'vue';
import { watchEffect, reactive, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { pickBy } from 'lodash';



export default {
    layout: LayoutApp,

    components: {
        Link,
        Icon,
        Pagination,
        /*     Card, */
        Icon,
        Head,
        SelectInput,
        SearchInput,
        Filters
    },

    props: {
        residentes: Array,
        residentesData: Array,
        ciudades: Array,
        filters: Object

    },
    setup(props) {
        const residentesData = props.residentesData;



        const form = reactive({
            search: props.filters.search,
            search_ciudad: props.filters.search_ciudad,
            search_estado: props.filters.search_estado,
            search_sexo: props.filters.search_sexo
        })

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('residentes.index', Object.keys(query).length ? query : {}))
        });

        const limpiarCampos = () => {
            form.search = null;
            form.search_ciudad = '';
            form.search_estado = '';
            form.search_sexo = '';
        }


        //info para mostrar en las cards -  puede ser reactive nomas en vez de computed
        const getInfoData = computed(() => {
            const titleg = 'residentes por genero';
            const women = residentesData.filter(item => item.persona.sexo === 'femenino').length;
            const men = residentesData.filter(item => item.persona.sexo === 'masculino').length;
            const total = women + men;

            const titlee = 'residentes por estado';
            const active = residentesData.filter(item => item.estado === 'Activo').length;
            const inactive = residentesData.filter(item => item.estado === 'Inactivo').length;

            return [
                {
                    id: 1, title: titleg, info: [
                        { name: 'mujeres', canti: women },
                        { name: 'hombres', canti: men },
                        { name: 'total', canti: total }
                    ]
                },
                {
                    id: 2, title: titlee, info: [
                        { name: 'activos', canti: active },
                        { name: 'inactivos', canti: inactive }
                    ]
                }
            ]
        })

        return { getInfoData, form, limpiarCampos }
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
                    <div class=" lg:flex lg:flex-wrap">
                        <search-input id="nombre" label="Nombres/Apellidos/CI" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search" />
                        <select-input id="ciudades" label="Ciudad" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                        v-model="form.search_ciudad">
                        <option :value="null" />
                        <option v-for="ciudad in ciudades" :key="ciudad.id" :value="ciudad.id">
                            {{ ciudad.nombre_ciudad }}
                        </option>
                    </select-input>
                    <select-input id="estado" label="Estado" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                        v-model="form.search_estado">
                        <option :value="null" />
                        <option value="activo">
                            Activo
                        </option>
                        <option value="inactivo">
                            Inactivo
                        </option>
                    </select-input>
                    <select-input id="sexo" label="Sexo" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_sexo">
                            <option :value="null" />
                            <option value="femenino">
                                Femenino
                            </option>
                            <option value="masculino">
                                Masculino
                            </option>
                        </select-input>
                    </div>
                    <div class="py-3 text-right">
                        <button class="btn-indigo mx-1" type="button" @click="limpiarCampos()">
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
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Foto</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Nombres</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Cédula </th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Nacimiento</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Telefono</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">edad</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">sexo</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">direccion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Ingreso</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Estado</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Acciones</th>
                    </tr>
                </thead>
                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow group" v-for="residente in residentes" :key="residente.id">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            <img :src="residente.foto" class="w-12 h-12 border-2 border-indigo-400 rounded-full mx-auto"
                                alt="foto">
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
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.sexo }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block text-indigo-400 font-semibold"> {{ residente.persona.ciudade.nombre_ciudad }}
                            </span>
                            {{ residente.persona.direccion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.fecha_ingreso }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="inline-block px-3 py-1 rounded-2xl "
                                :class="[residente.estado === 'Activo' ? 'border border-softIndigo text-softIndigo bg-indigo-100' : 'border border-red-500 text-red-500 bg-red-100']">
                                {{ residente.estado }}
                            </span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md">
                            <Icon name="edit" class="w-3 h-3 fill-textColor" />
                            </Link>
                            <Link class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md">
                            <Icon name="delete" class="w-3 h-3 fill-white" />
                            </Link>
                        </td>
                    </tr>
                </transition-group>
            </table>
        </div>
        <!-- PAGINACIÓN -->
        <!--  <pagination class="mt-6" :links="residentes.links" /> -->
        <!-- INFORMACIÓN ADICIONAL -->
        <!--  <div class="py-8 md:flex md:justify-evenly md:gap-3 md:overflow-x-auto">
                                <Card v-for="item in getInfoData" :key="item.id">
                                    <template #icon-header>
                                        <div class="bg-teal-50 inline-block border border-turquesa p-4 rounded-md">
                                            <Icon name="residentes" class="w-7 h-7 fill-turquesa" />
                                        </div>
                                    </template>
                                    <div class="">
                                        <h2 class="font-bold text-lg text-turquesa capitalize">{{ item.title }}</h2>
                                        <ul class="flex">
                                            <li v-for="info in item.info" :key="info.name" class="pr-2">
                                                <span class="text-sm capitalize mr-1">{{ info.name }}:</span>
                                                <span class="text-sm font-bold text-md">{{ info.canti }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </Card>
                            </div> -->
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
