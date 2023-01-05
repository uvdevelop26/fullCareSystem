<template>
    <div>
        <Head title="Crear Residente" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Residente</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div
                    class="text-center py-2 font-bold text-cyan-700 italic border rounded-lg mx-1 my-1"
                >
                    Datos Personales del Residente
                </div>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input
                        v-model="nombres"
                        type="text"
                        label="Nombres"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                    />
                    <text-input
                        v-model="apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Apellidos"
                        :id="apellidos"
                    />
                    <text-input
                        v-model="ci_numero"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="CI"
                        :id="ci_numero"
                    />
                    <text-input
                        v-model="fecha_nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Fecha de Nacimiento"
                        type="date"
                        :id="fecha_nacimiento"
                    />
                    <text-input
                        v-model="telefono"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Teléfono"
                        :id="telefono"
                    />
                    <text-input
                        v-model="edad"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="edad"
                        type="number"
                        :id="edad"
                    />
                    <select-input
                        v-model="sexo"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Sexo"
                    >
                        <option :value="null" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <text-input
                        v-model="direccion"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Direccion"
                        type="text"
                        :id="direccion"
                    />
                    <text-input
                        v-model="ciudade_id"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Ciudad"
                        type="text"
                        :id="ciudade_id"
                    />
                    <text-input
                        v-model="foto"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Foto"
                        type="text"
                        :id="foto"
                    />
                    <text-input
                        v-model="fecha_ingreso"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Fecha Ingreso"
                        type="date"
                        :id="fecha_ingreso"
                    />
                    <select-input
                        v-model="estado"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Estado"
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
//import axios from "axios";

export default {
    components: {
        Head,
        Link,
        TextInput,
        LoadingButton,
        SelectInput,
    },

    layout: Layout,

    setup() {
        // const test = ref("");

        const nombres = ref("");
        const apellidos = ref("");
        const ci_numero = ref("");
        const fecha_nacimiento = ref("");
        const telefono = ref("");
        const edad = ref("");
        const sexo = ref("");
        //paise_id
        //ciudade_id

        const foto = ref("");
        const fecha_ingreso = ref("");
        const fecha_salida = ref("");

        const personas = useForm({
            nombres: "",
            apellidos: "",
            ci_numero: "",
            fecha_nacimiento: "",
            telefono: "",
            edad: "",
            sexo: "",
            paise_id: 1,
            ciudade_id: 1,

            foto: "",
            fecha_ingreso: "",
            fecha_salida: "",

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

            personas.foto = foto.value;
            personas.fecha_ingreso = fecha_ingreso.value;
            personas.fecha_salida = fecha_salida.value;

            const add = {
                foto: foto.value,
                fecha_ingreso: fecha_ingreso.value,
                fecha_salida: fecha_salida.value,
            };

            personas.residentes.push(add);
            console.log(personas);

            //return;

            personas.post(route("residentes.store"), personas);
            /* await storeResidentes({...personas}); */
        };

        return {
            nombres,
            ci_numero,
            fecha_nacimiento,
            foto,
            guardar,
            personas,
            apellidos,
            telefono,
            edad,
            sexo,
            fecha_ingreso,
            fecha_salida,
        };
    },
};
</script>

<style></style>
