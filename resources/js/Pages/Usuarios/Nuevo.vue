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
        roles: Array,
        errors: Object
    },

    setup() {

        const form = useForm({
            empleado_id: "",
            username: "",
            password: "",
            password_confirmation: "",
            role_id: ""
        });

        const guardar = async () => {
            form.post(route("usuarios.store"), form);
        };

        return { form, guardar };
    },
};
</script>
<template>
    <div>

        <Head title="Crear Usuario" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="users" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Crear Usuario</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="guardar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="empleado"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <text-input type="text" label="Nombre de Usuario" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="username"
                        v-model="form.username" :error="errors.username" />
                    <text-input type="password" label="Contraseña" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="password"
                        v-model="form.password" :error="errors.password" />
                    <text-input type="password" label="Re-escribir la contraseña" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="password_confirmation"
                        v-model="form.password_confirmation" :error="errors.password" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Rol" id="role_id" v-model="form.role_id"
                        :error="errors.role_id">
                        <option :value="null" />
                        <option v-for="role in roles" :key="role.id" :value="role.id" class="text-sm">
                            {{ role.name }}
                        </option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('usuarios.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Crear Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

