<template>
    <div>
        <Head title="Crear Residente" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Residente</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input
                        v-model="nombres"
                        type="text"
                        label="Nombres"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="nombres"
                        name="nombres"
                        :error="errors.nombres"
                    />
                   <!--  <input-error :message="errors.nombres" class="block"/> -->
                    <text-input
                        v-model="apellidos"
                        type="text"
                        label="Apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2"        
                        :id="apellidos"
                        name="nombres"
                        :error="errors.apellidos"
                    />
                    <text-input
                        v-model="ci_numero"
                        type="text"
                        label="CI"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ci_numero"
                        name="ci_numero"
                        :error="errors.ci_numero"
                    />
                    <text-input
                        v-model="fecha_nacimiento"
                        type="date"
                        label="Fecha de Nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2"  
                        :id="fecha_nacimiento"
                        name="fecha_nacimiento"
                        :error="errors.fecha_nacimiento"
                    />
                    <text-input
                        v-model="telefono"
                        type="text"         
                        label="Teléfono"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="telefono"
                        name="telefono"
                        :error="errors.telefono"
                    />
                    <text-input
                        v-model="edad"
                        type="number"
                        label="edad"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="edad"
                        name="edad"
                        :error="errors.edad"
                    />
                    <select-input
                        v-model="sexo"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Sexo"
                        :error="errors.sexo"
                    >
                        <option :value="null" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <text-input
                        v-model="direccion"
                        type="text"
                        label="Direccion/Compañia"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="direccion"
                        name="edad"
                        :error="errors.direccion"
                    />
                    <text-input
                        v-model="ciudade_id"
                        type="text"
                        label="Ciudad"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ciudade_id"
                        name="ciudade_id"
                        :error="errors.ciudade_id"
                    />
                    <text-input
                        v-model="foto"
                        type="text"
                        label="Foto"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="foto"
                        name="foto"
                    />
                    <text-input
                        v-model="fecha_ingreso"
                        type="date"
                        label="Fecha Ingreso"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="fecha_ingreso"
                        name="fecha_ingreso"
                        :error="errors.fecha_ingreso"
                    />
                    <select-input
                        v-model="estado"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Estado"
                        :error="errors.estado"
                    >
                        <option :value="null" />
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select-input>
                </div>
                <div
                    class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100"
                >
                    <Link
                        type="button"
                        :href="route('residentes.index')"
                        class="btn-cancelar"
                    >
                        <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button
                        class="btn-indigo mx-1"
                        @click.prevent="guardar()"
                        type="submit"
                    >
                        Crear Residente
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
import LoadingButton from "../../Shared/LoadingButton.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
/* import InputError from '../../Components/InputError.vue'; */
//import axios from "axios";

export default {
    components: {
        Head,
        Link,
        TextInput,
        LoadingButton,
        SelectInput,
      /*   InputError */
    },

    layout: Layout,

    props:{
        errors: Object
    },

    setup() {
        // const test = ref("");

        const nombres = ref("");
        const apellidos = ref("");
        const ci_numero = ref("");
        const fecha_nacimiento = ref("");
        const telefono = ref("");
        const edad = ref("");
        const sexo = ref("");
        const direccion = ref("");
        const ciudade_id = ref("");
        

        const foto = ref("");
        const fecha_ingreso = ref("");
        const estado = ref("");

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

            foto: "",
            fecha_ingreso: "",
            estado: "",

            residentes: [],
        });

        /* const storeResidentes = async (data) => {
            await axios.post("/residentes", data);
        }; */

        const guardar = async () => {
            personas.nombres = nombres.value;
            personas.apellidos = apellidos.value;
            personas.ci_numero = ci_numero.value;
            personas.fecha_nacimiento = fecha_nacimiento.value;
            personas.telefono = telefono.value;
            personas.edad = edad.value;
            personas.sexo = sexo.value;
            personas.direccion = direccion.value;
            personas.ciudade_id = ciudade_id.value;

            personas.foto = foto.value;
            personas.fecha_ingreso = fecha_ingreso.value;
            personas.estado = estado.value;

            const add = {
                foto: foto.value,
                fecha_ingreso: fecha_ingreso.value,
                estado: estado.value,
            };

            personas.residentes.push(add);
            console.log(personas);

            //return;

            personas.post(route("residentes.store"), personas);
            /* await storeResidentes({...personas}); */
        };

        return {
            nombres,
            apellidos,
            ci_numero,
            fecha_nacimiento,
            telefono,
            edad,
            sexo,
            direccion,
            ciudade_id,
            foto,
            fecha_ingreso,
            estado,
            guardar
        };
    },
};
</script>

<style></style>
