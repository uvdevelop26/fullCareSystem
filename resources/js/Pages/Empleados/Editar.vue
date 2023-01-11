<template>
    <div>

        <Head title="Empleados" />
        <h1 class="mb-5 text-2xl font-bold text-cyan-900">Editar Empleados</h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
            <form>
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model="empleados.nombres" type="text" label="Nombres"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="nombres" name="nombres" :error="errors.nombres" />
                    <text-input v-model="empleados.apellidos" type="text" label="Apellidos"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="apellidos" name="apellidos" :error="errors.apellidos" />
                    <text-input v-model="empleados.ci_numero" type="text" label="CI" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="ci_numero" name="ci_numero" :error="ci_numero" />
                    <text-input v-model="empleados.fecha_nacimiento" type="date" label="Fecha de Nacimiento"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_nacimiento" name="fecha_nacimiento"
                        :error="errors.fecha_nacimiento" />
                    <text-input v-model="empleados.telefono" type="text" label="Teléfono"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="telefono" name="telefono" :error="errors.telefono" />
                    <text-input v-model="empleados.edad" type="number" label="edad" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="edad" name="edad" :error="errors.edad" />
                    <select-input v-model="empleados.sexo" class="pb-8 pr-6 w-full lg:w-1/2" label="Sexo"
                        :error="errors.sexo">
                        <option :value="null" />
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select-input>
                    <text-input v-model="empleados.direccion" type="text" label="Direccion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="direccion" name="direccion" :error="errors.direccion" />
                    <select-input v-model="empleados.ciudade_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Ciudad"
                        :error="errors.ciudade_id">
                        <option :value="null" />
                        <option v-for="ciudade in ciudades" :value="ciudade.id">
                            {{ ciudade.nombre_ciudad }}
                        </option>
                    </select-input>

                    <text-input v-model="empleados.fecha_ingreso" type="date" label="Fecha Ingreso"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="fecha_ingreso" name="fecha_ingreso"
                        :error="errors.fecha_ingreso" />
                    <text-input v-model="empleados.email" type="text" label="Email" class="pb-7 pr-6 w-full lg:w-1/2"
                        :id="email" name="email" :error="errors.email" />
                    <text-input v-model="empleados.profesion" type="text" label="Profesion"
                        class="pb-7 pr-6 w-full lg:w-1/2" :id="profesion" name="profesion" :error="errors.profesion" />
                    <select-input v-model="empleados.seccion_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Seccion"
                        :error="errors.seccion_id">
                        <option :value="null" />
                        <option v-for="seccion in seccions" :value="seccion.id">
                            {{ seccion.nombre_seccion }}
                        </option>
                    </select-input>
                </div>
                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <Link type="button" :href="route('empleados.index')" class="btn-cancelar">
                    <span class="text-white font-bold">Cancelar</span>
                    </Link>
                    <button class="btn-indigo mx-1" @click.prevent="actualizarEmpleado()" type="submit">
                        Actualizar Empleado
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
        empleado: Object,
        persona: Object,
        errors: Object,
        ciudades: Object,
        seccions: Object
    },

    layout: Layout,

    setup(props) {

        const empleados = useForm({
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
            fecha_ingreso: props.empleado.fecha_ingreso,
            email: props.empleado.email,
            profesion: props.empleado.profesion,
            seccion_id: props.empleado.seccion_id,

        });

        const actualizarEmpleado = () => {
            empleados.post(
                route("empleados.update", empleados.id_empleado),
                {
                    preserveScroll: true,
                }
            );
        };

        return { empleados, actualizarEmpleado };
    },
};
</script>
