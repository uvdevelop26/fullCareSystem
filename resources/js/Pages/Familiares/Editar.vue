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
        Head,
        Link,
        TextInput,
        SelectInput,
        Icon
    },

    props: {
        familiare: Array,
        persona: Array,
        ciudades: Array,
        errors: Object,
    },


    setup(props) {
        const form = useForm({
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
            persona_id: props.familiare.persona_id
        });

        const actualizar = () => {
            form.post(
                route("familiares.update", form.id_familiare),
                {
                    preserveScroll: true,
                });
        };

        return { form, actualizar };
    },
};
</script>
<template>
    <div>

        <Head title="Editar Familiar" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="family" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Familiar</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Nombres" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="nombres"
                        v-model="form.nombres" :error="errors.nombres" />
                    <text-input type="text" label="Apellidos" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="apellidos"
                        v-model="form.apellidos" :error="errors.apellidos" />
                    <text-input type="text" label="CI" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="ci_numero"
                        v-model="form.ci_numero" :error="errors.ci_numero" />

                    <text-input type="date" label="Fecha de Nacimiento" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="fecha_nacimiento" v-model="form.fecha_nacimiento" :error="errors.fecha_nacimiento" />
                    <text-input type="text" label="Teléfono" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="telefono"
                        v-model="form.telefono" :error="errors.telefono" />
                    <text-input type="number" label="edad" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="edad"
                        v-model="form.edad" :error="errors.edad" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Sexo" :id="sexo" v-model="form.sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="femenino">Femenino</option>
                        <option value="masculino">Masculino</option>
                    </select-input>
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Ciudad" :id="ciudad" v-model="form.ciudade_id"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudad in ciudades" :key="ciudad.nombre_ciudad" :value="ciudad.id">
                            {{ ciudad.nombre_ciudad }}
                        </option>
                    </select-input>
                    <text-input type="text" label="Dirección" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="direccion"
                        v-model="form.direccion" :error="errors.direccion" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Parentezco" :id="parentezco"
                        v-model="form.parentezco" :error="errors.parentezco">
                        <option :value="null" />
                        <option value="hijo/a">Hijo/a</option>
                        <option value="hermano/a">Hermano/a</option>
                        <option value="sobrino/a">Sobrino/a</option>
                        <option value="otro">Otro</option>
                    </select-input>
                    <text-input type="email" label="Email" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="email"
                        v-model="form.email" :error="errors.email" />
                    <text-input type="text" label="Residente" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="residente"
                        v-model="form.residente_id" :error="errors.residente_id" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Familiar
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>


