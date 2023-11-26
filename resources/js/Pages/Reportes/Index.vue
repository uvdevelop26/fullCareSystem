<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Icon from '../../Shared/Icon.vue';

export default {

    layout: LayoutApp,

    components: {
        Head,
        Icon
    },

    props: {
        residentes: Number
    }


}
</script>
<template>
    <div>

        <Head title="Reportes" />

        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Reportes</span>
            </h1>
        </div>

        <!-- CARDS -->
        <!-- residentes -->
        <div class="py-3 mb-3 max-w-7xl flex flex-wrap gap-4 justify-center lg:justify-start">
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden  max-w-xs">
                <a :href="route('reportes.residentespdf')" target="_blank">
                    <div class="py-2 px-3 bg-indigo-400 flex items-center">
                        <Icon name="residentes" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Residentes</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-indigo-400" />
                    </div>
                </a>
            </div>
            <!-- empleados -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.empleadospdf')" target="_blank">
                    <div class="py-2 px-3 bg-red-400 flex items-center">
                        <Icon name="empleados" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Empleados</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-red-400" />
                    </div>
                </a>
            </div>
            <!-- jornadas Laborales -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.jornadaspdf')" target="_blank">
                    <div class="py-2 px-3 bg-green-400 flex items-center">
                        <Icon name="jornadas" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Jornadas</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-green-400" />
                    </div>
                </a>
            </div>
            <!-- usuarios -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.usuariospdf')" target="_blank">
                    <div class="py-2 px-3 bg-orange-400 flex items-center">
                        <Icon name="usuarios" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Usuarios</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-orange-400" />
                    </div>
                </a>
            </div>
            <!-- Medicamentos -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.medicamentospdf')" target="_blank">
                    <div class="py-2 px-3 bg-teal-400 flex items-center">
                        <Icon name="medicine" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Medicamentos</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-teal-400" />
                    </div>
                </a>
            </div>
            <!-- rutinas -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.rutinaspdf')" target="_blank">
                    <div class="py-2 px-3 bg-sky-400 flex items-center">
                        <Icon name="rutinas" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Rutinas</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-sky-400" />
                    </div>
                </a>
            </div>

        </div>

    </div>
</template>
