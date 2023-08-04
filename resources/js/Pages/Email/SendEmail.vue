<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import Icon from '../../Shared/Icon.vue'
import TextInput from '../../Shared/TextInput.vue';

export default {

    layout: LayoutApp,

    components: {
        Head,
        Link,
        Icon,
        TextInput,
    },

    props: {
        email: String,
        errors: Object
    },

    setup(props) {

        const form = useForm({
            email: props.email,
            mensaje: ""
        });

        const enviar = async () => {
            form.post(route("contactar-familiar.enviarCorreo"), form);
        };

        return { form, enviar }
    }
}

</script>
<template>
    <div>
        <Head title="Enviar Correo" />
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="email" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Enviar Correo</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="enviar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" disabled label="Correo" class="pb-5 lg:pr-3 w-full max-w-lg" :id="email"
                        v-model="form.email" :error="errors.email" />
                    <div class="pb-5 lg:pr-3 w-full max-w-lg">
                        <label for="mensaje" class="form-label">Mensaje:</label>
                         <textarea name="mensaje" id="mensaje" cols="30" rows="8" class="form-textarea" placeholder="Escriba el mensaje aquí..." v-model="form.mensaje"></textarea>
                         <span v-if="errors.mensaje" class="text-red-500">Este campo es requerido</span>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('familiares.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Enviar Correo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
