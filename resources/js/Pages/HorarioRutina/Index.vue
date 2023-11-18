<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import FlashMessages from '../../Shared/FlashMessages.vue';
import { ref, onMounted } from 'vue'


export default {

    layout: LayoutApp,

    components:{
        FlashMessages
    },

    props: {
        horarioRutinas: Array,
        flash: Object,
        errors: Object
    },

    setup(props) {

        const flashMessage = ref(null)

        const error = ref(null)

        //PARA MOSTRAR IMAGEN
        const urlbase = (url) => {
            if (url.includes('https')) {
                return url;
            } else {
                return url.replace('public/', 'storage/')
            }
        }

        //datos para enviar al formulario

        const getfullDate = () => {

            const fechaActual = new Date();

            const fechaMarcacion = fechaActual.toISOString().slice(0, 10);

            return fechaMarcacion;
        }

        const getfullHour = () => {
            const fechaActual = new Date();

            const horaMarcacion = fechaActual.toTimeString().slice(0, 8);

            return horaMarcacion;

        }

        //variables para guardar datos
        const form = useForm({
            fecha: "",
            hora: "",
            realizado: false,
            user_id: "",
            horario_rutina_id: ""

        });

        //enviar al formulario
        const realizarMarcacion = (data) => {
            form.fecha = getfullDate();
            form.hora = getfullHour();
            form.realizado = true,
                form.horario_rutina_id = data

            form.post(route('horario-rutinas.store'), {
                forceFormData: true,
                preserveState: false
            });

        }


        //config. flash messages
        onMounted(()=>{

            flashMessage.value = props.flash.success

            error.value = props.errors.horario_rutina_id
        });




        return { urlbase, realizarMarcacion, flashMessage, error }
    }

}
</script>
<template>
    <div>

        <Head title="Controlar Medicaciones" />

        <!-- HEADER -->
        <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
            <h1 class="uppercase">
                <span class="text-turquesa text-2xl font-semibold">Control de Rutinas</span>
            </h1>
        </div>
        <!-- FILTRO -->

        <!-- FLASH MESSAGES -->
        <flash-messages :flashMessage="flashMessage" :error="error" />

        <!-- TABLA DESKTOP -->
        <div class="overflow-x-auto py-4 max-w-7xl">
            <!-- DESKTOP -->
            <table
                class="hidden md:block w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden">
                <thead class="">
                    <tr class="capitalize shadow">
                        <th class="py-3 px-4 bg-turquesa rounded-l-xl text-white font-bold">Residente</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Rutina</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">descripcion</th>
                        <th class="py-3 px-4 bg-turquesa text-white font-bold">Horarios</th>
                        <th class="py-3 px-4 bg-turquesa rounded-r-xl text-white font-bold"> Marcacion Diaria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(horario, index) in horarioRutinas" :key="horario.id" class="text-center shadow group">
                        <td v-for="residente in horario.rutinas"
                            class="py-1 px-1 bg-white group-hover:bg-fondColor rounded-l-xl">
                            <div class="inline-block h-12 w-12 border-2 border-softIndigo rounded-full overflow-hidden">
                                <img :src="urlbase(residente.residente.foto)" class="w-full h-full object-cover" alt="foto">
                            </div>
                            <div> {{ residente.residente.persona.nombres }} {{ residente.residente.persona.apellidos }}
                            </div>
                        </td>
                        <td v-for="rutina in horario.rutinas" class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            {{ rutina.nombre }}</td>
                        <td v-for="descripcion in horario.rutinas" class="py-2 px-2 bg-white group-hover:bg-fondColor">{{
                            descripcion.descripcion }}</td>
                        <td class="py-2 px-2 bg-white group-hover:bg-fondColor">
                            <span class="text-indigo-400 font-bold"> {{ horario.hora }}</span>
                        </td>
                        <td class="py-2 px-2 rounded-r-xl bg-white group-hover:bg-fondColor">
                            <button
                                class="inline-block font-bold text-indigo-500 bg-indigo-200 py-2 px-3 border border-indigo-500 rounded-2xl hover:bg-indigo-400 hover:text-white"
                                @click="realizarMarcacion(horario.id)">Realizado</button>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            <!-- MOBILE -->
            <div class="w-full md:hidden">
                <div class="mb-3" v-for="horario in horarioRutinas" :key="horario.id">

                    <div class="flex">
                        <div class="header border border-b-0 p-5 w-2/5 bg-turquesa text-white font-bold capitalize">
                            Residente
                        </div>
                        <div v-for="residente in horario.rutinas" class="contenido border border-b-0 p-5 w-3/5">
                            {{ residente.residente.persona.nombres }}
                            {{ residente.residente.persona.apellidos }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="header border border-b-0 p-5 w-2/5 bg-turquesa text-white font-bold">
                            Rutina
                        </div>
                        <div v-for="rutina in horario.rutinas" class="contenido border border-b-0 p-5 w-3/5">
                            {{ rutina.nombre }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="header border border-b-0 p-5 w-2/5 bg-turquesa text-white font-bold">
                            Descripcion
                        </div>
                        <div v-for="descripcion in horario.rutinas" class="contenido border border-b-0 p-5 w-3/5">
                            {{ descripcion.descripcion }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="header border border-b-0 p-5 w-2/5 bg-turquesa text-white font-bold">
                            Horarios
                        </div>
                        <div class="contenido border border-b-0 p-5 w-3/5">
                            {{ horario.hora }}
                        </div>
                    </div>
                    <div class="flex">
                        <div class="header border  p-5 w-2/5 bg-turquesa text-white font-bold">
                            Marcacion diaria
                        </div>
                        <div class="contenido border  p-5 w-3/5">
                            <button
                                class="inline-block font-bold text-indigo-500 bg-indigo-200 py-2 px-3 border border-indigo-500 rounded-2xl hover:bg-indigo-400 hover:text-white"  @click="realizarMarcacion(horario.id)">Realizado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>