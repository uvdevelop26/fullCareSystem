<template>
    <div>

        <Head title="Crear Permiso" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Permiso</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="permisos.fecha_permiso" type="date" label="Fecha Permiso"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_permiso" name="fecha_permiso" :error="errors.fecha_permiso" />
                    <text-input v-model="permisos.justificacion" type="text" label="Justificacion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="justificacion" name="justificacion"
                        :error="errors.justificacion" />
                    <text-input v-model="permisos.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id"
                        :error="errors.empleado_id" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('permisos.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Permiso
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";


export default {
    components: {
        Head,
        Link,
        TextInput,
        SelectInput,

    },

    layout: Layout,

    props: {
        errors: Object,
    },

    setup() {

        const fecha_permiso = ref("");
        const justificacion = ref("");
        const empleado_id = ref("");



        const permisos = useForm({
            fecha_permiso: "",
            justificacion: "",
            empleado_id: "",

        });



        const guardar = async () => {


            permisos.post(route("permisos.store"), permisos);

        };

        return {
            permisos,

            guardar,
        };
    },
};
</script>