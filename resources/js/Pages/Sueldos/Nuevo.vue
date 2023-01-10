<template>
    <div>

        <Head title="Crear Sueldo" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Sueldo</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="sueldos.monto" type="text" label="Sueldo" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="monto" name="Monto" :error="errors.monto" />
                    <select-input v-model="sueldos.categoria" class="pb-8 pr-6 w-full lg:w-1/2" label="Categoria"
                        :error="errors.categoria">
                        <option :value="null" />
                        <option value="R1">R1</option>
                        <option value="R2">R2</option>
                        <option value="R3">R3</option>
                    </select-input>
                    <text-input v-model="sueldos.observacion" type="text" label="Observacion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="ci_numero" name="observacion"
                        :error="errors.observacion" />
                    <text-input v-model="sueldos.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id"
                        :error="errors.empleado_id" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('sueldos.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Sueldo
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

    layout: Layout,

    props: {
        errors: Object,
    },

    setup() {

        const monto = ref("");
        const categoria = ref("");
        const observacion = ref("");
        const empleado_id = ref("");


        const sueldos = useForm({
            categoria: "",
            monto: "",
            observacion: "",
            empleado_id: "",

        });



        const guardar = async () => {


            sueldos.post(route("sueldos.store"), sueldos);

        };

        return {
            sueldos,

            guardar,
        };
    },
};
</script>