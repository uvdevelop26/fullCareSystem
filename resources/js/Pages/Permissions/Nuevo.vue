<template>
    <div>

        <Head title="Crear Permissions" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Permisos</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="form.post(route('permissions.store'))">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.name" type="text" label="Nombre" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="name" name="name" />
                     
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('permissions.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button type="submit" class="btn-indigo mx-1">
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

   /*  props: {
        errors: Object,
        ciudades: Object,
        seccions: Object
    }, */

    setup() {


        const name = ref("");
        


        const form = useForm({
           name: ""
        });



        /* const guardar = async () => {
            const add = {
                fecha_ingreso: personas.fecha_ingreso,
                email: personas.email,
                profesion: personas.profesion,
                seccion_id: personas.seccion_id,
            };

            personas.empleados.push(add);


            console.log(personas);

            personas.post(route("empleados.store"), personas);

        }; */

        return {
            form

        /*     guardar, */
        };
    },
};
</script>