<template>
    <div>

        <Head title="Sueldos" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Sueldo</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="sueldos.monto" type="text" label="Monto" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="nombres" name="monto" :error="errors.monto" />
                    <select-input v-model="sueldos.categoria" class="pb-8 pr-6 w-full lg:w-1/2" label="Categoria"
                        :error="errors.categoria">
                        <option :value="null" />
                        <option value="R1">R1</option>
                        <option value="R2">R2</option>
                        <option value="R3">R3</option>
                    </select-input>
                    <text-input v-model="sueldos.observacion" type="text" label="Observacion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="observacion" name="observacion" :error="errors.observacion" />
                    <text-input v-model="sueldos.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id"
                        :error="errors.empleado_id" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('sueldos.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1" @click.prevent="actualizarSueldo()" type="submit">
                        Actualizar Sueldo
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
        sueldo: Object,
        errors: Object,
    },

    layout: Layout,

    setup(props) {
        const sueldos = useForm({
            _method: "PUT",
            id: props.sueldo.id,
            monto: props.sueldo.monto,
            categoria: props.sueldo.categoria,
            observacion: props.sueldo.observacion,
            empleado_id: props.sueldo.empleado_id
        });

        const actualizarSueldo = () => {
            sueldos.post(
                route("sueldos.update", sueldos.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { sueldos, actualizarSueldo };
    },
};
</script>
