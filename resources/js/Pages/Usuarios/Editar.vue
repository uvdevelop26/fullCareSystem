<template>
    <div>

        <Head title="Usuarios" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Usuario</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="users.username" type="text" label="Usuario" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="username" name="username" />
                    <text-input v-model="users.password" type="password" label="Contraseña"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="password" name="password" />
                    <text-input v-model="users.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id" />
                    <select-input v-model="users.role_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Roles">
                        <option :value="null" />
                        <option v-for="role in roles" :value="role.id">
                            {{ role.name }}
                        </option>
                    </select-input>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('usuarios.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1" @click.prevent="actualizarUsuario()" type="submit">
                        Actualizar Usuario
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
        user: Object,
        roles: Object,
        userRole: Object,

    },

    layout: Layout,

    setup(props) {
        const users = useForm({
            _method: "PUT",
            id: props.user.id,
            username: props.user.username,
            password: props.user.password,
            empleado_id: props.user.empleado_id,
            role_id: props.roles.role_id
        });

        const actualizarUsuario = () => {
            users.post(
                route("usuarios.update", users.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { users, actualizarUsuario };
    },
};
</script>
