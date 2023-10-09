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
        permiso: Array,
        estadoVariaciones: Array,
        errors: Object,
    },

    setup(props) {
        const form = useForm({
            _method: "PUT",
            id: props.permiso.id,
            fecha_inicio: props.permiso.fecha_inicio,
            fecha_fin: props.permiso.fecha_fin,
            duracion: props.permiso.duracion,
            motivo: props.permiso.motivo,
            empleado_id: props.permiso.empleado_id,
            estado_variacione_id: props.permiso.estado_variacione_id
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
                route("permisos.update", form.id),
                {
                    preserveScroll: true,
                });
        };

        return { form, actualizar, calcularDuracion };
    },
};
</script>


<template>
    <div>

        <Head title="Editar Permiso" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="permisos" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Permiso</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <text-input type="date" label="Fecha Inicio" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="fecha_inicio"
                        v-model="form.fecha_inicio" :error="errors.fecha_inicio" @change="calcularDuracion" />
                    <text-input type="date" label="Fecha Fin" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="fecha_fin"
                        v-model="form.fecha_fin" :error="errors.fecha_fin" @change="calcularDuracion" />
                    <text-input type="number" label="Duración" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="duracion"
                        v-model="form.duracion" :error="errors.duracion" disabled />
                    <text-input type="text" label="Motivo" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="motivo"
                        v-model="form.motivo" :error="errors.motivo" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Estado" :id="estado"
                        :error="errors.estado_variacione_id" v-model="form.estado_variacione_id">
                        <option :value="null" />
                        <option v-for="estadoVariacione in estadoVariaciones" :key="estadoVariacione.id"
                            :value="estadoVariacione.id">{{ estadoVariacione.nombre_estado }}</option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('permisos.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Permiso
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

