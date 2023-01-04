<template>
<div>
    <Head title="Residentes" />
    <h1 class="mb-7 text-3xl font-bold text-cyan-600">Residentes</h1>
    <div class="flex items-center justify-between mb-6">
        <!-- <div class="search">
            <label for="search" class="font-bold text-cyan-600 px-2">Buscar:</label>
            <input type="text" 
            v-model="form.search" 
            class="rounded-md mx-2 w-60 border-cyan-700 focus:border-cyan-500"
            placeholder="Buscar Residente..">
        </div> -->
        <Link class="btn-nuevo" 
        type="button" 
        :href="route('residentes.create')">
            <span class="text-white font-bold">Nuevo Residente</span>
        </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap text-sm">
            <thead>
                <tr class="text-center text-sm uppercase">
                    <th class="py-2 px-4">Nombres</th>
                    <th class="py-2 px-4">Apellidos</th>
                    <th class="py-2 px-4">CI</th>
                    <th class="py-2 px-4">Fecha Nacimiento</th>
                    <th class="py-2 px-4">Teléfono</th>
                    <th class="py-2 px-4">Edad</th>
                    <th class="py-2 px-4">Sexo</th>
                    <th class="py-2 px-4">Direccion</th>
                    <th class="py-2 px-4">Ciudad</th>
                    <th class="py-2 px-4">Foto</th>
                    <th class="py-2 px-4">Fecha Ingreso</th>
                    <th class="py-2 px-4">Estado</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="persona in personas" :key="persona.id" 
                class="text-center text-sm text-gray-600 hover:bg-gray-50"
                :class="{}">
                    <td class="border-t">
                        {{persona.nombres}}
                    </td>
                    <td class="border-t">
                         {{persona.apellidos}}
                    </td>
                    <td class="border-t">
                        {{persona.ci_numero}}
                    </td>
                    <td class="border-t">
                        {{persona.fecha_nacimiento}}
                    </td>
                    <td class="border-t">
                        {{persona.telefono}}
                    </td>
                    <td class="border-t">
                        {{persona.edad}}
                    </td>
                    <td class="border-t">
                        {{persona.sexo}}
                    </td>
                    <td class="border-t">
                        {{persona.direccion}}
                    </td>
                    <td class="border-t">
                        {{persona.ciudade_id}}
                    </td> 
                    <td class="border-t">
                        <img src="{{ persona.residentes.foto }}" width="20" height="20" class="rounded-full border mx-auto">
                    </td>
                    <td class="border-t">
                        {{ persona.residentes.fecha_ingreso}}
                    </td>
                    <td class="border-t">
                        {{ persona.residentes.estado}}
                    </td>
                    <td class="border-t py-2">
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1"
                        :href="route('residentes.edit', persona.id)">
                        <icon name="edit" class="w-3 h-3 fill-gray-600" />
                        </Link>
                        <Link class="inline-block px-2 py-2 bg-gray-100 rounded-full mx-1" method="DELETE"
                        :href="route('residentes.destroy', persona.id)">
                        <icon name="delete" class="w-3 h-3 fill-gray-600" />
                        </Link>
                    </td>

                </tr>
            </tbody>      
        </table>
       <!--  <pagination class="mt-6" :links="personas.links" /> -->
    </div>
</div>
  
</template>

<script>
import Layout from '../../Shared/Layout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3'
import Icon from '../../Shared/Icon.vue'
/* import Pagination from '../../Shared/Pagination.vue' */
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import {pickBy} from 'lodash'
import { watchEffect  } from "vue";
export default {

    components: {
        Head,
        Link,
        Icon,
     /*    Pagination */

    },

    layout: Layout,

    props:{
        personas: Object,
      /*   filters: Object */
    },

    setup(props){
            /* const form = reactive({
                search: props.filters.search,
            });

            watchEffect(() =>{
                const query = pickBy(form);
                Inertia.replace(
                    route('residentes.index', Object.keys(query).length ? query : {})
                );
            });


            return { form  } */
    },

  

}
</script>

<style>

</style>