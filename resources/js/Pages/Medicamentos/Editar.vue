<template>
    <div>
        <Head title="Empleados" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Empleados</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.nombre_medicamento" type="text" label="Medicamento"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="nombre_medicamento" name="nombre_medicamento" />
                    <select-input v-model="form.via_suministro" class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Via Suministro">
                        <option :value="null" />
                        <option value="Via Oral">Oral</option>
                        <option value="Via Subcutanea">Subcutanea</option>
                        <option value="Sanguinea">Sanguinea</option>
                        <option value="Otros">Otros</option>
                    </select-input>
                    <text-input v-model="form.fecha_vencimiento" type="date" label="Fecha de Vencimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_vencimiento" name="fecha_vencimiento" />
                    <text-input v-model="form.dosis_cantidad" type="text" label="Dosis/Cantidad"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="dosis_cantidad" name="dosis_cantidad" />
                    <text-input v-model="form.stock" type="number" label="Stock" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="stock" name="stock" />
                    <text-input v-model="form.residente_id" type="text" label="Residente"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="residente_id" name="residente_id" />

                </div>
                <div class="flex-wrap -mb-8 -mr-6 p-8">
                    <div class="block py-2 font-bold text-center text-2xl text-cyan-700">Horarios de Suministro</div>
                    <div v-for="horario in horarios" :key="horario.id">
                        <div class="flex items-center gap-1">
                            <input type="checkbox" :id="horario.hora" :value="horario.id" v-model="form.horarios">
                            <label :for="horario.hora">{{ horario.hora }}</label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('medicamentos.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>

                    <button class="btn-indigo mx-1" type="submit" @click.prevent="guardar()">
                        Editar Medicamento
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
        medicamento: Object,
        horarios: Object,
        medicamentoHasHorario: Array
    },

    layout: Layout,

    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.medicamento.id,
            nombre_medicamento: props.medicamento.nombre_medicamento,
            via_suministro: props.medicamento.via_suministro,
            fecha_vencimiento: props.medicamento.fecha_vencimiento,
            dosis_cantidad: props.medicamento.dosis_cantidad,
            stock: props.medicamento.stock,
            residente_id: props.medicamento.residente_id,
            horarios: props.medicamentoHasHorario

        });

        const guardar = () => {
            form.post(
                route("medicamentos.update", form.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { form, guardar };
    },
};
</script>
