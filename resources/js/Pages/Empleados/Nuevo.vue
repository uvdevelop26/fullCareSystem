<template>
    <div>

        <Head title="Crear Empleado" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Empleado</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="personas.nombres" type="text" label="Nombres" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="nombres" name="nombres" :error="errors.nombres" />
                    <text-input v-model="personas.apellidos" type="text" label="Apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="apellidos" name="apellidos" :error="errors.apellidos" />
                    <text-input v-model="personas.ci_numero" type="text" label="CI" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ci_numero" name="ci_numero" :error="errors.ci_numero" />
                    <text-input v-model="personas.fecha_nacimiento" type="date" label="Fecha de Nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_nacimiento" name="fecha_nacimiento"
                        :error="errors.fecha_nacimiento" />
                    <text-input v-model="personas.telefono" type="text" label="Teléfono"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="telefono" name="telefono" :error="errors.telefono" />
                    <text-input v-model="personas.edad" type="number" label="edad" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="edad" name="edad" :error="errors.edad" />
                    <select-input v-model="personas.sexo" class="pb-8 pr-6 w-full lg:w-1/2" label="Sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <text-input v-model="personas.direccion" type="text" label="Direccion/Compañia"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="direccion" name="direccion" :error="errors.direccion" />
                    <select-input v-model="personas.ciudade_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Ciudad"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudade in ciudades" :value="ciudade.id">
                            {{ ciudade.nombre_ciudad }}
                        </option>
                    </select-input>
                    <text-input v-model="personas.fecha_ingreso" type="date" label="Fecha Ingreso"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_ingreso" name="fecha_ingreso"
                        :error="errors.fecha_ingreso" />
                    <text-input v-model="personas.email" type="text" label="Email" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="email" name="email" :error="errors.email" />
                    <text-input v-model="personas.profesion" type="text" label="Profesion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="profesion" name="profesion" :error="errors.profesion" />
                    <select-input v-model="personas.seccion_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Seccion"
                        :error="errors.seccion_id">
                        <option :value="null" />
                        <option v-for="seccion in seccions" :value="seccion.id">
                            {{ seccion.nombre_seccion }}
                        </option>
                    </select-input>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('empleados.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Empleados
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
        ciudades: Object,
        seccions: Object
    },

    setup() {


        const nombres = ref("");
        const apellidos = ref("");
        const ci_numero = ref("");
        const fecha_nacimiento = ref("");
        const telefono = ref("");
        const edad = ref("");
        const sexo = ref("");
        const direccion = ref("");
        const ciudade_id = ref("");

        const fecha_ingreso = ref("");
        const email = ref("");
        const profesion = ref("");
        const seccion_id = ref("");


        const personas = useForm({
            nombres: "",
            apellidos: "",
            ci_numero: "",
            fecha_nacimiento: "",
            telefono: "",
            edad: "",
            sexo: "",
            direccion: "",
            ciudade_id: "",

            fecha_ingreso: "",
            email: "",
            profesion: "",
            seccion_id: "",


            empleados: [],
        });



        const guardar = async () => {
            const add = {
                fecha_ingreso: personas.fecha_ingreso,
                email: personas.email,
                profesion: personas.profesion,
                seccion_id: personas.seccion_id,
            };

            personas.empleados.push(add);


            console.log(personas);

            personas.post(route("empleados.store"), personas);

        };

        return {
            personas,

            guardar,
        };
    },
};
</script>