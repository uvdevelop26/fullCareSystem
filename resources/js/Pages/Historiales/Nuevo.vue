<template>
    <div>

        <Head title="Crear Empleado" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Historial</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.fecha_historial" type="date" label="Fecha"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_historial" :error="errors.fecha_historial" name="fecha_historial" />
                    <text-input v-model="form.observaciones" :error="errors.observaciones" type="text" label="Observaciones"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="observaciones" name="observaciones" />
                    <text-input v-model="form.residente_id" :error="residente_id" type="text" label="Residente"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="residente_id" name="residente_id" />
                    <text-input v-model="form.peso" :error="errors.peso" type="number" label="Peso" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="peso" name="peso" />
                    <text-input v-model="form.altura" :error="errors.altura" type="number" label="Altura" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="altura" name="altura" />
                    <text-input v-model="form.temperatura" :error="errors.temperatura" type="number" label="Temperatura"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="temperatura" name="temperatura" />
                    <text-input v-model="form.presion_arterial" :error="errors.presion_arterial" type="number" label="Presion Arterial"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="presion_arterial" name="presion_arterial" />
                    <text-input v-model="form.nombre_enfermedades" :error="errors.nombre_enfermedades" type="text" label="Enfermedad"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="nombre_enfermedades" name="nombre_enfermedades" />
                    <text-input v-model="form.tratamientos" :error="errors.tratamientos" type="text" label="Tratamientos"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="tratamientos" name="tratamientos" />
                    <text-input v-model="form.alimentacion" :error="errors.alimentacion" type="text" label="Alimentacion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="alimentacion" name="alimentacion" />
                    <text-input v-model="form.recomendaciones" :error="errors.recomendaciones" type="text" label="Recomendaciones"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="recomendaciones" name="recomendaciones" />
                    <text-input v-model="form.cirugias" type="text" label="Cirugias" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="cirugias" name="cirugias" />
                    <text-input v-model="form.alergias" type="text" label="Alergias" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="alergias" name="alergias" />
                        <text-input v-model="form.recomendaciones_inc" type="text" label="Recomendaciones de Incidencias" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="recomendaciones_inc" name="alergias" />

                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('historiales.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Historial
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
        errors: Object
    },

    setup() {


        /* const nombres = ref("");
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
        const seccion_id = ref(""); */


        const form = useForm({
            fecha_historial: "",
            observaciones: "",
            residente_id: "",

            peso: "",
            altura: "",
            temperatura: "",
            presion_arterial: "",

            nombre_enfermedades: "",
            tratamientos: "",
            alimentacion: "",
            recomendaciones: "",

            cirugias: "",
            alergias: "",
            recomendaciones_inc: "",


            caracteristicas: [],
            enfermedades: [],
            incidencias: []

        });



        const guardar = async () => {
            const add1 = {
                peso: form.peso,
                altura: form.altura,
                temperatura: form.temperatura,
                presion_arterial: form.presion_arterial,
            };

            const add2 = {
                nombre_enfermedades: form.nombre_enfermedades,
                tratamientos: form.tratamientos,
                alimentacion: form.alimentacion,
                recomendaciones: form.recomendaciones,
            };

            const add3 = {
                cirugias: form.cirugias,
                alergias: form.alergias,
                recomendaciones_inc: form.recomendaciones_inc,
            };

            form.caracteristicas.push(add1);
            form.enfermedades.push(add2);
            form.incidencias.push(add3);


            console.log(form);

            form.post(route("historiales.store"), form);

        };

        return {
            form,

            guardar,
        };
    },
};
</script>