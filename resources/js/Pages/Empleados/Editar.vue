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
        empleado: Array,
        persona: Array,
        ciudades: Array,
        seccions: Array,
        errors: Object
    },


    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.persona.id,
            nombres: props.persona.nombres,
            apellidos: props.persona.apellidos,
            ci_numero: props.persona.ci_numero,
            fecha_nacimiento: props.persona.fecha_nacimiento,
            telefono: props.persona.telefono,
            edad: props.persona.edad,
            sexo: props.persona.sexo,
            direccion: props.persona.direccion,
            ciudade_id: props.persona.ciudade_id,

            id_empleado: props.empleado.id,
            fecha_inicio: props.empleado.fecha_inicio,
            email: props.empleado.email,
            seccion_id: props.empleado.seccion_id,

        });

        const actualizar = () => {
            form.post(
                route("empleados.update", form.id_empleado),
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
                <Icon name="empleados" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Empleado</span>
        </h1>
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Nombres" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="nombres"
                        v-model="form.nombres" :error="errors.nombres" />
                    <text-input type="text" label="Apellidos" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="apellidos"
                        v-model="form.apellidos" :error="errors.apellidos" />
                    <text-input type="text" label="CI" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="ci_numero"
                        v-model="form.ci_numero" :error="errors.ci_numero" reference="4972774 (sin puntos)" />
                    <text-input type="date" label="Fecha de Nacimiento" class="pb-5 lg:pr-3 w-full lg:w-1/2"
                        id="fecha_nacimiento" v-model="form.fecha_nacimiento" :error="errors.fecha_nacimiento" />
                    <text-input type="text" label="Teléfono" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="telefono"
                        v-model="form.telefono" :error="errors.telefono" />
                    <text-input type="number" label="Edad" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="edad"
                        v-model="form.edad" :error="errors.edad" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Sexo" id="sexo" v-model="form.sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="Femenino" class="text-sm">Femenino</option>
                        <option value="Masculino" class="text-sm">Masculino</option>
                    </select-input>
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Ciudad" id="ciudad" v-model="form.ciudade_id"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudad in ciudades" :key="ciudad.nombre_ciudad" :value="ciudad.id" class="text-sm">
                            {{ ciudad.nombre_ciudad }}
                        </option>
                    </select-input>
                    <text-input type="text" label="Dirección" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="direccion"
                        v-model="form.direccion" :error="errors.direccion" />
                    <text-input type="date" label="Fecha de Inicio" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="fecha_inicio"
                        v-model="form.fecha_inicio" :error="errors.fecha_inicio" />
                    <text-input type="text" label="Correo" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="email"
                        v-model="form.email" :error="errors.email" />
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Sección" id="seccion_id"
                        v-model="form.seccion_id" :error="errors.seccion_id">
                        <option :value="null" />
                        <option v-for="seccion in seccions" :key="seccion.id" :value="seccion.id" class="text-sm">
                            {{ seccion.nombre_seccion }}
                        </option>
                    </select-input>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('empleados.index')" class="btn-cancelar">
                             <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Empleado
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</template>


