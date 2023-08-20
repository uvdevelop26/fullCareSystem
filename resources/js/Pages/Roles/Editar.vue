<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import Icon from "../../Shared/Icon.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
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
        role: Array,
        permissions: Array,
        roleHasPermissions: Array,
        errors: Object
    },



    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.role.id,
            name: props.role.name,
            permissions: props.roleHasPermissions
        });

        const actualizar = () => {
            form.post(
                route("roles.update", form.id),
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

        <Head title="Editar Rol" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="jornadas" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Rol</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3  bg-white border rounded-md">
                    <text-input type="text" v-model="form.name" label="Nombre del Rol" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        :id="name" :error="errors.name" />
                    <div class="flex-wrap">
                        <div class="block pb-2">Permisos para este Rol</div>
                        <div v-for="permission in permissions" :key="permission.id">
                            <div class="flex items-center gap-1">
                                <input type="checkbox" :id="permission.name" :value="permission.id"
                                    v-model="form.permissions">
                                <label :for="permission.name" class="capitalize"> {{ permission.name }}</label>
                            </div>
                        </div>
                        <div v-if="errors.permissions" class="form-error"> {{ errors.permissions }}</div>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('roles.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Actualizar Rol
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


