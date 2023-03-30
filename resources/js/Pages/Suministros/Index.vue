<template>
    <div>
        <div class="md:flex md:justify-around md:flex-wrap">
            <div v-for="medicamento in medicamentos" :key="medicamento.id" 
            class="border px-2 py-2 my-2 shadow w-72 max-w-4xl">
                <div>
                    <img src="{{ medicamento.residente.foto }}" width="90" height="90" alt=""
                        class="rounded-full border mx-auto">
                </div>
                <div class="text-center py-3">
                    <span class="text-cyan-700 font-bold text-lg">
                        {{ medicamento.residente.persona.nombres }}
                    </span>
                </div>
                <div class="text-center">
                    <span class="font-bold">Medicamento: </span>
                    <span class="text-cyan-700 font-bold">{{ medicamento.nombre_medicamento }}</span>
                </div>
                <div class="text-center">
                    <span class="font-bold">Horarios de Suministro</span>
                    <div v-for="horario in medicamento.horarios" class="block py-1">
                        <span class="inline-block p-1 bg-indigo-700 text-white rounded-lg">{{ horario.hora }} </span>
                        <input type="checkbox" class="mx-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout.vue';

export default {
    layout: Layout,

    props: {
        medicamentos: Object
    }
}
</script>