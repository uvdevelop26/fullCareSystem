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
        alergias: Array,
        errors: Object
    },

    setup() {

        const form = useForm({
            fecha_registro: "",
            diagnostico: "",
            tratamiento: "",
            observaciones: "",
            residente_id: "",


            peso: "",
            altura: "",
            temperatura: "",
            presion_arterial: "",

            enfermedades: [],
            alergias: [],

            nombre_enfermedad: "",
            descripcion_enfermedad: "",
            nombre_alergia: "",
            descripcion_alergia: ""

        });



        const guardar = async () => {

            form.post(route('historiales.store'), form);

        };

        return {
            form,

            guardar,
        };
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
                    <text-input v-model="form.residente_id" type="text" label="Residente"
                        class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="residente_id" :error="errors.residente_id" />
                    <text-input v-model="form.fecha_registro" type="date" label="Fecha" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="fecha_registro" :error="errors.fecha_registro" />
                    <text-input v-model="form.peso" type="number" label="Peso" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="peso" :error="errors.peso" />
                    <text-input v-model="form.altura" type="number" label="Altura" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="altura" :error="errors.altura" />
                    <text-input v-model="form.temperatura" type="number" label="Temperatura"
                        class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="temperatura" :error="errors.temperatura" />
                    <text-input v-model="form.presion_arterial" type="number" label="Presion Arterial"
                        class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="presion_arterial" :error="errors.presion_arterial" />
                    <div class="w-full lg:flex lg:justify-between">
                        <div class="pb-5 lg:pr-3 lg:w-1/2">
                            <span class="block py-2">Enfermedad/es:</span>
                            <div class="w-full">
                                <div class="pb-1 pr-8 lg:pr-20 flex items-center justify-between"
                                    v-for="enfermedad in enfermedades" :key="enfermedad.id">
                                    <label class="form-label">{{ enfermedad.nombre }}</label>
                                    <input type="checkbox" v-model="form.enfermedades" :value="enfermedad.id"
                                        class="form-checkbox">
                                </div>
                            </div>
                            <div v-if="errors.enfermedades" class="form-error"> {{ errors.enfermedades }}</div>
                            <text-input v-model="form.nombre_enfermedad" type="text" label="Otro"
                                class="pb-5 lg:pr-3 w-full" placeholder="especificar.." :id="nombre_enfermedad" />
                            <div v-if="errors.nombre_enfermedad" class="form-error"> {{ errors.nombre_enfermedad }}</div>
                            <textarea name="descripcion" :id="descripcion_enfermedad" cols="20" rows="2"
                                class="form-textarea" placeholder="Descripcion.."
                                v-model="form.descripcion_enfermedad"></textarea>
                            <span v-if="errors.descripcion_enfermedad" class="text-red-500">{{
                                errors.descripcion_enfermedad }}</span>
                        </div>
                        <div class="pb-5 lg:pr-3 lg:w-1/2">
                            <span class="block py-2">Alergia/as:</span>
                            <div class="w-full">
                                <div class="pb-1 pr-8 lg:pr-20 flex items-center justify-between"
                                    v-for="alergia in alergias" :key="alergia.id">
                                    <label class="form-label">{{ alergia.nombre }}</label>
                                    <input type="checkbox" v-model="form.alergias" :value="alergia.id"
                                        class="form-checkbox">
                                </div>
                            </div>
                            <div v-if="errors.alergias" class="form-error"> {{ errors.alergias }}</div>
                            <text-input v-model="form.nombre_alergia" type="text" label="Otro" class="pb-5 lg:pr-3 w-full"
                                placeholder="especificar.." :id="nombre_alergia" />
                            <div v-if="errors.nombre_alergia" class="form-error"> {{ errors.nombre_alergia }}</div>
                            <textarea name="descripcion" :id="descripcion_alergia" cols="20" rows="2" class="form-textarea"
                                placeholder="Descripcion.." v-model="form.descripcion_alergia"></textarea>
                            <span v-if="errors.descripcion_alergia" class="text-red-500">{{
                                errors.descripcion_alergia }}</span>
                        </div>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="diagnostico" class="form-label">Diagnostico:</label>
                        <textarea name="diagnostico" :id="diagnostico" cols="20" rows="3" class="form-textarea "
                            v-model="form.diagnostico"></textarea>
                        <span v-if="errors.diagnostico" class="text-red-500">{{ errors.diagnostico }}</span>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="tratamiento" class="form-label">Tratamiento:</label>
                        <textarea name="tratamiento" :id="tratamiento" cols="20" rows="3" class="form-textarea "
                            v-model="form.tratamiento"></textarea>
                        <span v-if="errors.tratamiento" class="text-red-500">{{ errors.tratamiento }}</span>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea name="observaciones" :id="observaciones" cols="20" rows="3" class="form-textarea "
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

