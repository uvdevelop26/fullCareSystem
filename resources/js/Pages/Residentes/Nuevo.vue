<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import Icon from '../../Shared/Icon.vue';
import TextInput from '../../Shared/TextInput.vue';
import SelectInput from "../../Shared/SelectInput.vue";
import { Link, Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: LayoutApp,

    components: {
        Head,
        Icon,
        TextInput,
        SelectInput,
        Link
    },

    props: {
        ciudades: Array,
        estado_residentes: Array,
        errors: Object
    },


    setup() {
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
            foto: "",
            fecha_ingreso: "",
            estado_residente_id: ""
        });

        const guardar = async () => {
            form.post(route('residentes.store'), {
                forceFormData: true
            });
        }


        return { form, guardar }
    }

}
</script>
<template>
    <div>

        <Head title="Crear Residente" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="residentes" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Residente</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="file" label="Foto" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="foto"
                        :error="errors.foto" @input="form.foto = $event.target.files[0]" />
                    <text-input type="date" label="Fecha Ingreso" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="fecha_ingreso"
                        v-model="form.fecha_ingreso" :error="errors.fecha_ingreso" />

                    <text-input type="text" label="Nombres" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="nombres"
                        v-model="form.nombres" :error="errors.nombres" />
                    <text-input type="text" label="Apellidos" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="apellidos"
                        v-model="form.apellidos" :error="errors.apellidos" />
                    <text-input type="text" label="CI" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="ci_numero"
                        v-model="form.ci_numero" :error="errors.ci_numero" />

                    <text-input type="date" label="Fecha de Nacimiento" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        id="fecha_nacimiento" v-model="form.fecha_nacimiento" :error="errors.fecha_nacimiento" />
                    <text-input type="text" label="Teléfono" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="telefono"
                        v-model="form.telefono" :error="errors.telefono" />
                    <text-input type="number" label="Edad" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="edad"
                        v-model="form.edad" :error="errors.edad" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Sexo" id="sexo" v-model="form.sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="femenino" class="text-sm capitalize">Femenino</option>
                        <option value="masculino" class="text-sm capitalize">Masculino</option>
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
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Estado" id="estado" 
                    v-model="form.estado_residente_id" :error="errors.estado_residente_id">
                        <option :value="null" />
                        <option v-for="estado_residente in estado_residentes" :key="estado_residente.id" 
                        :value="estado_residente.id" class="capitalize text-sm">
                            {{ estado_residente.nombre_estado }}
                        </option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('residentes.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Residente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<style></style>

