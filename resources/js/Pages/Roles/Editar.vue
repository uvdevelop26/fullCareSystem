<template>
    <div>

        <Head title="Usuarios" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Rol</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="roles.post(route('role.update', props.role.id))">

                <div class="flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="roles.name" type="text" label="Rol" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="name" name="name" />

                    <div class="flex-wrap -mb-8 -mr-6 p-8">
                        <div class="block">Permisos para este Rol</div>
                        <div v-for="permission in permissions" :key="permission.id">
                            <label for="">
                                <input type="checkbox" name="permissions[]" value="{{ permission.id }}" id="">
                                {{ permission.name }}
                            </label>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('roles.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1" @click.prevent="actualizarRol()" type="submit">
                        Actualizar Rol
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
        role: Object,
        permissions: Object,
        roleHasPermissions: Object,
    },

    layout: Layout,

    setup(props) {

        const roles = useForm({
            _method: "PUT",
            id: props.role.id,
            name: props.role.name,
            permissions: props.roleHasPermissions
        });

        const actualizarRol = () => {
            roles.post(
                route("usuarios.update", roles.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { roles, actualizarRol };
    },
};
</script>
