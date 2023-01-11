<template>
    <div>

        <Head title="Familiares" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Familiar</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="familiares.nombres" type="text" label="Nombres"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="nombres" name="nombres" :error="errors.nombres" />
                    <text-input v-model="familiares.apellidos" type="text" label="Apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="apellidos" name="apellidos" :error="errors.apellidos" />
                    <text-input v-model="familiares.ci_numero" type="text" label="CI" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ci_numero" name="ci_numero" :error="ci_numero" />
                    <text-input v-model="familiares.fecha_nacimiento" type="date" label="Fecha de Nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_nacimiento" name="fecha_nacimiento"
                        :error="errors.fecha_nacimiento" />
                    <text-input v-model="familiares.telefono" type="text" label="Teléfono"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="telefono" name="telefono" :error="errors.telefono" />
                    <text-input v-model="familiares.edad" type="number" label="edad" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="edad" name="edad" :error="errors.edad" />
                    <select-input v-model="familiares.sexo" class="pb-8 pr-6 w-full lg:w-1/2" label="Sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <text-input v-model="familiares.direccion" type="text" label="Direccion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="direccion" name="direccion" :error="errors.direccion" />
                    <select-input v-model="familiares.ciudade_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Ciudad"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudade in ciudades" :value="ciudade.id">
                            {{ ciudade.nombre_ciudad }}
                        </option>
                    </select-input>

                    <select-input v-model="familiares.parentezco" class="pb-8 pr-6 w-full lg:w-1/2" label="Parentezco"
                        :error="errors.parentezco">
                        <option :value="familiares.parentezco" />
                        <option value="Hijo">Hijo/a</option>
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Sobrino/a">Sobrino/a</option>
                        <option value="Otro">Otro</option>
                    </select-input>
                    <text-input v-model="familiares.email" type="text" label="Email" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="email" name="email" :error="errors.email" />
                    <text-input v-model="familiares.residente_id" type="text" label="Residente"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="residente_id" name="residente_id"
                        :error="errors.residente_id" />

                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>

                    <button class="btn-indigo mx-1" @click.prevent="actualizarFamiliar()" type="submit">
                        Actualizar Familiar
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
/* import LoadingButton from "../../Shared/LoadingButton.vue"; */
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

    props: {
        familiare: Object,
        persona: Object,
        errors: Object,
        ciudades: Object
    },

    layout: Layout,

    setup(props) {
        const familiares = useForm({
            _method: "PUT",
            id: props.persona.id,
            nombres: props.persona.nombres,
            apellidos: props.persona.apellidos,
            ci_numero: props.persona.ci_numero,
            fecha_nacimiento: props.persona.fecha_nacimiento,
            telefono: props.persona.telefono,
            edad: props.persona.edad,
            sexo: props.persona.sexo,
            direccion: props.persona.direccion,
            ciudade_id: props.persona.ciudade_id,

            id_familiare: props.familiare.id,
            parentezco: props.familiare.parentezco,
            email: props.familiare.email,
            residente_id: props.familiare.residente_id,
        });

        const actualizarFamiliar = () => {
            familiares.post(
                route("familiares.update", familiares.id_familiare),
                {
                    preserveScroll: true,
                }
            );
        };

        return { familiares, actualizarFamiliar };
    },
};
</script>
