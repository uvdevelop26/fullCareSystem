<template>
    <div>
        <form action="">
            <input type="text" v-model="test">
            
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                <input v-model="nombre" type="text">
                <input v-model="apellidos" class="pb-7 pr-6 w-full lg:w-1/2" label="Apellidos" type="text" />
                <input v-model="ci_numero" class="pb-7 pr-6 w-full lg:w-1/2" label="CI" type="text" />
                <input v-model="fecha_nacimiento" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha de Nacimiento"
                    type="date" />
                <input v-model="telefono" class="pb-7 pr-6 w-full lg:w-1/2" label="Teléfono" type="text" />
                <input v-model="edad" class="pb-7 pr-6 w-full lg:w-1/2" label="edad" type="number" />
                <!-- <select-input v-model="sexo" class="pb-8 pr-6 w-full lg:w-1/2" label="Sexo">
                    <option :value="null" />
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select-input> -->
            </div>
            <button @click.prevent="guardar()">Guardar</button>
        </form>
    </div>
</template>

<script>
import { ref, reactive } from 'vue';

export default {
    setup() {
        const test = ref("");
        const nombre = ref("");

        const hola = reactive({
            test1: '',
            nombres: '',
            testT: [],

        })

        const guardar = async () => {
            hola.test1 = test.value;
            hola.testT = test.value;
            hola.nombres = nombre.value;
            console.log(hola);
        }

        return {
            nombre,
            guardar,
            hola,
            test,
        }
    }
}
</script>