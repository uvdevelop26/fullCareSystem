<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from '../../Shared/Header.vue'
import SearchInput from '../../Shared/SearchInput.vue';
import Icon from '../../Shared/Icon.vue';

export default {
    layout: LayoutApp,

    props: ['residentes'],

    components: {
        Header,
        SearchInput,
        Link,
        Icon

    },

    setup(props) {
        console.log(props.residentes)
    }
}

</script>
<template>
    <div>

        <Head title="residentes" />
        <Header />
        <div class="py-2">
            <SearchInput />
            <!-- ACÁ VA IR FILTER -->
        </div>
        <div class="overflow-x-auto py-5 max-w-6xl">
            <table
                class="bg-fondColor w-full whitespace-nowrap border-separate border-spacing-y-2 text-sm rounded-md overflow-hidden shadow-md">
                <thead class="">
                    <tr class="shadow">
                        <th class="py-3 px-4 bg-white rounded-l-lg text-cyan-800 font-bold">Foto</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">Nombres</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">Cédula </th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold"> Nacimiento</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">Telefono</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">edad</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">sexo</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">direccion</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">ciudad</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">Ingreso</th>
                        <th class="py-3 px-3 bg-white text-cyan-800 font-bold">Estado</th>
                        <th class="py-3 px-3 bg-white rounded-r-lg text-cyan-800 font-bold">Acciones</th>
                    </tr>
                </thead>

                <transition-group appear tag="tbody" name="list">
                    <tr class="text-center shadow" v-for="residente in residentes" :key="residente.id">
                        <td class="py-1 px-0 bg-white rounded-l-lg">
                            <img :src="residente.foto" class="w-12 h-12 rounded-full mx-auto" alt="foto del residente">
                        </td>
                        <td class="py-2 px-2 bg-white">
                            {{ residente.persona.nombres }}
                            {{ residente.persona.apellidos }}
                        </td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.ci_numero }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.fecha_nacimiento }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.telefono }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.edad }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.sexo }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.direccion }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.persona.ciudade.nombre_ciudad }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.fecha_ingreso }}</td>
                        <td class="py-2 px-2 bg-white">{{ residente.estado }}</td>
                        <td class="py-2 px-2 bg-white rounded-r-lg">
                            <Link class="inline-block bg-fondColor px-3 py-3 mr-2 rounded-full">
                            <Icon name="edit" class="w-3 h-3 fill-textColor" />
                            </Link>
                            <Link class="inline-block px-3 py-3 rounded-full bg-softIndigo">
                            <Icon name="delete" class="w-3 h-3 fill-white" />
                            </Link>
                        </td>
                    </tr>
                </transition-group>

            </table>
        </div>
    </div>
</template>
<style scoped>
/* LIST TRANSITIONS */
.list-enter-from {
    opacity: 0;
    transform: translateX(-60px);
}

.list-enter-to {
    opacity: 1;
    transform: translateX(0);
}

.list-enter-active {
    transition: all 0.4s ease;
}

.list-leave-from {
    opacity: 1;
    transform: translateX(0);
}

.list-leave-to {
    opacity: 0;
    transform: translateX(-60px);
}

.list-leave-active {
    transition: all 0.4s ease;
}
</style>
