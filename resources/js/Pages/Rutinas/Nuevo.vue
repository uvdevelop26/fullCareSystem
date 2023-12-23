<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

export default {

    layout: LayoutApp,

    components: {
        Icon,
        TextInput,
        SelectInput,
        Head,
        Link
    },

    props: {
        errors: Object,
        residentes: Array
    },

    setup(props) {

        const form = useForm({
            nombre: "",
            descripcion: "",
            residente_id: "",
            horarios: [{ valor: '' }]
        });


        const agregarHorario = () => {
            form.horarios.push({ valor: '' })
        }

        const eliminarHorario = (index) => {
            form.horarios.splice(index, 1);
        }

        const guardar = async () => {
            form.post(route('rutinas.store'), form);
        };

        //mensajes de error
        const obtenerError = (index) => {
            const errorKey = `horarios.${index}.valor`

            return props.errors[errorKey] || '';
        }


        return { form, guardar, agregarHorario, eliminarHorario, obtenerError };
    }



}
</script>
<template>
    <div>

        <Head title="Crear Rutinas" />

        <!-- Header -->
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="rutinas" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Nueva Rutina</span>
        </h1>

        <!-- Formulario -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <!-- datos del rutinas -->
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Residente" id="residente"
                        v-model="form.residente_id" :error="errors.residente_id">
                        <option :value="null" />
                        <option v-for="residente in residentes" :key="residente.id" :value="residente.id" class="text-sm">{{
                            residente.persona.nombres }} {{ residente.persona.apellidos }}</option>
                    </select-input>
    
                    <text-input type="text" label="Rutina a realizar" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="nombre"
                        v-model="form.nombre" :error="errors.nombre" />
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" cols="20" rows="3" class="form-textarea"
                            v-model="form.descripcion"></textarea>
                        <span v-if="errors.descripcion" class="text-red-500">{{ errors.descripcion }}</span>
                    </div>

                    <!-- Insertar Horarios -->
                    <div class="flex-wrap pb-5 lg:pr-3 w-full lg:w-1/2">
                        <div class="block pb-2 text-center font-bold">Horarios de Suministro:</div>
                        <div v-for="(horario, index) in form.horarios" :key="index" class="my-1 flex flex-col items-center">
                            <span v-if="obtenerError(index)" class="text-red-500 text-xs">{{ obtenerError(index)
                            }}</span>
                            <div class="flex gap-2 items-center w-full">
                                <input type="text" class="border-turquesa rounded-md w-full" v-model="horario.valor"
                                    placeholder="HH:MM">
                                <button type="button"
                                    class="px-3 py-1 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo"
                                    @click="eliminarHorario(index)">Eliminar</button>
                            </div>
                        </div>
                        <button type="button"
                            class="px-3 py-1 mt-2 bg-indigo-400 rounded-xl text-white hover:shadow-md hover:bg-softIndigo"
                            @click="agregarHorario">Agregar Horario</button>
                    </div>
                    <!-- botones -->
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('rutinas.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Rutina
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>