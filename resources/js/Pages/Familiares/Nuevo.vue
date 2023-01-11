<template>
    <div>

        <Head title="Crear Familiar" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Familiar</h1>
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
                    <text-input v-model="personas.direccion" type="text" label="Barrio/Compañia"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="direccion" name="direccion" :error="errors.direccion" />
                    <select-input v-model="personas.ciudade_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Ciudad"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudade in ciudades" :value="ciudade.id">
                            {{ ciudade.nombre_ciudad }}
                        </option>
                    </select-input>
                    <select-input v-model="personas.parentezco" class="pb-8 pr-6 w-full lg:w-1/2" label="Parentezco"
                        :error="errors.parentezco">
                        <option :value="null" />
                        <option value="Hijo">Hijo/a</option>
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Sobrino/a">Sobrino/a</option>
                        <option value="Otro">Otro</option>
                    </select-input>
                    <text-input v-model="personas.email" type="text" label="Email" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="email" name="email" :error="errors.email" />
                    <text-input v-model="personas.residente_id" type="text" label="Residente"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="residente_id" name="residente_id"
                        :error="errors.residente_id" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Familiar
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

        const parentezco = ref("");
        const email = ref("");
        const residente_id = ref("");

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

            parentezco: "",
            email: "",
            residente_id: "",

            familiares: [],
        });



        const guardar = async () => {
            const add = {
                parentezco: personas.parentezco,
                email: personas.email,
                residente_id: personas.residente_id,
            };

            personas.familiares.push(add);


            console.log(personas);

            personas.post(route("familiares.store"), personas);

        };

        return {
            personas,

            guardar,
        };
    },
};
</script>