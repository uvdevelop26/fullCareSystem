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
        user: Array,
        roles: Array,
        userRole: Array,
        errors: Object
    },

    setup(props) {
        const form = useForm({
            _method: "PUT",
            id: props.user.id,
            username: props.user.username,
            password: props.user.password,
            password_confirmation: props.user.password,
            empleado_id: props.user.empleado_id,
            role_id: props.userRole[0].id

        });

        const actualizar = () => {
            form.post(
                route("usuarios.update", form.id),
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

        <Head title="Editar Usuario" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="users" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Usuario</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Empleado" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="empleado"
                        v-model="form.empleado_id" :error="errors.empleado_id" />
                    <text-input type="text" label="Nombre de Usuario" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="username"
                        v-model="form.username" :error="errors.username" />
                    <text-input type="password" label="Contraseña" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="password"
                        v-model="form.password" :error="errors.password" />
                    <text-input type="password" label="Re-escribir la contraseña" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="password_confirmation"
                        v-model="form.password_confirmation" :error="errors.password" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Roles" id="role_id" v-model="form.role_id"
                        :error="errors.role_id">
                        <option :value="null" />
                        <option v-for="role in roles" :key="role.id" :value="role.id">
                            {{ role.name }}
                        </option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('usuarios.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

