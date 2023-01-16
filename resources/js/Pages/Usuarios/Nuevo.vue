<template>
    <div>

        <Head title="Crear Familiar" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Crear Usuario</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="users.username" type="text" label="Nombre de Usuario"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="username" name="username" />
                    <text-input v-model="users.password" type="password" label="Password"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="password" name="password"  />
                    <text-input v-model="users.empleado_id" type="text" label="Empleado"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="empleado_id" name="empleado_id" />
                    <select-input  class="pb-8 pr-6 w-full lg:w-1/2" label="Roles" v-model="users.role_id">
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
                    <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                    <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                        Crear Usuario
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
        roles: Object
    },

    setup() {


        const username = ref("");
        const password = ref("");
        const empleado_id = ref("");
        const role_id = ref("");


        const users = useForm({
            username: "",
            password: "",
            empleado_id: "",
            role_id: ""

        });



        const guardar = async () => {

            console.log(users);

            users.post(route("usuarios.store"), users);

        };

        return {
            users,

            guardar,
        };
    },
};
</script>