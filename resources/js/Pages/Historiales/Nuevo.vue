<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import Icon from "../../Shared/Icon.vue";

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
        enfermedades: Array,
        residentes: Array,
        errors: Object
    },

    setup(props) {

        const form = useForm({
            residente_id: "",
            fecha_registro: "",
            peso: "",
            altura: "",
            temperatura: "",
            presion_arterial: "",
            enfermedades: [{ valor: '' }],
            diagnostico: "",
            tratamiento: "",
            observaciones: ""
        });

        //enfermedades
        const agregarEnfermedad = () => {
            form.enfermedades.push({ valor: '' })
        }

        const eliminarEnfermedad = (index) => {
            form.enfermedades.splice(index, 1);
        }


        const guardar = async () => {

            form.post(route('historiales.store'), form);

        };

        return { form, guardar, agregarEnfermedad, eliminarEnfermedad };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Historial" />
        <!-- HEADER -->
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="historial" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Historial</span>
        </h1>
        <!-- FORMULARIO -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Residente" id="residente"
                        v-model="form.residente_id" :error="errors.residente_id">
                        <option :value="null" />
                        <option v-for="residente in residentes" :key="residente.id" :value="residente.id" class="text-sm">{{
                            residente.persona.nombres }} {{ residente.persona.apellidos }}</option>
                    </select-input>
                    <text-input v-model="form.fecha_registro" type="date" label="Fecha" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        id="fecha_registro" :error="errors.fecha_registro" />
                    <text-input v-model="form.peso" type="text" label="Peso" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="peso"
                        :error="errors.peso" placeholder="KG." reference="60 kg" />
                    <text-input v-model="form.altura" type="text" label="Altura" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        id="altura" :error="errors.altura" placeholder="CM." reference="1.70 cm" />
                    <text-input v-model="form.temperatura" type="text" label="Temperatura"
                        class="pb-5 lg:pr-3 w-full lg:w-1/2" id="temperatura" :error="errors.temperatura" placeholder="G°"
                        reference="40" />
                    <text-input v-model="form.presion_arterial" type="text" label="Presion Arterial"
                        class="pb-5 lg:pr-3 w-full lg:w-1/2" id="presion_arterial" :error="errors.presion_arterial"
                        placeholder="mmHg" reference="11.8" />
                    <!-- agregar enfermedad -->
                    <div class="flex-wrap pb-5 lg:pr-3 w-full lg:w-1/2">
                        <div class="block pb-2">Enfermedades:</div>
                        <div v-for="(enfermedad, index) in form.enfermedades" :key="index" class="flex gap-2 my-1">
                            <input type="text" class="border-turquesa rounded-md w-full" v-model="enfermedad.valor"
                                placeholder="">
                            <button type="button"
                                class="px-4 py-2 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo"
                                @click="eliminarEnfermedad(index)">Eliminar</button>
                        </div>
                        <button type="button"
                            class="px-4 py-2 mt-2 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo"
                            @click="agregarEnfermedad">Agregar</button>
                        <span v-if="errors.enfermedades" class="text-red-500">{{ errors.enfermedades }}</span>
                    </div>
                    <!-- resto de los campos -->
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="observaciones" class="form-label">Diagnóstico:</label>
                        <textarea name="observaciones" id="observaciones" cols="20" rows="3" class="form-textarea "
                            v-model="form.diagnostico"></textarea>
                        <span v-if="errors.diagnostico" class="text-red-500">{{ errors.diagnostico }}</span>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="observaciones" class="form-label">Tratamiento:</label>
                        <textarea name="observaciones" id="observaciones" cols="20" rows="3" class="form-textarea "
                            v-model="form.tratamiento"></textarea>
                        <span v-if="errors.tratamiento" class="text-red-500">{{ errors.tratamiento }}</span>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea name="observaciones" id="observaciones" cols="20" rows="3" class="form-textarea "
                            v-model="form.observaciones"></textarea>
                        <span v-if="errors.observaciones" class="text-red-500">{{ errors.observaciones }}</span>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('historiales.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Historial
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

