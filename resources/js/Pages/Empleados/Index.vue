<template>
    <div>

        <Head title="Empleados" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Empleados</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" type="button" :href="route('empleados.create')">
            <span class="text-white font-bold">Nuevo Empleado</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">CI</th>
                        <th class="py-3 px-4">Fecha Nacimiento</th>
                        <th class="py-3 px-4">Teléfono</th>
                        <th class="py-3 px-4">Edad</th>
                        <th class="py-3 px-4">Sexo</th>
                        <th class="py-3 px-4">Direccion</th>
                        <th class="py-3 px-4">Ciudad</th>
                        <th class="py-3 px-4">Fecha Ingreso</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Profesion</th>
                        <th class="py-3 px-4">Sección</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="empleado in empleados.data" :key="empleado.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100" :class="{}">
                        <td class="border-t py-3">
                            {{ empleado.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.ci_numero }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.fecha_nacimiento }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.telefono }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.edad }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.sexo }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.direccion }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.persona.ciudade.nombre_ciudad }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.fecha_ingreso }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.email }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.profesion }}
                        </td>
                        <td class="border-t py-3">
                            {{ empleado.seccion.nombre_seccion }}
                        </td>
                        <td class="border-t py-3">
                            <Link class="mx-1 inline-block"
                                :href="route('empleados.edit', empleado.id)">
                            <icon name="edit" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </Link>
                            <button class="mx-1"
                                @click="eliminarEmpleado(empleado)">
                                <icon name="delete" class="w-4 h-4 fill-gray-600 hover:fill-cyan-800" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="empleados.links" />
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
import Pagination from "../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Head,
        Link,
        Icon,
        Pagination

    },

    layout: Layout,

    props: {
        empleados: Object
    },

    setup(props) {
        const eliminarEmpleado = (data) => {
            data._method = "DELETE";
            Inertia.post("/empleados/" + data.id, data);

        }

        return { eliminarEmpleado }
    }

}

</script>