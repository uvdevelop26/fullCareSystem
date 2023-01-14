<template>
    <div>

        <Head title="Permissions" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Permissions</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="form.post(route('permissions.update', this.permission.id))">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="form.name" type="text" label="Nombre"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="name" name="name" />
                   
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('empleados.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1"    type="submit">
                        Actualizar Permission
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
        permission: Object,
    },

    layout: Layout,

    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.permission.id,
            name: props.permission.name

        });

        /* const actualizarPermiso = () => {
            empleados.post(
                route("empleados.update", empleados.id_empleado),
                {
                    preserveScroll: true,
                }
            );
        }; */

        return { form };
    },
};
</script>
