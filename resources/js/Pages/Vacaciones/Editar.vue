<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
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
        vacacione: Array,
        estadoVariaciones: Array,
        empleados: Array,
        errors: Object,
    },



    setup(props) {
        const form = useForm({
            _method: "PUT",
            id: props.vacacione.id,
            fecha_inicio: props.vacacione.fecha_inicio,
            fecha_fin: props.vacacione.fecha_fin,
            duracion: props.vacacione.duracion,
            observacion: props.vacacione.observacion,
            empleado_id: props.vacacione.empleado_id,
            estado_variacione_id: props.vacacione.estado_variacione_id,
        });

        watch([() => form.fecha_inicio, () => form.fecha_fin], () => {
            calcularDuracion();
        });

        function calcularDuracion() {
            const fechaInicio = new Date(form.fecha_inicio);
            const fechaFin = new Date(form.fecha_fin);

            if (!isNaN(fechaInicio) && !isNaN(fechaFin) && fechaInicio <= fechaFin) {
                const diffTime = Math.abs(fechaFin - fechaInicio);
                const diffDay = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                form.duracion = diffDay;
            } else {
                form.duracion = 0;
            }
        }


        const actualizar = () => {
            form.post(
                route("vacaciones.update", form.id),
                {
                    preserveScroll: true,
                });
        };

        return { form, actualizar, calcularDuracion }

    },
};
</script>

<template>
    <div>

        <Head title="Editar Vacaciones" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="permisos" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Vacaciones</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Empleado" id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id">
                        <option :value="null" />
                        <option v-for="empleado in empleados" :key="empleado.id" :value="empleado.id" class="text-sm">
                            {{ empleado.persona.nombres }} {{ empleado.persona.apellidos }}
                        </option>
                    </select-input>
                    <text-input type="date" label="Fecha de Inicio" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="fecha_inicio"
                        :error="errors.fecha_inicio" v-model="form.fecha_inicio" @change="calcularDuracion" />
                    <text-input type="date" label="Fecha Fin" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="fecha_fin"
                        :error="errors.fecha_fin" v-model="form.fecha_fin" @change="calcularDuracion" />
                    <text-input type="number" label="Duracion" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="duracion"
                        :error="errors.duracion" v-model="form.duracion" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Estado" id="estado"
                        :error="errors.estado_variacione_id" v-model="form.estado_variacione_id">
                        <option :value="null" />
                        <option v-for="estadoVariacione in estadoVariaciones" :key="estadoVariacione.id"
                            :value="estadoVariacione.id" class="capitalize">{{ estadoVariacione.nombre_estado }}</option>
                    </select-input>
                    <text-input type="text" label="Observacion" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="observacion"
                        :error="errors.observacion" v-model="form.observacion" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('vacaciones.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Vacación
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
