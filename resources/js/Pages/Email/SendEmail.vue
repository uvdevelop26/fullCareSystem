<template>

    <Head title="Enviar Correo" />
    <h1 class="mb-7 text-3xl font-bold text-cyan-600">Enviar Correo Electrónico</h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form>
            <div class="-mb-8 -mr-6 p-8">
                <text-input type="text" v-model="form.email" label="Correo Electrónico"
                    class="pb-7 pr-6 w-full lg:w-1/2" :id="telefono" name="telefono" />
                    <label for="mensaje" class="block py-2">Mensaje:</label>
                <textarea class="rounded lg:w-1/2 border-cyan-800" name="mensaje" id="mensaje" cols="30" rows="10"
                    v-model="form.mensaje">
                </textarea>

            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                <span class="text-white font-bold">Cancelar</span>
                </Link>
                <!--  <loading-button class="btn-indigo mx-1" type="submit">Crear Ingreso</loading-button>  -->
                <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
                    Enviar Correo
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import TextInput from '../../Shared/TextInput.vue'
import { ref } from 'vue'


export default {

    layout: Layout,

    components: {
        Head,
        Link,
        Icon,
        TextInput

    },

    props: {
        email: String
    },

    setup(props) {

        const email = props.email;
        const mensaje = ref("");

        const form = useForm({
            email: props.email,
            mensaje: ""
        });

        const guardar = async () => {
            form.post(route("emails.store"), form);
        };


        return { form, guardar }
    }

}

</script>