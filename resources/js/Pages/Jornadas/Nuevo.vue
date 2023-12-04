<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm   } from "@inertiajs/inertia-vue3";
import { watch } from "vue";



export default {

    layout: LayoutApp,


    components: {
        Head,
        Link,
        TextInput,
        SelectInput,
        Icon
    },



    props: {
        dias: Array,
        turnos: Array,
        errors: Object
    },

    setup(props) {


        const form = useForm({

            empleado_id: "",
            turno_id: "",
            hora_entrada: "",
            hora_salida: "",
            nombre_dias: []

        });

        watch(() => {
            const turnoSeleccionado = props.turnos.find(turno => turno.id === form.turno_id);
            if (turnoSeleccionado) {
                form.hora_entrada = turnoSeleccionado.hora_entrada;
                form.hora_salida = turnoSeleccionado.hora_salida;
            }
        });

        const guardar = async () => {
            form.post(route("jornadas.store"), form);
        };


        return { form, guardar };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Jornada" />
        <!-- HEADER -->
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="jornadas" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Jornada</span>
        </h1>
        <!-- FORMULARIO -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <select-input v-model="form.turno_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Turno" :error="errors.turno_id">
                        <option :value="null" />
                        <option v-for="turno in turnos" :key="turno.id" :value="turno.id" class="text-sm">
                            {{ turno.nombre_turnos }}
                        </option>
                    </select-input>
                    <text-input type="time" label="Hora Entrada" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="hora_entrada"
                        v-model="form.hora_entrada" disabled/>
                    <text-input type="time" label="Hora Salida" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="hora_salida" v-model="form.hora_salida"  disabled />
                    <div class="w-full">
                        <span class="block py-4 font-bold text-center">Seleccione Días de la Semana</span>
                        <div class="w-full flex flex-wrap justify-between">
                            <div class="mr-2 pb-1 text-center" v-for="dia in dias" :key="dia.id">
                                <label class="form-label">{{ dia.nombre_dias }}</label>
                                <input type="checkbox" v-model="form.nombre_dias" :value="dia.id" class="border-turquesa rounded-sm ml-1">
                            </div>
                        </div>
                        <div v-if="errors.nombre_dias" class="form-error"> {{ errors.nombre_dias }}</div>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('jornadas.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Turno
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
