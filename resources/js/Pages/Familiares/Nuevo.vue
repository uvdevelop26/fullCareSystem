<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import DialogModal from '../../Components/DialogModal.vue'
import SearchInput from "../../Shared/SearchInput.vue";
import { ref } from 'vue';


export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        TextInput,
        SelectInput,
        DialogModal,
        SearchInput

    },

    props: {
        residentes: Array,
        ciudades: Array,
        errors: Object
    },

    setup() {

        const openModal = ref(false)

        const form = useForm({
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
        });

        const guardar = async () => {
            form.post(route("familiares.store"), form);
        };

        return { form, guardar, openModal }
    },
};
</script>
<template>
    <div>

        <Head title="Crear Familiar" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="family" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Familiar</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Nombres" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="nombres"
                        v-model="form.nombres" :error="errors.nombres" />
                    <text-input type="text" label="Apellidos" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="apellidos"
                        v-model="form.apellidos" :error="errors.apellidos" />
                    <text-input type="text" label="CI" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="ci_numero"
                        v-model="form.ci_numero" :error="errors.ci_numero" reference="4972774 (sin puntos)" />

                    <text-input type="date" label="Fecha de Nacimiento" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        id="fecha_nacimiento" v-model="form.fecha_nacimiento" :error="errors.fecha_nacimiento" />
                    <text-input type="text" label="Teléfono" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="telefono"
                        v-model="form.telefono" :error="errors.telefono" />
                    <text-input type="number" label="Edad" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="edad"
                        v-model="form.edad" :error="errors.edad" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Sexo" id="sexo" v-model="form.sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="femenino" class="text-sm">Femenino</option>
                        <option value="masculino" class="text-sm">Masculino</option>
                    </select-input>
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Ciudad" id="ciudad" v-model="form.ciudade_id"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudad in ciudades" :key="ciudad.nombre_ciudad" :value="ciudad.id" class="text-sm">
                            {{ ciudad.nombre_ciudad }}
                        </option>
                    </select-input>
                    <text-input type="text" label="Dirección" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="direccion"
                        v-model="form.direccion" :error="errors.direccion" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Parentezco" id="parentezco"
                        v-model="form.parentezco" :error="errors.parentezco">
                        <option :value="null" />
                        <option value="hijo/a" class="text-sm">Hijo/a</option>
                        <option value="hermano/a" class="text-sm">Hermano/a</option>
                        <option value="sobrino/a" class="text-sm">Sobrino/a</option>
                        <option value="otro" class="text-sm">Otro</option>
                    </select-input>
                    <text-input type="text" label="Email" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="email"
                        v-model="form.email" :error="errors.email" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Residente" id="residente" v-model="form.residente_id"
                        :error="errors.residente_id">
                        <option :value="null" />
                        <option v-for="residente in residentes" :key="residente.id" :value="residente.id" class="text-sm">{{ residente.persona.nombres}} {{ residente.persona.apellidos}}</option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Familiar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- modal -->
        <dialog-modal :show="openModal">
            <template #title>
                <div>
                    Seleccionar Residente
                </div>
            </template>
            <template #content>
                <div>
                    <input type="text" v-model="searchTerm" name="" id="" placeholder="buscar Nombre del Residente"
                        @input="searchResidente" class="w-full h-10 focus:border-turquesa rounded-md border-turquesa">
                    <!-- LISTA DE RESULTADOS -->
                    <ul>
                        <li>resultado</li>
                    </ul>
                </div>
            </template>
            <template #footer>
                <div>
                    <button @click="openModal = false" class="btn-cancelar">
                        Cancelar
                    </button>
                </div>
            </template>


        </dialog-modal>

    </div>
</template>

