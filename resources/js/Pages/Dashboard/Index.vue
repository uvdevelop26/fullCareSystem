
<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';

export default {

  layout: LayoutApp,

  props: {

   /*  cumpleanioResidentes: Array,
    user: Array, */
    totalResidentes: Number

  },

  setup() {

    //PARA MOSTRAR IMAGEN
    const urlbase = (url) => {
      if (url.includes('https')) {
        return url;
      } else {
        return url.replace('public/', 'storage/')
      }
    }

    return { urlbase }
  }

}
</script>
<template>
  <div>
    <!-- HEADER -->
    <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
      <h1 class="uppercase">
        <span class="text-turquesa text-2xl font-semibold">Dashboard</span>
      </h1>
    </div>
    <div>
      <div>
        Bienvenido
      </div>
      <ul>
        <li>{{ totalResidentes }}</li>
      </ul>
    </div>
    <!-- TABLES -->

    <!-- <div class="flex flex-col items-center md:flex-row md:gap-3 lg:gap-6 ">
      <div v-for="residente in cumpleanioResidentes" :key="residente.id"
        class="bg-white shadow-md rounded-2xl p-5 max-w-sm mb-3 border-2">
        <div>
          <div class="w-36 h-36 rounded-full overflow-hidden mx-auto mb-3 border-4 border-indigo-400">
            <img :src="urlbase(residente.foto)" class="w-full h-full object-cover" alt="foto">
          </div>
        </div>
        <div>
          <ul class="text-center text-xl">
            <li class="py-2">
              <span class="font-bold text-xl decoration-wavy text-gray-600">{{ residente.persona.nombres }} {{
                residente.persona.apellidos }}</span>
            </li>
            <li class="py-2">
              <p class="text-lg font-bold">Nació el {{ residente.persona.fecha_nacimiento }}</p>
            </li>
            <li>
              <p class="text-lg font-bold"> Ingresó el {{ residente.fecha_ingreso }}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
 -->

  </div>
</template>


<style></style>