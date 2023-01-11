<template>
    <div>
        <Head title="Editar Residente" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Residente</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input
                        v-model="residentes.nombres"
                        type="text"
                        label="Nombres"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="nombres"
                        name="nombres"
                        :error="errors.nombres"
                    />
                    <!-- v-model="personas.nombres" -->
                    <text-input
                        v-model="residentes.apellidos"
                        type="text"
                        label="Apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="apellidos"
                        name="apellidos"
                        :error="errors.apellidos"
                    />
                    <!-- v-model="personas.apellidos" -->
                    <text-input
                        v-model="residentes.ci_numero"
                        type="text"
                        label="CI"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ci_numero"
                        name="ci_numero"
                        :error="ci_numero"
                    />
                    <!-- v-model="personas.ci_numero" -->
                    <text-input
                        v-model="residentes.fecha_nacimiento"
                        type="date"
                        label="Fecha de Nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="fecha_nacimiento"
                        name="fecha_nacimiento"
                        :error="errors.fecha_nacimiento"
                    />
                    <!-- v-model="personas.fecha_nacimiento" -->
                    <text-input
                        v-model="residentes.telefono"
                        type="text"
                        label="Teléfono"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="telefono"
                        name="telefono"
                        :error="errors.telefono"
                    />
                    <!-- v-model="persona.telefono" -->
                    <text-input
                        v-model="residentes.edad"
                        type="number"
                        label="edad"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="edad"
                        name="edad"
                        :error="errors.edad"
                    />
                    <!-- v-model="persona.edad" -->
                    <select-input
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Sexo"
                        :error="errors.sexo"
                        v-model="residentes.sexo"
                    >
                        <option :value="null" />
                        <!-- :value="persona.sexo" -->
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <!-- v-model="personas.sexo" -->
                    <text-input
                        v-model="residentes.direccion"
                        type="text"
                        label="Direccion"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="direccion"
                        name="direccion"
                        :error="errors.direccion"
                    />
                    <!-- v-model="persona.direccion" -->
                    <select-input
                        v-model="residentes.ciudade_id"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Ciudad"
                        :error="errors.ciudade_id"
                    >
                        <option :value="null" />
                        <option v-for="ciudade in ciudades" 
                        :value="ciudade.id"
                       >
                        {{ciudade.nombre_ciudad}}
                    </option>
                        
                    </select-input>
                    <!-- v-model="persona.ciudade_id" -->
                    <text-input
                        v-model="residentes.foto"
                        type="text"
                        label="Foto"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="foto"
                        name="foto"
                        :error="errors.foto"
                    />
                    <!-- v-model="residente[0].foto" -->
                    <text-input
                        v-model="residentes.fecha_ingreso"
                        type="date"
                        label="Fecha Ingreso"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="fecha_ingreso"
                        name="fecha_ingreso"
                        :error="errors.fecha_ingreso"
                    />
                    <!-- v-model="residente[0].fecha_ingreso" -->
                    <select-input
                        v-model="residentes.estado"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Estado"
                        :error="errors.estado"
                    >
                        <option :value="null" />
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select-input>
                    ><!-- v-model="residente[0].estado" -->
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
                        @click.prevent="actualizarResidente()"
                        type="submit"
                    >
                        Actualizar Residente
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
        residente: Object,
        persona: Object,
        ciudades: Object,
        errors: Object,
    },

    layout: Layout,

    setup(props) {
        const residentes = useForm({
            /* const personas = useForm({
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

           id_residente: props.residente[0].id,
           foto: props.residente[0].foto,
           fecha_ingreso: props.residente[0].fecha_ingreso,
           estado: props.residente[0].estado

       });*/
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

            id_residente: props.residente.id,
            foto: props.residente.foto,
            fecha_ingreso: props.residente.fecha_ingreso,
            estado: props.residente.estado,
        });

        const actualizarResidente = () => {
            residentes.post(
                route("residentes.update", residentes.id_residente),
                {
                    preserveScroll: true,
                }
            );

            /*  personas.id_residente = props.residente[0].id;
             personas.foto = props.residente[0].foto;
             personas.fecha_ingreso = props.residente[0].fecha_ingreso;
             personas.estado = props.residente[0].estado;*/
        };

        return { residentes, actualizarResidente };
    },
};
</script>
