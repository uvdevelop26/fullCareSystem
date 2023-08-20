
<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Pagination from '../../Shared/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        Pagination
    },

    props: {
        ingresos: Array
    },


    setup() {


        //ELIMINAR INGRESO

        const eliminarIngreso = (data) => {
            data._method = "DELETE";
            Inertia.post('/ingresos/' + data.id, data)
        }


        return { eliminarIngreso }
    }

}
</script>
<template>
    <div>

        <Head title="Ingresos" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Ingresos</span>
            </h1>
            <Link :href="route('ingresos.create')"
                class="px-5 py-1 md:px-12 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo ">
            <Icon name="plus" class="w-4 h-4 inline fill-white mr-1" />
            Nuevo
            </Link>
        </div>
        <!-- FILTER AREA -->


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
                    <tr v-for="ingreso in ingresos" :key="ingreso.id" class="text-center shadow group"
                        v-if="ingresos.length">
                        <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            {{ ingreso.fecha_ingreso }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ ingreso.concepto }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ ingreso.detalle }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ ingreso.monto }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ ingreso.nro_comprobante }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="block text-indigo-400 font-semibold"> {{ ingreso.categoria.nombre}}
                            </span>
                            {{ ingreso.categoria.descripcion }}
                        </td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ ingreso.user.username }}
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <div class="w-full h-full flex items-center">
                                <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full hover:shadow-md"
                                    :href="route('ingresos.edit', ingreso.id)">
                                <icon name="edit" class="w-3 h-3 fill-textColor" />
                                </Link>
                                <button class="inline-block px-3 py-3 rounded-full bg-softIndigo hover:shadow-md"
                                    @click="eliminarIngreso(ingreso)">
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