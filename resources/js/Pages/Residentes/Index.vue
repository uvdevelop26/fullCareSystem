<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue';
import Pagination from '../../Shared/Pagination.vue'
import Card from '../../Shared/Card.vue';
import SelectInput from '../../Shared/SelectInput.vue';
import Filters from '../../Shared/Filters.vue'
import { watchEffect, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { pickBy } from 'lodash';



export default {
    layout: LayoutApp,

    components: {
        Link,
        Icon,
        Pagination,
        Card,
        Icon,
        Head,
        SelectInput,
        SearchInput,
        Filters
    },

    props: {
        residentes: Array,
        ciudades: Array,
        estado_residentes: Array,
        filters: Object

    },
    setup(props) {

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
            search_estado: props.filters.search_estado,
            search_sexo: props.filters.search_sexo
        })

        watchEffect(() => {
            const query = pickBy(form);
            Inertia.replace(route('residentes.index', Object.keys(query).length ? query : {}));
        });

        //ELIMINAR RESIDENTE

        const eliminarResidente = (data) => {
            data._method = "DELETE";
            Inertia.post('/residentes/' + data.id, data);
        }

        //INFO PARA CARD - USAR REACTIVE O COMPUTED

        return { form, urlbase, eliminarResidente }
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
                        <search-input id="nombre" label="Nombres, Apellidos o C.I" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search" />
                        <select-input id="ciudades" label="Ciudad" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_ciudad">
                            <option :value="null" />
                            <option v-for="ciudad in ciudades" :key="ciudad.id" :value="ciudad.id" class="capitalize">
                                {{ ciudad.nombre_ciudad }}
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
                        <select-input id="estado" label="Estado" class="text-sm pb-1 lg:pr-3 w-full lg:w-1/2"
                            v-model="form.search_estado">
                            <option :value="null" />
                            <option v-for="estado_residente in estado_residentes" :key="estado_residente.id" :value="estado_residente.id" class="capitalize">
                                {{ estado_residente.nombre_estado }}
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
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.persona.sexo }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block text-indigo-400 font-semibold"> {{ residente.persona.ciudade.nombre_ciudad }}
                            </span>
                            {{ residente.persona.direccion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">{{ residente.fecha_ingreso }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="inline-block px-3 py-1 rounded-2xl"
                                :class="[residente.estado_residente.nombre_estado === 'activo' ? 'border border-softIndigo text-softIndigo bg-indigo-100' : 'border border-red-500 text-red-500 bg-red-100']">
                                {{ residente.estado_residente.nombre_estado }}
                            </span>     
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('residentes.edit', residente.id)">
                                <Icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="eliminarResidente(residente)">
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
        <!-- PAGINACIÓN -->
        <!--   <pagination class="mt-6" :links="residentes.links" /> -->
        <!-- INFORMACIÓN ADICIONAL -->
        <div class="py-8 md:flex md:justify-evenly md:gap-3 md:overflow-x-auto">
            <!-- <Card>
                <template #icon-header>
                    <div class="bg-indigo-50 inline-block border border-indigo-400 p-4 rounded-md">
                        <Icon name="residentes" class="w-7 h-7 fill-indigo-400" />
                    </div>
                </template>
                <div class="">
                    <h2 class="font-bold text-lg text-turquesa capitalize"></h2>
                    <ul class="flex">
                        <li class="pr-2">
                            li
                        </li>
                    </ul>
                </div>
            </Card> -->
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
