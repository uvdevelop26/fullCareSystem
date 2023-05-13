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
        dias: Array,
        errors: Object
    },

    setup() {

        const form = useForm({
            turno: "",
            empleado_id: "",
            dias: []

        });

        const guardar = async () => {
            form.post(route('turnos.store'), form);
        };


        return {
            form,
            guardar
        };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Roles" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Asignar Jornada</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.empleado_id" type="text" label="Empleado" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="empleado_id" name="empleado_id" :error="errors.empleado_id" />
                    <select-input v-model="form.turno" class="pb-8 pr-6 w-full lg:w-1/2" label="Turno"
                        :error="errors.empleado_id">
                        <option :value="null" />
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                        <option value="Madrugada">Madrugada</option>
                    </select-input>
                </div>
                <div class="flex-wrap -mb-8 -mr-6 p-8">
                    <div class="block py-2 font-bold text-center text-2xl text-cyan-700">Dias Laborales</div>
                    <div v-for="dia in dias" :key="dia.id">
                        <div class="flex items-center gap-1">
                            <input type="checkbox" :id="dia.dias" :value="dia.id" v-model="form.dias" :error="errors.dias">
                            <label :for="dia.dias">{{ dia.dias }}</label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('turnos.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>

                    <button class="btn-indigo mx-1" type="submit" @click.prevent="guardar()">
                        Crear Jornada
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
