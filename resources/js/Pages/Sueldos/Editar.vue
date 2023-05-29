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
        sueldo: Array,
        errors: Object,
    },



    setup(props) {
        const form = useForm({
            _method: "PUT",
            id: props.sueldo.id,
            fecha: props.sueldo.fecha,
            monto: props.sueldo.monto,
            empleado_id: props.sueldo.empleado_id
        });

        const actualizar = () => {
            form.post(
                route("sueldos.update", form.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { form, actualizar };
    },
};
</script>
<template>
    <div>
        <Head title="Editar Sueldo" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="sueldos" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Sueldo</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="date" label="Fecha" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="fecha"
                        v-model="form.fecha" :error="errors.fecha" />
                    <text-input type="number" label="monto" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="edad"
                        v-model="form.monto" :error="errors.monto" />
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" :id="empleado_id"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('sueldos.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Sueldo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


