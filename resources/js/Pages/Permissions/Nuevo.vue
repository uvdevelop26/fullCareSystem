<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import Icon from "../../Shared/Icon.vue";
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

    props:{
        errors: Object
    },

    setup() {

        const form = useForm({
            name: ""
        });

        const guardar = async () => {

            form.post(route("permissions.store"), form);

        };

        return { form, guardar };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Permiso de Acceso" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="permisos" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Permiso de Acceso</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3  bg-white border rounded-md">
                    <text-input v-model="form.name" type="text" label="Nombre" class="pb-7 pr-6 w-full lg:w-1/2" :id="name"
                        name="name" :error="errors.name" />
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('permissions.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button type="submit" class="btn-indigo mx-1">
                            Crear Permiso
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

