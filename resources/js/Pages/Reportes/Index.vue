<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Icon from '../../Shared/Icon.vue';
import { reactive, ref } from 'vue';
import TextInput from "../../Shared/TextInput.vue";

export default {

    layout: LayoutApp,

    components: {
        Head,
        Icon,
        TextInput
    },

    props: {
        residentes: Number
    },

    setup() {

        const form = reactive({
            mes: 0,
            anho: 0
        })

        const controlMed = ref('00-00-00');

        const controlRut = ref('00-00-00')



        //años
        const Datayears = () => {
            const years = [];
            for (let i = 2009; i <= 2025; i++) {
                years.push(i);
            }

            return years;
        }

        const showYears = Datayears();

        //mes
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



        return { showYears, meses, form, controlMed, controlRut }

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

        <div class="pt-3 pb-12 mb-3 border-b max-w-7xl flex flex-wrap gap-4 justify-center lg:justify-start lg:items-start">
            <!-- residentes -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden  max-w-xs">
                <a :href="route('reportes.residentespdf')" target="_blank">
                    <div class="py-2 px-3 bg-green-400 flex items-center">
                        <Icon name="residentes" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Residentes</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-green-400" />
                    </div>
                </a>
            </div>
            <!-- Estados de Residentes -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden  max-w-xs">
                <a :href="route('reportes.estadospdf')" target="_blank">
                    <div class="py-2 px-3 bg-softIndigo flex items-center">
                        <Icon name="search" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Estados de Residentes</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-softIndigo" />
                    </div>
                </a>
            </div>
            <!-- empleados -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.empleadospdf')" target="_blank">
                    <div class="py-2 px-3 bg-cyan-400 flex items-center">
                        <Icon name="empleados" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Empleados</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-cyan-400" />
                    </div>
                </a>
            </div>
            <!-- jornadas Laborales -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <a :href="route('reportes.jornadaspdf')" target="_blank">
                    <div class="py-2 px-3 bg-indigo-400 flex items-center">
                        <Icon name="jornadas" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Jornadas</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-indigo-400" />
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
                    <div class="py-2 px-3 bg-rose-400 flex items-center">
                        <Icon name="medicine" class="w-7 h-7 mr-5 fill-white" />
                        <span class="text-white inline-block font-bold">Medicamentos</span>
                    </div>
                    <div class="flex justify-between py-4 px-3">
                        <span class="inline-block font-bold ">Imprimir Reporte</span>
                        <Icon name="pdf" class="w-7 h-7 mr-5 fill-rose-400" />
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
        <div class="pt-3 pb-12 mb-3 border-b max-w-7xl flex flex-wrap gap-4 justify-center lg:justify-start lg:items-center">
            <!-- sueldos -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <div class="py-2 px-3 bg-teal-400 flex items-center">
                    <Icon name="sueldos" class="w-7 h-7 mr-5 fill-white" />
                    <span class="text-white inline-block font-bold">Sueldos</span>
                </div>
                <div class="py-4 px-3">
                    <label for="mes">Mes:</label>
                    <select name="mes" id="mes" class="w-full h-8 py-0 border-teal-400 rounded-md text-sm"
                        v-model="form.mes">
                        <option :value="0"></option>
                        <option v-for="mese in meses" :key="mese.id" :value="mese.id">{{ mese.mes }}</option>
                    </select>
                    <label for="anho">Año:</label>
                    <select name="anho" id="anho"
                        class="w-full h-8 py-0 border-teal-400 rounded-md focus:border-turquesa text-sm"
                        v-model="form.anho">
                        <option :value="0"></option>
                        <option v-for="year in showYears" :key="year" :value="year" class="capitalize">{{ year }}</option>
                    </select>
                </div>
                <div class="pb-5 px-3 text-left">
                    <a class="inline-block w-full text-center px-12 py-1 bg-teal-400 rounded-md hover:bg-teal-500 cursor-pointer"
                        target="_blank" :href="route('reportes.sueldospdf', { mes: form.mes, anho: form.anho })">
                        <span class="text-xs mr-3 font-bold text-white">Imprimir</span>
                        <Icon name="pdf" class="w-4 h-4 fill-white inline" />
                    </a>
                </div>
            </div>

            <!-- control de medicamentos -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <div class="py-2 px-3 bg-amber-400 flex items-center">
                    <Icon name="control" class="w-7 h-7 mr-5 fill-white" />
                    <span class="text-white inline-block font-bold">Marcación de Medicamentos</span>
                </div>
                <div class="py-4 px-3">
                    <input type="date" class="w-full h-8 py-0 border-amber-400 rounded-md text-sm" v-model="controlMed">
                </div>
                <div class="pb-5 px-3 text-left">
                    <a class="inline-block w-full text-center px-12 py-1 bg-amber-400 rounded-md hover:bg-amber-500 cursor-pointer"
                        target="_blank" :href="route('reportes.controlMedicamentospdf', controlMed )">
                        <span class="text-xs mr-3 font-bold text-white">Imprimir</span>
                        <Icon name="pdf" class="w-4 h-4 fill-white inline" />
                    </a>
                </div>
            </div>

            <!-- control de rutinas -->
            <div class="bg-white w-2/3 rounded-lg shadow-md border overflow-hidden max-w-xs">
                <div class="py-2 px-3 bg-lime-400 flex items-center">
                    <Icon name="control" class="w-7 h-7 mr-5 fill-white" />
                    <span class="text-white inline-block font-bold">Marcación de Rutinas</span>
                </div>
                <div class="py-4 px-3">
                    <input type="date" class="w-full h-8 py-0 border-lime-400 rounded-md text-sm" v-model="controlRut">
                </div>
                <div class="pb-5 px-3 text-left">
                    <a class="inline-block w-full text-center px-12 py-1 bg-lime-400 rounded-md hover:bg-lime-500 cursor-pointer"
                        target="_blank" :href="route('reportes.controlRutinaspdf', controlRut )">
                        <span class="text-xs mr-3 font-bold text-white">Imprimir</span>
                        <Icon name="pdf" class="w-4 h-4 fill-white inline" />
                    </a>
                </div>
            </div>


        </div>

    </div>
</template>
