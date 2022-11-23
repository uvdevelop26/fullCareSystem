<template>
    <div>
        <Head title="Crear Ingreso" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Familiar</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
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
                    <select-input
                        v-model="parentesco"
                        class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Patentezco"
                    >
                        <option :value="null" />
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Hijo/a">Hijo/a</option>
                        <option value="Nieto/a">Nieto/a</option>
                        <option value="Sobrino/a">Sobrino/a</option>
                        <option value="Otro">Otro</option>
                    </select-input>
                    <text-input
                        v-model="email"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Email"
                        type="emai"
                        :id="email"
                    />
                    <text-input
                        v-model="paise_id"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Pais"
                        :id="pais"
                    />
                    <text-input
                        v-model="ciudade_id"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Ciudad"
                        :id="ciudad"
                    />
                    <text-input
                        v-model="residente_id"
                        class="pb-7 pr-6 w-full lg:w-1/2"
                        label="Residente"
                        :id="residente_id"
                    />
                    
                </div>
            
                <div
                    class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100"
                >
                    <Link
                        type="button"
                        :href="route('familiars.index')"
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
                        Crear Familiar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '../../Shared/Layout.vue'
import TextInput from '../../Shared/TextInput.vue'
import SelectInput from '../../Shared/SelectInput.vue'
import {Head, Link} from "@inertiajs/inertia-vue3"
import { ref } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default{

    components: {
        TextInput,
        SelectInput,
        Head,
        Link
    },

    layout: Layout,

    setup(){

        const nombres = ref("")
        const apellidos = ref("")
        const ci_numero = ref("")
        const fecha_nacimiento = ref("")
        const telefono = ref("")
        const edad = ref("")
        const sexo = ref("")
         //paise_id
        //ciudade_id

        const parentesco = ref("")
        const email = ref("")
        //residente_id

        const personas = useForm({
            nombres: "",
            apellidos: "",
            ci_numero: "",
            fecha_nacimiento:"",
            telefono:"",
            edad:"",
            sexo:"",
            paise_id: 2,
            ciudade_id: 2,

            parentesco: "",
            email: "",
            residente_id: 7,

            familiars: [],

        });

        const guardar = async () =>{
            personas.nombres = nombres.value;
            personas.apellidos = apellidos.value;
            personas.ci_numero = ci_numero.value;
            personas.fecha_nacimiento = fecha_nacimiento.value;
            personas.telefono = telefono.value;
            personas.edad = edad.value;
            personas.sexo = sexo.value;


            personas.parentesco = parentesco.value;
            personas.email = email.value;

            const add = {
                parentesco: parentesco.value,
                email: email.value,
                residente_id: 7
            };

            personas.familiars.push(add);

            console.log(personas);

            personas.post(route('familiars.store'), personas);

        };


        return {
            nombres,
            apellidos,
            ci_numero,
            fecha_nacimiento,
            telefono,
            edad,
            sexo,
            parentesco,
            email,
            guardar

        }
        
    }

}

</script>