<template>
    <div>

        <Head title="Crear Ingreso" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Residente</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="text-center py-2 font-bold text-cyan-700 italic border rounded-lg mx-1 my-1">
                    Datos Personales del Residente
                </div>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="personas.nombres" type="text" label="Nombres" class="pb-7 pr-6 w-full lg:w-1/2" />
                    <text-input v-model="personas.apellidos" class="pb-7 pr-6 w-full lg:w-1/2" label="Apellidos"
                        :id="apellidos" />
                    <text-input v-model="personas.ci_numero" class="pb-7 pr-6 w-full lg:w-1/2" label="CI" :id="ci_numero" />
                    <text-input v-model="personas.fecha_nacimiento" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha de Nacimiento"
                        type="date" :id="fecha_nacimiento" />
                    <text-input v-model="persona.telefono" class="pb-7 pr-6 w-full lg:w-1/2" label="Teléfono" :id="telefono" />
                    <text-input v-model="persona.edad" class="pb-7 pr-6 w-full lg:w-1/2" label="edad" type="number"
                        :id="edad" />
                    <select-input v-model="personas.sexo" class="pb-8 pr-6 w-full lg:w-1/2" label="Sexo">
                        <option :value="persona.sexo" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                </div>
                <div class="text-center py-2 font-bold text-cyan-700 italic border rounded-lg mx-1 my-1">
                    Datos de Interno
                </div>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="personas.foto" class="pb-7 pr-6 w-full lg:w-1/2" label="Foto" :id="foto" />
                    <text-input v-model="personas.fecha_ingreso" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha Ingreso"
                        type="date" :id="fecha_ingreso" />
                    <text-input v-model="personas.fecha_salida" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha Salida"
                        type="date" :id="fecha_salida" />
                </div>
                <div class="text-center py-2 font-bold text-cyan-700 italic border rounded-lg mx-1 my-1">
                    Direccion del Residente
                </div>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="persona.paise_id" class="pb-7 pr-6 w-full lg:w-1/2" label="Pais" :id="pais" />
                    <text-input v-model="persona.ciudade_id" class="pb-7 pr-6 w-full lg:w-1/2" label="Ciudad" :id="ciudad" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('residentes.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Ingreso
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

export default {
    components: {
        Head,
        Link,
        TextInput,
        SelectInput,
    },

    props: {
        residente: Array,
        persona: Object,
    },

    layout: Layout,

    setup(props) {

        const personas = useForm({
            _method: "PUT",
            id: props.persona.id,
            nombres: props.persona.nombres,
            apellidos: props.persona.apellidos,
            ci_numero: props.persona.ci_numero,
            fecha_nacimiento: props.persona.fecha_nacimiento,
            telefono: props.persona.telefono,
            edad: props.persona.edad,
            sexo: props.persona.sexo,
            paise_id: props.persona.paise_id,
            ciudade_id: props.persona.ciudade_id,

            foto: props.residente[0].foto,
            fecha_ingreso: props.residente[0].fecha_ingreso,
            fecha_salida: props.residente[0].fecha_salida
            
        });

        const actualizarResidente = () => {
         form.post(route("residentes.update", props.actividades.id), {
        preserveScroll: true,
      });
    };




        console.log(personas);
   

        return { personas }

    }


}

</script>