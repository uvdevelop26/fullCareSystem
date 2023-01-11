<template>
    <div>
        <Head title="Residentes" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Residentes</h1>
        <div class="flex items-center justify-between mb-6">
          <text-input type="text" 
          class="block ml-2 mb-4 w-6/12" 
          v-model="form.search"
          placeholder="Buscar Residente" />
            <Link
                class="btn-nuevo"
                type="button"
                :href="route('residentes.create')"
            >
                <span class="text-white font-bold">Nuevo Residente</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-sm">
                <thead>
                    <tr class="text-center text-sm text-cyan-800 uppercase">
                        <th class="py-3 px-4">Nombres</th>
                        <th class="py-3 px-4">Apellidos</th>
                        <th class="py-3 px-4">CI</th>
                        <th class="py-3 px-4">Fecha Nacimiento</th>
                        <th class="py-3 px-4">Teléfono</th>
                        <th class="py-3 px-4">Edad</th>
                        <th class="py-3 px-4">Sexo</th>
                        <th class="py-3 px-4">Direccion</th>
                        <th class="py-3 px-4">Ciudad</th>
                        <th class="py-3 px-4">Foto</th>
                        <th class="py-3 px-4">Fecha Ingreso</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="residente in residentes.data"
                        :key="residente.id"
                        class="text-center text-sm text-gray-600 hover:bg-gray-100"
                        :class="{}"
                    >
                        <td class="border-t py-3">
                            {{ residente.persona.nombres }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.apellidos }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.ci_numero }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.fecha_nacimiento }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.telefono }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.edad }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.sexo }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.direccion }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.persona.ciudade.nombre_ciudad }}
                        </td>
                        <td class="border-t py-3">
                            <img
                                src="{{ residente.foto }}"
                                width="20"
                                height="20"
                                class="rounded-full border mx-auto"
                            />
                        </td>
                        <td class="border-t py-3">
                            {{ residente.fecha_ingreso }}
                        </td>
                        <td class="border-t py-3">
                            {{ residente.estado }}
                        </td>
                        <td class="border-t py-3">
                            <Link
                                class="mx-1 inline-block"
                                :href="route('residentes.edit', residente.id)"
                            >
                                <icon
                                    name="edit"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </Link>
                            <button
                                class="mx-1"
                                @click="eliminarResidente(residente)"
                            >
                                <icon
                                    name="delete"
                                    class="w-4 h-4 fill-gray-600 hover:fill-cyan-800"
                                />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="residentes.links" />
        </div>
    </div>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Icon from "../../Shared/Icon.vue";
import Pagination from "../../Shared/Pagination.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { pickBy } from "lodash";
import { watchEffect } from "vue";
import TextInput from '../../Components/TextInput.vue'



export default {
    components: {
        Head,
        Link,
        Icon,
        Pagination,
        TextInput,
       

    },

    layout: Layout,

    props: {
        residentes: Object,
        filters: Object
    },

    setup(props) {
        
        const form = reactive({
            search: props.filters.search
        });

        watchEffect(() =>{
            const query = pickBy(form);
            Inertia.replace(
                route('residentes.index', Object.keys(query).length ? query : {})
            );
        });

        const eliminarResidente = (data) => {
            data._method = "DELETE";
            Inertia.post("/residentes/" + data.id, data);
        };

        return { form, eliminarResidente };
    },
};
</script>

<style></style>
