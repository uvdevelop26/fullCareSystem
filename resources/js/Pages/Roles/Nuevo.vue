<template>
    <div>

        <Head title="Crear Roles" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Rol</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="roles.post(route('roles.store'))">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="roles.name" type="text" label="Nombre del Rol"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="name" name="name" />

                </div>
                <div class="flex-wrap -mb-8 -mr-6 p-8">
                    <div class="block">Permisos para este Rol</div>

                    <!-- ===========HERE IS THE PROBLEM -->
                    <div v-for="permission in permissions" :key="permission.id">
                        <div class="flex items-center gap-1">
                            <input type="checkbox" :id="permission.name" :value="permission.id" v-model="roles.permissions">
                            <label :for="permission.name">{{ permission.name }}</label>
                        </div>
                    </div>

                    <!-- =====================================================-->

                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('roles.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>

                    <button class="btn-indigo mx-1" type="submit">
                        Crear Rol
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
        permissions: Object
    },

    setup() {


        const name = ref("");
        const premissions = ref([]);


        const roles = useForm({
            name: "",
            permissions: [],

        });



        /* const guardar = async () => {

            console.log(roles);

            roles.post(route("roles.store"), roles);

        }; */

        return {
            roles
        };
    },
};
</script>