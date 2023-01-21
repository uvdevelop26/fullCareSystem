<template>
    <div>
        <Head title="Empleados" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Empleados</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id" />
                    <select-input v-model="form.turno" class="pb-8 pr-6 w-full lg:w-1/2" label="Turno">
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
                            <input type="checkbox" :id="dia.dias" :value="dia.id" v-model="form.dias">
                            <label :for="dia.dias">{{ dia.dias }}</label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('empleados.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1" @click.prevent="actualizarTurno()" type="submit">
                        Actualizar Jornada
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
        turno: Object,
        dias: Object,
        turnoHasDias: Array
    },

    layout: Layout,

    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.turno.id,
            turno: props.turno.turno,
            empleado_id: props.turno.empleado_id,
            dias: props.turnoHasDias

        });

        const actualizarTurno = () => {
            form.post(
                route("turnos.update", form.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { form, actualizarTurno };
    },
};
</script>
