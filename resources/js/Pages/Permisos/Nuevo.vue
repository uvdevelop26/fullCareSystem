<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Link, Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';


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
        errors: Object,
    },

    setup() {

        const form = useForm({
            fecha_permiso: "",
            justificacion: "",
            estado: "",
            observacion: "",
            empleado_id: "",
        });

        const guardar = async () => {
            form.post(route("permisos.store"), form);
        };

        const motivos = ['enfermedad', 'duelo', 'viaje', 'emergencia familiar', 'otros'];

        return { form, guardar, motivos };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Familiar" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="permisos" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Solicitar Permiso</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <text-input type="date" label="Fecha de Permiso" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="fecha_permiso" v-model="form.fecha_permiso" :error="errors.fecha_permiso" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Justificacion" :id="justificacion"
                        v-model="form.justificacion" :error="errors.justificacion">
                        <option :value="null" />
                        <option v-for="motivo in motivos" :key="motivo" :value="motivo">
                            {{ motivo }}
                        </option>
                    </select-input>
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Estado" :id="estado" v-model="form.estado"
                        :error="errors.estado">
                        <option :value="null" />
                        <option value="pendiente">pendiente</option>
                        <option value="aprobado">aprobado</option>
                    </select-input>
                    <text-input type="text" label="Observacion" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="observacion"
                        v-model="form.observacion" :error="errors.observacion" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('permisos.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Solicitar Permiso
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

