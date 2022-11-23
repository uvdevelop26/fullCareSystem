<template>
    <div>
        <Head title="Familiares" />
        <h1 class="mb-7 text-3xl font-bold text-cyan-600">Familiares</h1>
        <div class="flex items-center justify-between mb-6">
            <Link class="btn-nuevo" 
            type="button" 
            :href="route('familiars.create')">
                <span class="text-white font-bold">Nuevo Familiar</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="text-center text-sm uppercase">
                        <th class="py-4 px-6">Nombres</th>
                        <th class="py-4 px-6">Apellidos</th>
                        <th class="py-4 px-6">CI</th>
                        <th class="py-4 px-6">Fecha Nacimiento</th>
                        <th class="py-4 px-6">Teléfono</th>
                        <th class="py-4 px-6">Edad</th>
                        <th class="py-4 px-6">Sexo</th>
                        <th class="py-4 px-6">Parentesco</th>
                        <th class="py-4 px-6">Email</th>
                        <th class="py-4 px-6">Pais</th>
                        <th class="py-4 px-6">Ciudad</th>
                        <th class="py-4 px-6">Residente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="persona in personas" :key="persona.id" 
                    class="text-center text-gray-600 hover:bg-indigo-50"
                    :class="{}">
                        <td class="border-t py-2">
                            {{persona.nombres}}
                        </td>
                        <td class="border-t py-2">
                            {{persona.apellidos}}
                        </td>
                        <td class="border-t py-2">
                            {{persona.ci_numero}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.fecha_nacimiento}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.telefono}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.edad}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.sexo}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.parentesco}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.email}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.nombre_pais}}
                        </td>
                        <td class="border-t px-2">
                            {{persona.nombre_ciudad}}
                        </td>
                        <td class="border-t px-2">
                            <img src="{{ persona.foto }}" width="20" height="20" class="rounded-full border mx-auto">
                        </td>
                        <td class="border-t py-2">
                            <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1"
                            :href="route('familiars.edit', persona.id)">
                            <icon name="edit" class="w-3 h-3 fill-gray-600" />
                            </Link>
                            <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1" method="DELETE"
                            :href="route('familiars.destroy', persona.id)">
                            <icon name="delete" class="w-3 h-3 fill-gray-600" />
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue'
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'

export default{

    components:{
        Head,
        Link,
        Icon

    },

    props:{
        personas: Array
    },

    layout: Layout

}

</script>