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
        Icon,
        Link,
        Head,
        TextInput,
        SelectInput
    },

    props: {
        residentes: Array,
        errors: Object
    },

    setup() {

        const form = useForm({
            nombre: "",
            motivo_salida: "",
            fecha_salida: "",
            fecha_regreso: "",
            residente_id: ""
        })


        const guardar = async () => {
            form.post(route('estados.store'), {
                forceFormData: true
            })
        }

        return { form, guardar }
    }

}
</script>
<template>
    <div>

        <Head title="Crear Estado" />
        <!-- header -->
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="residentes" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Estado</span>
        </h1>
        <!-- formulario -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Residente" id="residente"
                        v-model="form.residente_id" :error="errors.residente_id">
                        <option :value="null" />
                        <option v-for="residente in residentes" :key="residente.id" :value="residente.id" class="text-sm">{{
                            residente.persona.nombres }} {{
                            residente.persona.apellidos }}
                            </option>
                    </select-input>
                    <!-- <text-input type="text" label="Residente" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="residente"
                        v-model="form.residente_id" :error="errors.residente_id" /> -->
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Estado" id="estado" v-model="form.nombre"
                        :error="errors.nombre">
                        <option :value="null" />
                        <option :value="1" class="text-sm">Activo</option>
                        <option :value="0" class="text-sm">Inactivo</option>
                    </select-input>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="observaciones" class="form-label">Motivo Salida:</label>
                        <textarea name="motivo_salida" id="motivo_salida" cols="20" rows="3" class="form-textarea "
                            v-model="form.motivo_salida"></textarea>
                        <span v-if="errors.motivo_salida" class="text-red-500">{{ errors.motivo_salida }}</span>
                    </div>
                    <text-input type="date" label="Fecha Salida" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="fecha_salida"
                        v-model="form.fecha_salida" :error="errors.fecha_salida" />
                    <text-input type="date" label="Fecha Regreso" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="recha_regreso"
                        v-model="form.fecha_regreso" :error="errors.fecha_regreso" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('estados.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Estado
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</template>
<style></style>