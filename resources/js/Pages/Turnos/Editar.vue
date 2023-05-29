<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

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
        turno: Array,
        dias: Array,
        turnoHasDias: Array,
        errors: Object
    },


    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.turno.id,
            nombre_turnos: props.turno.nombre_turnos,
            hora_entrada: props.turno.hora_entrada,
            hora_salida: props.turno.hora_salida,
            empleado_id: props.turno.empleado_id,
            nombre_dias: props.turnoHasDias

        });

        const actualizar = () => {
            form.post(
                route("turnos.update", form.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { form, actualizar };
    },
};
</script>
<template>
    <div>

        <Head title="Editar Turno" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="jornadas" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Turno</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <select-input v-model="form.nombre_turnos" class="pb-8 pr-6 w-full lg:w-1/2" label="Turno"
                        :error="errors.nombre_turnos">
                        <option :value="null" />
                        <option value="mañana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
                        <option value="madrugada">Madrugada</option>
                    </select-input>
                    <text-input type="time" label="Hora Entrada" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="hora_entrada"
                        v-model="form.hora_entrada" :error="errors.hora_entrada" />
                    <text-input type="time" label="Hora Salida" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="hora_salida"
                        v-model="form.hora_salida" :error="errors.hora_salida" />
                    <div class="w-full">
                        <span class="block py-2">Seleccione Días de la Semana:</span>
                        <div class="w-full flex flex-wrap justify-between">
                            <div class="mr-2 pb-1 text-center" v-for="dia in dias" :key="dia.id">
                                <label class="form-label">{{ dia.nombre_dias }}</label>
                                <input type="checkbox" v-model="form.nombre_dias" :value="dia.id" class="form-checkbox">
                            </div>
                        </div>
                        <div v-if="errors.nombre_dias" class="form-error"> {{ errors.nombre_dias }}</div>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('turnos.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Turno
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


