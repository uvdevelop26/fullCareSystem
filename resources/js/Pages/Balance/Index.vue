<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from '../../Shared/SelectInput.vue';
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from 'vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from 'axios';
import Icon from '../../Shared/Icon.vue';

export default {

    layout: LayoutApp,

    components: {
        TextInput,
        SelectInput,
        Head,
        Link,
        Icon
    },


    setup(props) {

        //DATOS PARA LA BÚSQUEDA
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

        //EXTRAER INFORMACIÓN VIA AXIOS

        const form = ref({
            consulta: "",
            fecha: "",
            mes: "",
            anho: "",
        })

        const movimientosDiarios = ref([]);
        const movimientosMensuales = ref([]);
        const totalIngresosDiarios = ref([]);
        const diferenciaDiario = ref(null)
        const totalEgresosDiarios = ref([]);
        const totalIngresosMensuales = ref([]);
        const totalEgresosMensuales = ref([]);
        const diferenciaMensual = ref(null)


        const fetchData = async () => {
            try {
                const response = await axios.post('obtener-movimientos', form.value);

                if (form.value.consulta == 'diario') {
                    movimientosDiarios.value = response.data;
                    totalIngresosDiarios.value = response.data[response.data.length - 1].total_ingresos_diarios;
                    totalEgresosDiarios.value = response.data[response.data.length - 1].total_egresos_diarios;
                    diferenciaDiario.value = totalIngresosDiarios.value - totalEgresosDiarios.value;

                } else if (form.value.consulta == 'mensual') {
                    movimientosMensuales.value = response.data;
                    totalIngresosMensuales.value = response.data[response.data.length - 1].total_ingresos_mensuales;
                    totalEgresosMensuales.value = response.data[response.data.length - 1].total_egresos_mensuales;
                    diferenciaMensual.value = totalIngresosMensuales.value - totalEgresosMensuales.value;
                }
            } catch (error) {
                console.error('Error al obtener datos', error);
            }
        }





        return {
            meses,
            showYears,
            form,
            fetchData,
            movimientosDiarios,
            movimientosMensuales,
            totalIngresosDiarios,
            totalEgresosDiarios,
            diferenciaDiario,
            totalIngresosMensuales,
            totalEgresosMensuales,
            diferenciaMensual
        }
    }

}
</script>
<template>
    <div>

        <Head title="Balance" />
        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Balance</span>
            </h1>
        </div>
        <!-- FORMULARIO -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="fetchData">
                <div class="py-3 px-3  bg-white border rounded-md">
                    <div class="lg:flex">
                        <div class="lg:w-1/2">
                            <input type="radio" v-model="form.consulta" name="consulta" id="diario" value="diario">
                            <label for="diario"> Consulta Diaria</label>
                            <text-input type="date" v-model="form.fecha" label="Fecha" class="pb-5 lg:pr-3 w-full"
                                id="fecha" :disabled="form.consulta !== 'diario'" />
                        </div>
                        <div class="lg:w-1/2">
                            <input type="radio" v-model="form.consulta" name="consulta" id="mensual" value="mensual">
                            <label for="mensual"> Consulta Mensual</label>
                            <select-input id="mes" v-model="form.mes" label="Mes" class="text-sm pb-1 lg:pr-3 w-full"
                                :disabled="form.consulta !== 'mensual'">
                                <option :value="null" />
                                <option v-for="mes in meses" :key="mes.id" :value="mes.id" class="capitalize">
                                    {{ mes.mes }}
                                </option>
                            </select-input>
                            <select-input id="anhos" v-model="form.anho" label="Año" class="text-sm pb-1 lg:pr-3 w-full"
                                :disabled="form.consulta !== 'mensual'">
                                <option :value="null" />
                                <option v-for="years in showYears" :key="years" :value="years">
                                    {{ years }}
                                </option>
                            </select-input>
                        </div>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <button class="btn-indigo mx-1" type="submit">
                            Consultar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- TABLE 1 -->
        <div class="overflow-x-auto py-4 max-w-7xl lg:flex lg:gap-3">
            <div class="lg:w-1/2">
                <table
                    class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                    <thead class="">
                        <tr class="capitalize shadow">
                            <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Concepto</th>
                            <th class="py-3 px-4 bg-turquesa text-white font-bold">Fecha</th>
                            <th class="py-3 px-4 bg-turquesa text-white font-bold">Ingreso</th>
                            <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Egreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center shadow group" v-for="movimiento in movimientosDiarios">
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                                {{ movimiento.concepto }}
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                                {{ movimiento.fecha }}
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                                {{ movimiento.monto_ingreso }} <span v-if="movimiento.monto_ingreso">Gs.</span>
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-r-xl">
                                {{ movimiento.monto_egreso }} <span v-if="movimiento.monto_egreso">Gs.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-2">
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="total_ingresos_dias" class="text-xs mr-2 font-bold">Total Ingresos del
                            Día:</label>
                        <input type="text" name="total_ingresos_dias" id="total_ingresos_dias"
                            class="border-turquesa rounded-md w-44 h-7" v-model="totalIngresosDiarios" disabled>
                    </div>
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="total_egresos_dias" class="text-xs mr-2 font-bold">Total Egresos del
                            Día:</label>
                        <input type="text" name="total_egresos_dias" id="total_egresos_dias"
                            class="border-turquesa rounded-md w-44 h-7" v-model="totalEgresosDiarios" disabled>
                    </div>
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="diferencia" class="text-xs mr-2 font-bold">Diferencia:</label>
                        <input type="text" name="diferencia" id="total_egresos_dias"
                            class="border-turquesa rounded-md w-44 h-7" v-model="diferenciaDiario"  disabled>
                    </div>
                    <div class="pb-2 lg:text-right">
                        <a class="inline-block px-8 py-1 bg-indigo-400 rounded-md hover:bg-softIndigo cursor-pointer"
                            target="_blank" :href="route('balance-diario.diariopdf', form.fecha)">
                            <span class="text-xs mr-3 font-bold text-white">Imprimir</span>
                            <Icon name="pdf" class="w-4 h-4 fill-white inline" />
                        </a>
                    </div>
                </div>
            </div>
            <!-- TABLE 2 -->
            <div class="lg:w-1/2">
                <table
                    class="w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                    <thead class="">
                        <tr class="capitalize shadow">
                            <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Concepto</th>
                            <th class="py-3 px-4 bg-turquesa text-white">Fecha</th>
                            <th class="py-3 px-4 bg-turquesa text-white font-bold">Ingreso</th>
                            <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold">Egreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center shadow group" v-for="movimiento in movimientosMensuales">
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                                {{ movimiento.concepto }}
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor">
                                {{ movimiento.fecha }}
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor">
                                {{ movimiento.monto_ingreso }} <span v-if="movimiento.monto_ingreso">Gs.</span>
                            </td>
                            <td class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-r-xl">
                                {{ movimiento.monto_egreso }} <span v-if="movimiento.monto_egreso">Gs.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="py-2">
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="total_ingresos_mes" class="text-xs mr-2 font-bold">Total Ingresos del
                            Mes:</label>
                        <input type="text" name="total_ingresos_mes" id="total_ingresos_mes"
                            class="border-turquesa rounded-md w-44 h-7" v-model="totalIngresosMensuales" disabled>
                    </div>
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="total_egresos_mes" class="text-xs mr-2 font-bold">Total Egresos del
                            Mes:</label>
                        <input type="text" name="total_egresos_mes" id="total_egresos_mes"
                            class="border-turquesa rounded-md w-44 h-7" v-model="totalEgresosMensuales" disabled>
                    </div>
                    <div class="pb-2 flex justify-between items-center xl:justify-end">
                        <label for="diferencia" class="text-xs mr-2 font-bold">Diferencia:</label>
                        <input type="text" name="diferencia" id="total_egresos_dias"
                            class="border-turquesa rounded-md w-44 h-7" v-model="diferenciaMensual"   disabled>
                    </div>
                    <div class="pb-2 lg:text-right">
                        <a class="inline-block px-8 py-1 bg-indigo-400 rounded-md hover:bg-softIndigo cursor-pointer"
                            target="_blank" :href="route('balance-mensual.mensualpdf', { mes: form.mes, anho: form.anho })">
                            <span class="text-xs mr-3 font-bold text-white">Imprimir</span>
                            <Icon name="pdf" class="w-4 h-4 fill-white inline" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- <style scoped>
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
</style> -->